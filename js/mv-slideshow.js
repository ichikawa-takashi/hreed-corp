(function () {
  var el = document.querySelector(".mv__photo");
  if (!el || typeof Swiper === "undefined") return;

  new Swiper(el, {
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
})();
