(function () {
  var el = document.querySelector(".mv__photo");
  if (!el || typeof Swiper === "undefined") return;

  var mv = document.querySelector(".mv");
  var deco = mv ? mv.querySelector(".mv__deco") : null;
  var head = mv ? mv.querySelector(".mv__head") : null;
  var tag = mv ? mv.querySelector(".mv__tag") : null;
  var media = mv ? mv.querySelector(".mv__media") : null;
  var news = mv ? mv.querySelector(".mv__news") : null;

  var swiper = new Swiper(el, {
    effect: "fade",
    fadeEffect: { crossFade: true },
    slidesPerView: 1,
    speed: 1100,
    rewind: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false,
    },
  });

  // オープニング演出中はカウントを進めず、演出終了(.js-openingの除去)後に自動再生を開始する
  swiper.autoplay.stop();

  // 見出し・タグ・写真・お知らせカードなど、FVのコンテンツをまとめてアニメーション表示する
  function revealContent() {
    if (!window.gsap) return;

    var tl = gsap.timeline();
    if (deco) tl.from(deco, { opacity: 0, duration: 1, ease: "power1.out" }, 0);
    if (head) tl.from(head, { opacity: 0, y: 30, duration: 0.7, ease: "power3.out" }, 0.15);
    if (tag) tl.from(tag, { opacity: 0, y: 20, duration: 0.6, ease: "power3.out" }, 0.35);
    if (media) tl.from(media, { opacity: 0, y: 24, duration: 0.8, ease: "power3.out" }, 0.45);
    if (news) tl.from(news, { opacity: 0, y: 16, duration: 0.6, ease: "power3.out" }, 0.85);
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
