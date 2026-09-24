gsap.registerPlugin(ScrollTrigger);

(function () {
  var service = document.querySelector(".service");
  if (!service) return;

  // 透かし文字はスクロールに合わせてゆっくり横へ流れる
  var watermark = service.querySelector(".service__watermark");
  if (watermark) {
    gsap.to(watermark, {
      xPercent: -6,
      ease: "none",
      scrollTrigger: {
        trigger: service,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    });
  }

  // 番号は横からすっと現れる
  var nums = service.querySelectorAll(".service__num");
  nums.forEach(function (num) {
    gsap.set(num, { opacity: 0, x: -16 });

    gsap.to(num, {
      opacity: 1,
      x: 0,
      duration: 0.6,
      ease: "power2.out",
      scrollTrigger: {
        trigger: num,
        start: "top 90%",
        toggleActions: "play none none none",
      },
    });
  });

  // ロゴカードは弾むようにポップイン
  var logos = service.querySelectorAll(".service__logo");
  logos.forEach(function (logo) {
    gsap.set(logo, { opacity: 0, scale: 0.82, rotate: -4 });

    gsap.to(logo, {
      opacity: 1,
      scale: 1,
      rotate: 0,
      duration: 0.7,
      ease: "back.out(1.6)",
      scrollTrigger: {
        trigger: logo,
        start: "top 88%",
        toggleActions: "play none none none",
      },
    });
  });

  // 通常カードの本文はふわっと下から
  var bodies = service.querySelectorAll(".service__body:not(.service__body--wide)");
  bodies.forEach(function (body) {
    gsap.set(body, { opacity: 0, y: 32 });

    gsap.to(body, {
      opacity: 1,
      y: 0,
      duration: 0.8,
      ease: "power3.out",
      scrollTrigger: {
        trigger: body,
        start: "top 88%",
        toggleActions: "play none none none",
      },
    });
  });

  // 3枚目(クリエイティブ制作)だけ幕が下りるように現れる
  var wideBody = service.querySelector(".service__body--wide");
  if (wideBody) {
    gsap.set(wideBody, { clipPath: "inset(0% 0% 100% 0%)" });

    gsap.to(wideBody, {
      clipPath: "inset(0% 0% 0% 0%)",
      duration: 0.9,
      ease: "power3.inOut",
      scrollTrigger: {
        trigger: wideBody,
        start: "top 85%",
        toggleActions: "play none none none",
      },
    });
  }
})();
