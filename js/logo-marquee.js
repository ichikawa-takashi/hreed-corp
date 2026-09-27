(function () {
  var el = document.querySelector(".js-logo-marquee");
  if (!el || typeof Swiper === "undefined") return;

  // 1秒あたりに流れる距離(px)
  var PX_PER_SEC = 50;

  // ロゴの横幅がそれぞれ異なるため、スライド1枚分の移動時間を幅に応じて変え、
  // 流れる速さを一定に保つ(autoplayは次の移動を始める時点のparams.speedを使う)
  function syncSpeed(swiper) {
    var slide = swiper.slides[swiper.activeIndex];
    if (!slide) return;
    var distance = slide.offsetWidth + swiper.params.spaceBetween;
    swiper.params.speed = (distance / PX_PER_SEC) * 1000;
  }

  function init() {
    var swiper = new Swiper(el, {
      slidesPerView: "auto",
      spaceBetween: 40,
      loop: true,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
      },
      breakpoints: {
        768: { spaceBetween: 64 },
      },
      on: {
        transitionStart: syncSpeed,
        breakpoint: syncSpeed,
      },
    });

    // 視差効果を減らす設定の環境では流さない
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      swiper.autoplay.stop();
      return;
    }

    // 1枚目の移動から一定速度にするため、速度を合わせてから自動再生を始め直す
    swiper.autoplay.stop();
    syncSpeed(swiper);
    swiper.autoplay.start();
  }

  // ロゴ画像の読み込み前は横幅が確定せず速度を計算できないため、読み込み完了後に開始する
  if (document.readyState === "complete") {
    init();
  } else {
    window.addEventListener("load", init);
  }
})();
