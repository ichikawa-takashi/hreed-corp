gsap.registerPlugin(ScrollTrigger);

(function () {
  var section = document.querySelector(".cta-banner");
  if (!section) return;

  var link = section.querySelector(".cta-banner__link");
  var bg = section.querySelector(".cta-banner__bg");
  var canvas = section.querySelector(".cta-banner__canvas");
  var shine = section.querySelector(".cta-banner__shine");
  var wrapper = section.querySelector(".cta-banner__wrapper");
  var prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // 背景はゆっくり呼吸するようにズーム(Ken Burns)
  if (bg && !prefersReducedMotion) {
    gsap.to(bg, {
      scale: 1.08,
      duration: 10,
      ease: "sine.inOut",
      yoyo: true,
      repeat: -1,
      transformOrigin: "center center",
    });
  }

  // 光の帯が視界に入った瞬間に一度だけ斜めに通り抜ける
  // (shineの初期位置はCSS側で画面外に置いてあるだけなので、JSが遅れて実行されても
  //  それまでは何も見えず、ちらつきの心配はない)
  if (shine) {
    gsap.to(shine, {
      xPercent: 260,
      duration: 1.1,
      ease: "power2.inOut",
      scrollTrigger: {
        trigger: section,
        start: "top 75%",
        once: true,
      },
    });
  }

  // マグネティックボタン(カーソルにテキストブロックが少し寄る)
  if (link && wrapper && window.matchMedia("(pointer: fine)").matches) {
    link.addEventListener("mousemove", function (e) {
      var rect = link.getBoundingClientRect();
      var relX = (e.clientX - rect.left) / rect.width - 0.5;
      var relY = (e.clientY - rect.top) / rect.height - 0.5;

      gsap.to(wrapper, {
        x: relX * 16,
        y: "-=0",
        rotate: relX * 1.2,
        duration: 0.5,
        ease: "power2.out",
      });
    });

    link.addEventListener("mouseleave", function () {
      gsap.to(wrapper, { x: 0, rotate: 0, duration: 0.6, ease: "power3.out" });
    });
  }

  // ---- ここからthree.js: 背景に漂うパーティクル ----
  // canvasはCSS側でopacity:0がデフォルト。three.jsの初期化が終わり最初の
  // 描画ができてから初めてフェードインさせるので、素の状態が一瞬透けて見えたり
  // 消えて再アニメーションしたりすることはない。
  if (!canvas || typeof THREE === "undefined" || prefersReducedMotion) return;

  var renderer;
  try {
    renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
  } catch (e) {
    return;
  }

  renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(50, 1, 0.1, 100);
  camera.position.z = 12;

  var PARTICLE_COUNT = 140;
  var positions = new Float32Array(PARTICLE_COUNT * 3);
  for (var i = 0; i < PARTICLE_COUNT; i++) {
    positions[i * 3] = (Math.random() - 0.5) * 22;
    positions[i * 3 + 1] = (Math.random() - 0.5) * 10;
    positions[i * 3 + 2] = (Math.random() - 0.5) * 8;
  }

  var geometry = new THREE.BufferGeometry();
  geometry.setAttribute("position", new THREE.BufferAttribute(positions, 3));

  var material = new THREE.PointsMaterial({
    color: 0xdeeeee,
    size: 0.09,
    transparent: true,
    opacity: 0.85,
    depthWrite: false,
    blending: THREE.AdditiveBlending,
  });

  var points = new THREE.Points(geometry, material);
  scene.add(points);

  function resize() {
    var w = canvas.clientWidth;
    var h = canvas.clientHeight;
    if (!w || !h) return;
    renderer.setSize(w, h, false);
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
  }

  var clock = new THREE.Clock();
  var running = false;
  var rafId = null;
  var scrollDrift = 0;

  function renderLoop() {
    if (!running) return;
    var t = clock.getElapsedTime();

    points.rotation.y = t * 0.03 + scrollDrift;
    points.rotation.x = Math.sin(t * 0.15) * 0.05;
    points.position.y = Math.sin(t * 0.25) * 0.3;

    renderer.render(scene, camera);
    rafId = requestAnimationFrame(renderLoop);
  }

  function start() {
    if (running) return;
    running = true;
    resize();
    renderLoop();
  }

  function stop() {
    running = false;
    if (rafId) cancelAnimationFrame(rafId);
    rafId = null;
  }

  // スクロール位置に応じてゆっくり回転を加える(スクラブ値をそのまま反映するだけなので、
  // 一度隠れてから再度発火するような不具合は起こらない)
  ScrollTrigger.create({
    trigger: section,
    start: "top bottom",
    end: "bottom top",
    scrub: true,
    onUpdate: function (self) {
      scrollDrift = self.progress * 1.4;
    },
  });

  // 画面内にある間だけ描画してパフォーマンスを確保しつつ、
  // 初回表示時にふわっとフェードインさせる
  var hasEntered = false;
  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          start();
          if (!hasEntered) {
            hasEntered = true;
            gsap.to(canvas, { opacity: 1, duration: 1.2, ease: "power1.out" });
          }
        } else {
          stop();
        }
      });
    },
    { threshold: 0.05 }
  );
  observer.observe(section);

  window.addEventListener("resize", resize);
})();
