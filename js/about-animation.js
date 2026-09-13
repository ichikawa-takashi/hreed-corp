gsap.registerPlugin(ScrollTrigger);

(function () {
  var aboutSection = document.querySelector(".about");
  if (!aboutSection) return;

  // 線が描画されるアニメーション（あしらいのSVG）
  var drawTargets = aboutSection.querySelectorAll(".js-draw");

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
        trigger: aboutSection,
        start: "top 70%",
        once: true,
      },
    });
  });

  // テキスト・写真・ボタンのフェードイン
  gsap.from([".about__head", ".about__text", ".about__more"], {
    y: 40,
    opacity: 0,
    duration: 1,
    stagger: 0.15,
    ease: "power3.out",
    scrollTrigger: {
      trigger: ".about__body",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".about__photo--1", {
    y: 60,
    opacity: 0,
    duration: 1.1,
    ease: "power3.out",
    scrollTrigger: {
      trigger: ".about__photos",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".about__photo--2", {
    y: 60,
    opacity: 0,
    duration: 1.1,
    delay: 0.2,
    ease: "power3.out",
    scrollTrigger: {
      trigger: ".about__photos",
      start: "top 80%",
      once: true,
    },
  });

  // パララックス（写真とあしらいが異なる速度で動くゴージャスな見え方）
  gsap.to(".about__photo--1", {
    yPercent: -8,
    ease: "none",
    scrollTrigger: {
      trigger: ".about",
      start: "top bottom",
      end: "bottom top",
      scrub: true,
    },
  });

  gsap.to(".about__photo--2", {
    yPercent: 10,
    ease: "none",
    scrollTrigger: {
      trigger: ".about",
      start: "top bottom",
      end: "bottom top",
      scrub: true,
    },
  });

  gsap.to(".about__deco-svg--top", {
    yPercent: -14,
    ease: "none",
    scrollTrigger: {
      trigger: ".about",
      start: "top bottom",
      end: "bottom top",
      scrub: true,
    },
  });

  gsap.to(".about__deco-svg--bottom", {
    yPercent: 16,
    ease: "none",
    scrollTrigger: {
      trigger: ".about",
      start: "top bottom",
      end: "bottom top",
      scrub: true,
    },
  });
})();
