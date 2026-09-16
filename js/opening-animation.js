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

  if (!window.gsap) {
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
    window.HREED_OPENING_LOGO_SVG;

  // --- loading progress: bar + count-up percentage, shown under the logo ---
  var percentEl = opening.querySelector(".js-opening-percent");
  var barFillEl = opening.querySelector(".js-opening-bar-fill");

  var progress = { pct: 0 };
  function renderProgress() {
    var rounded = Math.round(progress.pct);
    if (percentEl) percentEl.textContent = rounded;
    if (barFillEl) barFillEl.style.width = rounded + "%";
  }

  function setProgress(target) {
    gsap.to(progress, {
      pct: target,
      duration: 0.4,
      ease: "power1.out",
      overwrite: true,
      onUpdate: renderProgress,
    });
  }

  // resolves once real page assets (images + web fonts) have loaded
  var loadingDone = false;
  var onLoadingDone = null;

  function markLoadingDone() {
    if (loadingDone) return;
    loadingDone = true;
    setProgress(100);
    if (onLoadingDone) onLoadingDone();
  }

  function trackLoadProgress() {
    var images = Array.prototype.slice.call(document.images);
    var total = images.length + 1; // +1 for web fonts
    var loaded = 0;

    function tick() {
      loaded++;
      setProgress((loaded / total) * 100);
      if (loaded >= total) markLoadingDone();
    }

    images.forEach(function (img) {
      if (img.complete) {
        tick();
      } else {
        img.addEventListener("load", tick, { once: true });
        img.addEventListener("error", tick, { once: true });
      }
    });

    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(tick);
    } else {
      tick();
    }

    // safety net: never let a stalled asset block the site indefinitely
    setTimeout(markLoadingDone, 6000);
  }
  trackLoadProgress();

  if (!canRun3D) {
    if (loadingDone) {
      gsap.to(opening, { opacity: 0, duration: 0.5, onComplete: finish });
    } else {
      onLoadingDone = function () {
        gsap.to(opening, { opacity: 0, duration: 0.5, delay: 0.2, onComplete: finish });
      };
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
    var restDistance = 24; // distance the camera settles at once assembled; framing is calibrated to this
    var startDistance = 34; // far distance the camera dollies in from during the intro
    camera.position.set(0, 0, startDistance);

    var renderer = new THREE.WebGLRenderer({ antialias: true, alpha: false });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setSize(width, height);
    renderer.setClearColor(0xffffff, 1);
    stage.appendChild(renderer.domElement);

    // --- lights: soft studio setup for a black logo on white -----------------
    scene.add(new THREE.AmbientLight(0xffffff, 0.55));

    var key = new THREE.DirectionalLight(0xffffff, 0.55);
    key.position.set(10, 14, 18);
    scene.add(key);

    var fill = new THREE.DirectionalLight(0xffffff, 0.2);
    fill.position.set(-12, -6, 10);
    scene.add(fill);

    var sweep = new THREE.PointLight(0xffffff, 0.35, 200, 2);
    sweep.position.set(0, 0, 16);
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
          color: 0x031a23,
          metalness: 0.25,
          roughness: 0.48,
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
      var distance = restDistance;
      var vFov = (camera.fov * Math.PI) / 180;
      var visibleHeight = 2 * Math.tan(vFov / 2) * distance;
      var visibleWidth = visibleHeight * camera.aspect;

      var scaleForWidth = (visibleWidth * 0.66) / logoSize.x;
      var scaleForHeight = (visibleHeight * 0.42) / logoSize.y;
      var s = Math.min(scaleForWidth, scaleForHeight);

      rig.scale.set(s, -s, s);
    }
    frameLogo();

    // --- resize --------------------------------------------------------
    function onResize() {
      width = window.innerWidth;
      height = window.innerHeight;
      camera.aspect = width / height;
      camera.updateProjectionMatrix();
      renderer.setSize(width, height);
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

      renderer.render(scene, camera);
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
      renderer.dispose();
    }

    // --- intro: pieces fly in and converge into the lockup -----------------
    // mark pieces: [0,1] = the two accent dots, [2,3,4] = the "H" body
    var dotMeshes = meshes.slice(0, 2);
    var bodyMeshes = meshes.slice(2, 5);
    var wordMeshes = meshes.slice(5);

    bodyMeshes.concat(wordMeshes).forEach(function (mesh) {
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

    // the accent dots get their own entrance: drop in from above with a
    // bounce, slightly after the body, so they read as a deliberate beat
    dotMeshes.forEach(function (mesh) {
      mesh.position.set(0, 140, 40);
      mesh.rotation.z = (Math.random() - 0.5) * 1.2;
      mesh.scale.setScalar(0.01);
      mesh.material.opacity = 0;
    });

    var idleTween = null;

    // once assembled, the logo idles gently in place until the real page
    // load (tracked by the progress bar beneath it) actually completes
    function startIdle() {
      idleTween = gsap.to(rig.rotation, {
        y: 0.16,
        duration: 2.4,
        ease: "sine.inOut",
        yoyo: true,
        repeat: -1,
      });
      if (loadingDone) {
        playExit();
      } else {
        onLoadingDone = playExit;
      }
    }

    function playExit() {
      if (idleTween) idleTween.kill();

      gsap
        .timeline({
          onComplete: function () {
            cleanup();
            done();
          },
        })
        .to(rig.rotation, { y: 0, duration: 0.4, ease: "power1.inOut" }, 0)
        .to(camera.position, { z: 15, duration: 0.6, ease: "power2.in" }, 0.1)
        .to(
          meshes.map(function (m) { return m.material; }),
          { opacity: 0, duration: 0.45, ease: "power1.in" },
          0.1
        )
        .to(root, { opacity: 0, duration: 0.5, ease: "power1.in" }, "<0.05");
    }

    var tl = gsap.timeline({ delay: 0.1, onComplete: startIdle });

    tl.to(camera.position, { z: restDistance, duration: 1.6, ease: "power2.out" }, 0)
      .to(
        bodyMeshes.map(function (m) { return m.position; }),
        { x: 0, y: 0, z: 0, duration: 1.1, stagger: 0.07, ease: "expo.out" },
        0.1
      )
      .to(
        bodyMeshes.map(function (m) { return m.rotation; }),
        { x: 0, y: 0, z: 0, duration: 1.1, stagger: 0.07, ease: "expo.out" },
        0.1
      )
      .to(
        bodyMeshes.map(function (m) { return m.material; }),
        { opacity: 1, duration: 0.7, stagger: 0.07, ease: "power1.out" },
        0.1
      )
      // dots: delayed, bouncy pop-in accent
      .to(
        dotMeshes.map(function (m) { return m.position; }),
        { x: 0, y: 0, z: 0, duration: 0.8, stagger: 0.12, ease: "bounce.out" },
        0.55
      )
      .to(
        dotMeshes.map(function (m) { return m.rotation; }),
        { z: 0, duration: 0.6, stagger: 0.12, ease: "power2.out" },
        0.55
      )
      .to(
        dotMeshes.map(function (m) { return m.scale; }),
        { x: 1, y: 1, z: 1, duration: 0.55, stagger: 0.12, ease: "back.out(2.6)" },
        0.55
      )
      .to(
        dotMeshes.map(function (m) { return m.material; }),
        { opacity: 1, duration: 0.3, stagger: 0.12, ease: "power1.out" },
        0.55
      )
      .to(
        wordMeshes.map(function (m) { return m.position; }),
        { x: 0, y: 0, z: 0, duration: 1, stagger: 0.06, ease: "expo.out" },
        0.5
      )
      .to(
        wordMeshes.map(function (m) { return m.rotation; }),
        { x: 0, y: 0, z: 0, duration: 1, stagger: 0.06, ease: "expo.out" },
        0.5
      )
      .to(
        wordMeshes.map(function (m) { return m.material; }),
        { opacity: 1, duration: 0.6, stagger: 0.06, ease: "power1.out" },
        0.5
      )
      // settle: a small unified punch once everything has landed
      .to(rig.scale, {
        x: "*=1.04",
        y: "*=1.04",
        z: "*=1.04",
        duration: 0.18,
        ease: "power1.out",
        yoyo: true,
        repeat: 1,
      }, 1.75);
  }
})();
