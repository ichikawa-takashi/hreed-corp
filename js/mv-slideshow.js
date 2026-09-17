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

  var opening = document.querySelector(".js-opening");
  if (!opening) {
    swiper.autoplay.start();
    return;
  }

  var observer = new MutationObserver(function () {
    if (!document.body.contains(opening)) {
      observer.disconnect();
      swiper.autoplay.start();
    }
  });
  observer.observe(document.body, { childList: true });
})();
