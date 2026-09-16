(function () {
  var opening = document.querySelector(".js-opening");
  if (!opening) return;

  var STORAGE_KEY = "hreedOpeningPlayed";

  var alreadyPlayed = false;
  try {
    alreadyPlayed = sessionStorage.getItem(STORAGE_KEY) === "1";
  } catch (e) {}

  if (alreadyPlayed) {
    opening.remove();
    return;
  }

  document.documentElement.classList.add("is-opening");

  function finish() {
    document.documentElement.classList.remove("is-opening");
    try {
      sessionStorage.setItem(STORAGE_KEY, "1");
    } catch (e) {}
    opening.remove();
  }

  var reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
  ).matches;

  function isWebGLAvailable() {
    try {
      var canvas = document.createElement("canvas");
      return !!(
        window.WebGLRenderingContext &&
        (canvas.getContext("webgl") || canvas.getContext("experimental-webgl"))
      );
    } catch (e) {
      return false;
    }
  }

  var canRun3D =
    !reduceMotion &&
    isWebGLAvailable() &&
    window.THREE &&
    THREE.SVGLoader &&
    THREE.EffectComposer &&
    window.gsap &&
    window.HREED_OPENING_LOGO_SVG;

  if (!canRun3D) {
    if (window.gsap) {
      gsap.to(opening, { opacity: 0, duration: 0.5, delay: 0.25, onComplete: finish });
    } else {
      opening.style.transition = "opacity .5s ease";
      opening.style.opacity = "0";
      setTimeout(finish, 550);
    }
    return;
  }

  runOpeningScene(opening, finish);

  function runOpeningScene(root, done) {
    var stage = root.querySelector(".js-opening-stage");

    var width = window.innerWidth;
    var height = window.innerHeight;

    var scene = new THREE.Scene();

    var camera = new THREE.PerspectiveCamera(42, width / height, 1, 100);
    camera.position.set(0, 0, 34);

    var renderer = new THREE.WebGLRenderer({ antialias: true, alpha: false });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setSize(width, height);
    renderer.setClearColor(0x031a23, 1);
    if ("outputEncoding" in renderer) renderer.outputEncoding = THREE.sRGBEncoding;
    stage.appendChild(renderer.domElement);

    // --- lights -----------------------------------------------------
    scene.add(new THREE.AmbientLight(0x0b1f1c, 1.1));

    var key = new THREE.PointLight(0x1fe0c4, 60, 200, 2);
    key.position.set(12, 10, 18);
    scene.add(key);

    var rim = new THREE.PointLight(0xffffff, 30, 200, 2);
    rim.position.set(-14, -6, 10);
    scene.add(rim);

    var sweep = new THREE.PointLight(0x0c998a, 40, 200, 2);
    sweep.position.set(0, 0, 14);
    scene.add(sweep);

    // --- logo geometry -------------------------------------------------
    var tiltGroup = new THREE.Group();
    scene.add(tiltGroup);

    var rig = new THREE.Group();
    tiltGroup.add(rig);

    var logoGroup = new THREE.Group();
    rig.add(logoGroup);

    var loader = new THREE.SVGLoader();
    var svgData = loader.parse(window.HREED_OPENING_LOGO_SVG);

    var extrudeSettings = {
      depth: 26,
      bevelEnabled: true,
      bevelThickness: 5,
      bevelSize: 3,
      bevelSegments: 3,
      curveSegments: 16,
    };

    var meshes = [];

    svgData.paths.forEach(function (path) {
      var shapes = THREE.SVGLoader.createShapes(path);
      shapes.forEach(function (shape) {
        var geometry = new THREE.ExtrudeGeometry(shape, extrudeSettings);
        var material = new THREE.MeshStandardMaterial({
          color: 0x0c998a,
          emissive: 0x0c998a,
          emissiveIntensity: 0.55,
          metalness: 0.72,
          roughness: 0.22,
          side: THREE.DoubleSide,
          transparent: true,
          opacity: 1,
        });
        var mesh = new THREE.Mesh(geometry, material);
        logoGroup.add(mesh);
        meshes.push(mesh);
      });
    });

    // center the artwork, then flip into three.js's Y-up space
    var box = new THREE.Box3().setFromObject(logoGroup);
    var center = box.getCenter(new THREE.Vector3());
    logoGroup.position.set(-center.x, -center.y, -center.z);
    var logoSize = box.getSize(new THREE.Vector3());

    function frameLogo() {
      var distance = camera.position.z - rig.position.z;
      var vFov = (camera.fov * Math.PI) / 180;
      var visibleHeight = 2 * Math.tan(vFov / 2) * distance;
      var visibleWidth = visibleHeight * camera.aspect;

      var scaleForWidth = (visibleWidth * 0.66) / logoSize.x;
      var scaleForHeight = (visibleHeight * 0.5) / logoSize.y;
      var s = Math.min(scaleForWidth, scaleForHeight);

      rig.scale.set(s, -s, s);
    }
    frameLogo();
    window.__debugOpening = { camera: camera, rig: rig, logoSize: logoSize, width: width, height: height };

    // --- postprocessing (bloom) --------------------------------------
    var composer = new THREE.EffectComposer(renderer);
    composer.addPass(new THREE.RenderPass(scene, camera));
    var bloomPass = new THREE.UnrealBloomPass(
      new THREE.Vector2(width, height),
      0.85,
      0.55,
      0.18
    );
    composer.addPass(bloomPass);

    // --- resize --------------------------------------------------------
    function onResize() {
      width = window.innerWidth;
      height = window.innerHeight;
      camera.aspect = width / height;
      camera.updateProjectionMatrix();
      renderer.setSize(width, height);
      composer.setSize(width, height);
      frameLogo();
    }
    window.addEventListener("resize", onResize);

    // --- mouse / touch parallax -----------------------------------------
    var pointer = { x: 0, y: 0 };
    function onPointerMove(e) {
      pointer.x = (e.clientX / width) * 2 - 1;
      pointer.y = (e.clientY / height) * 2 - 1;
    }
    window.addEventListener("pointermove", onPointerMove);

    // --- render loop -------------------------------------------------------
    var clock = new THREE.Clock();
    var running = true;
    var rafId = null;

    function renderLoop() {
      if (!running) return;
      rafId = requestAnimationFrame(renderLoop);
      var t = clock.getElapsedTime();

      tiltGroup.rotation.y += (pointer.x * 0.25 - tiltGroup.rotation.y) * 0.04;
      tiltGroup.rotation.x += (-pointer.y * 0.15 - tiltGroup.rotation.x) * 0.04;

      sweep.position.x = Math.sin(t * 0.6) * 16;
      sweep.position.y = Math.cos(t * 0.5) * 10;

      composer.render();
    }
    renderLoop();

    function cleanup() {
      running = false;
      if (rafId) cancelAnimationFrame(rafId);
      window.removeEventListener("resize", onResize);
      window.removeEventListener("pointermove", onPointerMove);
      meshes.forEach(function (mesh) {
        mesh.geometry.dispose();
        mesh.material.dispose();
      });
      composer.renderTarget1.dispose();
      composer.renderTarget2.dispose();
      renderer.dispose();
    }

    // --- intro: scatter in the dark, then converge into the lockup --------
    var iconMeshes = meshes.slice(0, 5);
    var wordMeshes = meshes.slice(5);

    meshes.forEach(function (mesh) {
      var angle = Math.random() * Math.PI * 2;
      var radius = 420 + Math.random() * 640;
      mesh.position.set(
        Math.cos(angle) * radius,
        Math.sin(angle) * radius * 0.6,
        -900 - Math.random() * 700
      );
      mesh.rotation.set(
        (Math.random() - 0.5) * Math.PI * 1.4,
        (Math.random() - 0.5) * Math.PI * 1.4,
        (Math.random() - 0.5) * Math.PI * 1.4
      );
      mesh.material.opacity = 0;
    });

    var tl = gsap.timeline({
      delay: 0.15,
      onComplete: function () {
        cleanup();
        done();
      },
    });
    window.__openingTL = tl;

    tl.to(camera.position, { z: 24, duration: 1.6, ease: "power2.out" }, 0)
      .to(
        iconMeshes.map(function (m) { return m.position; }),
        { x: 0, y: 0, z: 0, duration: 1.1, stagger: 0.07, ease: "expo.out" },
        0.1
      )
      .to(
        iconMeshes.map(function (m) { return m.rotation; }),
        { x: 0, y: 0, z: 0, duration: 1.1, stagger: 0.07, ease: "expo.out" },
        0.1
      )
      .to(
        iconMeshes.map(function (m) { return m.material; }),
        { opacity: 1, duration: 0.7, stagger: 0.07, ease: "power1.out" },
        0.1
      )
      .to(
        wordMeshes.map(function (m) { return m.position; }),
        { x: 0, y: 0, z: 0, duration: 1, stagger: 0.06, ease: "expo.out" },
        0.42
      )
      .to(
        wordMeshes.map(function (m) { return m.rotation; }),
        { x: 0, y: 0, z: 0, duration: 1, stagger: 0.06, ease: "expo.out" },
        0.42
      )
      .to(
        wordMeshes.map(function (m) { return m.material; }),
        { opacity: 1, duration: 0.6, stagger: 0.06, ease: "power1.out" },
        0.42
      )
      .to(
        meshes.map(function (m) { return m.material; }),
        { emissiveIntensity: 1.3, duration: 0.25, ease: "power1.out" },
        1.55
      )
      .to(
        meshes.map(function (m) { return m.material; }),
        { emissiveIntensity: 0.5, duration: 0.6, ease: "power2.out" },
        1.8
      )
      .to(rig.rotation, { y: 0.22, duration: 1.1, ease: "sine.inOut" }, 1.6)
      .to(rig.rotation, { y: -0.1, duration: 1.3, ease: "sine.inOut" }, "+=0")
      .to({}, { duration: 0.4 })
      .to(camera.position, { z: 15, duration: 0.6, ease: "power2.in" }, ">-0.1")
      .to(
        meshes.map(function (m) { return m.material; }),
        { opacity: 0, duration: 0.45, ease: "power1.in" },
        "<"
      )
      .to(root, { opacity: 0, duration: 0.5, ease: "power1.in" }, "<0.05");
  }
})();
