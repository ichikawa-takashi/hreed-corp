gsap.registerPlugin(ScrollTrigger);

// Service / Serviceページの特長 / リンクカード / お問い合わせCTA の背景画像、About代表写真のパララックス
// セクションが画面下から入って上へ抜けるまでの間、背景画像のトリミング位置を
// 少しずつずらす(scrubでスクロール量をそのまま反映するので、戻しても破綻しない)
(function () {
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  // 背景が<img>の箇所: 少し拡大してはみ出した分の範囲で上下に動かす
  var SCALE = 1.2;
  var SHIFT = ((SCALE - 1) / 2) * 100; // はみ出し量(片側・要素の高さに対する%)

  var imgTargets = [
    { section: ".service", bg: ".service__bg-img" },
    { section: ".feature", bg: ".feature__bg-img" },
    { section: ".cta-banner", bg: ".cta-banner__bg" },
    { section: ".about-message__photo-frame", bg: ".about-message__photo-img" },
  ];

  imgTargets.forEach(function (target) {
    document.querySelectorAll(target.section).forEach(function (section) {
      var bg = section.querySelector(target.bg);
      if (!bg) return;

      gsap.fromTo(
        bg,
        { scale: SCALE, yPercent: -SHIFT },
        {
          scale: SCALE,
          yPercent: SHIFT,
          ease: "none",
          scrollTrigger: {
            trigger: section,
            start: "top bottom",
            end: "bottom top",
            scrub: true,
          },
        }
      );
    });
  });

  // リンクカード: 背景はCSSの疑似要素(上下10%ずつ大きい)なので、CSS変数で動かす
  document.querySelectorAll(".link-cards").forEach(function (section) {
    var range = function () {
      return section.offsetHeight * 0.1;
    };

    gsap.fromTo(
      section,
      {
        "--parallax-y": function () {
          return -range() + "px";
        },
      },
      {
        "--parallax-y": function () {
          return range() + "px";
        },
        ease: "none",
        scrollTrigger: {
          trigger: section,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
          invalidateOnRefresh: true,
        },
      }
    );
  });
})();
