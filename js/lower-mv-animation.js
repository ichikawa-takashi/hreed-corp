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
      toggleActions: "play none none none",
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

// --- 写真(lower-mv__photo)の表示アニメーション -------------------------------
// 見出しの緑帯と同じトーンで、緑の幕が左から伸びて写真を覆い、
// 右へ抜けると同時に写真が現れる。写真は少し拡大した状態からゆっくり等倍に戻す
(function () {
  var photo = document.querySelector(".lower-mv__photo");
  var img = photo ? photo.querySelector("img") : null;
  if (!photo || !img) return;

  gsap.set(photo, { visibility: "visible", "--curtain-scale": 0, "--curtain-origin": "left center" });
  gsap.set(img, { opacity: 0, scale: 1.2 });

  var tl = gsap.timeline({
    delay: 0.2,
    scrollTrigger: {
      trigger: photo,
      start: "top 90%",
      toggleActions: "play none none none",
    },
  });

  tl.to(photo, { "--curtain-scale": 1, duration: 0.6, ease: "power3.inOut" })
    .set(photo, { "--curtain-origin": "right center" })
    .set(img, { opacity: 1 })
    .to(photo, { "--curtain-scale": 0, duration: 0.7, ease: "power3.inOut" })
    .to(img, { scale: 1, duration: 1.6, ease: "power3.out" }, "<");
})();

// --- あしらい(lower-mv__deco)の線描画アニメーション -------------------------
// トップページのaboutセクションと同じ手法: getTotalLength()でstroke-dasharray/
// dashoffsetを組み、何もない状態から線が引かれるように見せる。
// ファーストビューにあるため、線を隠す前に一瞬表示されないよう
// CSSで.lower-mv__decoを非表示にしておき、dashの準備ができてから表示する
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
      duration: 1.4,
      ease: "power2.out",
      delay: i * 0.12,
      scrollTrigger: {
        trigger: lowerMv,
        start: "top 80%",
        toggleActions: "play none none none",
      },
    });
  });

  gsap.set(lowerMv.querySelectorAll(".lower-mv__deco"), { visibility: "visible" });
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
