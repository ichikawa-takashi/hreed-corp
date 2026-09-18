gsap.registerPlugin(ScrollTrigger);

(function () {
  var head = document.querySelector(".lower-mv__head");
  if (!head) return;

  var lines = head.querySelectorAll(".lower-mv__tag, .lower-mv__heading");
  if (!lines.length) return;

  var tl = gsap.timeline({
    scrollTrigger: {
      trigger: head,
      start: "top 90%",
      once: true,
    },
  });

  lines.forEach(function (line, i) {
    var text = line.querySelector(".lower-mv__text");

    // 緑の背景が左から右へ広がる
    tl.fromTo(
      line,
      { scaleX: 0 },
      { scaleX: 1, duration: 0.6, ease: "power3.out", transformOrigin: "left center" },
      i === 0 ? 0 : "-=0.15"
    );

    // 背景の展開に続いてテキストがふわっと現れる
    if (text) {
      tl.fromTo(
        text,
        { opacity: 0, y: 8 },
        { opacity: 1, y: 0, duration: 0.5, ease: "power2.out" },
        "-=0.2"
      );
    }
  });
})();

// --- あしらい(lower-mv__deco)の線描画アニメーション -------------------------
// トップページのaboutセクションと同じ手法: strokeのみの図形(--03の枠、
// --04の円)はgetTotalLength()でstroke-dasharray/dashoffsetを組み、線が
// 引かれるように見せる。--01/--02は塗りの図形(実質は縁取りだが線として
// 描画できない)なので、同じタイミングでふわっと浮かび上がる形で揃える
(function () {
  var lowerMv = document.querySelector(".lower-mv");
  if (!lowerMv) return;

  var drawTargets = lowerMv.querySelectorAll(".js-draw");
  drawTargets.forEach(function (el, i) {
    var length = el.getTotalLength();
    el.style.strokeDasharray = length;
    el.style.strokeDashoffset = length;

    gsap.to(el, {
      strokeDashoffset: 0,
      duration: 1.2,
      ease: "power2.out",
      delay: i * 0.15,
      scrollTrigger: {
        trigger: lowerMv,
        start: "top 80%",
        once: true,
      },
    });
  });

  var fadeTargets = lowerMv.querySelectorAll(
    ".lower-mv__deco--01, .lower-mv__deco--02"
  );
  if (fadeTargets.length) {
    gsap.from(fadeTargets, {
      opacity: 0,
      scale: 0.85,
      duration: 0.9,
      stagger: 0.15,
      ease: "power2.out",
      transformOrigin: "center",
      scrollTrigger: {
        trigger: lowerMv,
        start: "top 80%",
        once: true,
      },
    });
  }
})();

// --- あしらい(lower-mv__deco)のマウス連動パララックス -----------------------
// オープニングアニメーションのロゴと同じ考え方: マウス位置に応じて
// あしらいを3D的に傾ける。奥にあるものほど振れ幅を小さくして視差を出す
(function () {
  var lowerMv = document.querySelector(".lower-mv");
  var decos = lowerMv ? lowerMv.querySelectorAll(".lower-mv__deco") : [];
  if (!lowerMv || !decos.length) return;
  if (!window.matchMedia("(pointer: fine)").matches) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  gsap.set(decos, { transformPerspective: 700 });

  var setters = [];
  decos.forEach(function (deco, i) {
    var strength = 1 - i * 0.15; // 後の要素ほど少し控えめに傾ける
    setters.push({
      rotateY: gsap.quickTo(deco, "rotationY", { duration: 0.7, ease: "power3" }),
      rotateX: gsap.quickTo(deco, "rotationX", { duration: 0.7, ease: "power3" }),
      strength: strength,
    });
  });

  var active = false;
  var observer = new IntersectionObserver(
    function (entries) {
      active = entries[0].isIntersecting;
    },
    { threshold: 0 }
  );
  observer.observe(lowerMv);

  function onPointerMove(e) {
    if (!active) return;
    var rect = lowerMv.getBoundingClientRect();
    var px = ((e.clientX - rect.left) / rect.width) * 2 - 1;
    var py = ((e.clientY - rect.top) / rect.height) * 2 - 1;

    setters.forEach(function (s) {
      s.rotateY(px * 10 * s.strength);
      s.rotateX(-py * 8 * s.strength);
    });
  }
  window.addEventListener("pointermove", onPointerMove);
})();
