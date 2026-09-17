(function () {
  var el = document.querySelector(".mv__photo");
  if (!el || typeof Swiper === "undefined") return;

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

  // 1枚目のズームは演出中(非表示の間)にも進んでしまっているため、
  // 表示開始のタイミングで一度リセットしてやり直す
  function restartActiveZoom() {
    var activeSlide = el.querySelector(".swiper-slide-active");
    if (!activeSlide) return;
    activeSlide.classList.add("is-zoom-reset");
    void activeSlide.offsetWidth; // 強制リフローでリセットを確定させる
    activeSlide.classList.remove("is-zoom-reset");
  }

  function beginShow() {
    restartActiveZoom();
    swiper.autoplay.start();
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
