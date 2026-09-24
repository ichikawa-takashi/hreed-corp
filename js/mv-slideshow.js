(function () {
  var el = document.querySelector(".mv__photo");
  if (!el || typeof Swiper === "undefined") return;

  var mv = document.querySelector(".mv");
  var deco = mv ? mv.querySelector(".mv__deco") : null;
  var head = mv ? mv.querySelector(".mv__head") : null;
  var headText = mv ? mv.querySelector(".mv__head-text") : null;
  var tag = mv ? mv.querySelector(".mv__tag") : null;
  var tagText = mv ? mv.querySelector(".mv__tag-text") : null;
  var media = mv ? mv.querySelector(".mv__media") : null;
  var news = mv ? mv.querySelector(".mv__news") : null;

  // オープニング演出の裏側で見出し等が素の状態のまま一瞬見えてしまわない
  // よう(演出が終わるまでの間、白い幕ごしに透けて見えてしまうのを防ぐ)、
  // ページ読み込み直後の時点であらかじめ隠しておく
  if (window.gsap) {
    if (deco) gsap.set(deco, { opacity: 0 });
    if (head) gsap.set(head, { scaleX: 0, transformOrigin: "left center" });
    if (headText) gsap.set(headText, { opacity: 0, y: 8 });
    if (tag) gsap.set(tag, { scaleX: 0, transformOrigin: "left center" });
    if (tagText) gsap.set(tagText, { opacity: 0, y: 8 });
    if (media) gsap.set(media, { opacity: 0, y: 24 });
    if (news) gsap.set(news, { opacity: 0, y: 16 });
  }

  var swiper = new Swiper(el, {
    effect: "fade",
    fadeEffect: { crossFade: true },
    slidesPerView: 1,
    speed: 1100,
    rewind: true,
    allowTouchMove: false,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  });

  // オープニング演出中はカウントを進めず、演出終了(.js-openingの除去)後に自動再生を開始する
  swiper.autoplay.stop();

  // 見出し・タグ・写真・お知らせカードなど、FVのコンテンツをまとめてアニメーション表示する。
  // 見出し・タグは下層ページの見出し(sec-title)と同じく「背景が先に広がり、
  // そこから文字が浮かび上がる」演出にする
  function revealContent() {
    if (!window.gsap) return;

    var tl = gsap.timeline();
    if (deco) tl.to(deco, { opacity: 1, duration: 1, ease: "power1.out" }, 0);

    if (head) tl.to(head, { scaleX: 1, duration: 0.6, ease: "power3.out" }, 0.15);
    if (headText) tl.to(headText, { opacity: 1, y: 0, duration: 0.5, ease: "power2.out" }, 0.55);

    if (tag) tl.to(tag, { scaleX: 1, duration: 0.5, ease: "power3.out" }, 0.4);
    if (tagText) tl.to(tagText, { opacity: 1, y: 0, duration: 0.45, ease: "power2.out" }, 0.75);

    if (media) tl.to(media, { opacity: 1, y: 0, duration: 0.8, ease: "power3.out" }, 0.55);
    if (news) tl.to(news, { opacity: 1, y: 0, duration: 0.6, ease: "power3.out" }, 0.95);
  }

  // 1枚目のクリップワイプ・ズームは、オープニング演出の裏側で先に進んでしまうと
  // 表示直後に瞬間的に戻って見えてしまうため、表示開始のタイミングで初めて
  // (.mv__photoに.is-readyを付与して)スタートさせる
  function beginShow() {
    el.classList.add("is-ready");
    swiper.autoplay.start();
    revealContent();
  }

  var opening = document.querySelector(".js-opening");
  if (!opening) {
    beginShow();
    return;
  }

  var observer = new MutationObserver(function () {
    if (!document.body.contains(opening)) {
      observer.disconnect();
      beginShow();
    }
  });
  observer.observe(document.body, { childList: true });
})();
