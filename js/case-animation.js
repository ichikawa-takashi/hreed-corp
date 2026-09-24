gsap.registerPlugin(ScrollTrigger);

(function () {
  var caseSection = document.querySelector(".case");
  if (!caseSection) return;

  // 透かし文字のパララックス
  var watermark = caseSection.querySelector(".case__watermark");
  if (watermark) {
    gsap.to(watermark, {
      yPercent: -12,
      ease: "none",
      scrollTrigger: {
        trigger: caseSection,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    });
  }

  var cols = caseSection.querySelectorAll(".case__col");

  cols.forEach(function (col) {
    var isOffset = col.classList.contains("case__col--offset");
    var cards = col.querySelectorAll(".case__card");

    // offset列(下段)は少し違うリズム・速度にして、隣の列と単調にならないようにする
    cards.forEach(function (card) {
      var photo = card.querySelector(".case__photo");
      var pill = card.querySelector(".case__pill");

      gsap.set(card, {
        clipPath: "inset(0% 0% 100% 0%)",
        rotate: isOffset ? -1.2 : 0,
      });
      if (photo) gsap.set(photo, { scale: 1.15 });
      if (pill) gsap.set(pill, { opacity: 0, y: 6, scale: 0.85 });

      var tl = gsap.timeline({
        scrollTrigger: {
          trigger: card,
          start: "top 88%",
          once: true,
        },
      });

      tl.to(
        card,
        {
          clipPath: "inset(0% 0% 0% 0%)",
          rotate: 0,
          duration: isOffset ? 1.05 : 0.85,
          ease: isOffset ? "power4.out" : "power3.out",
          // アニメーション完了後もclip-path/rotateのinline styleが残ると、
          // 合成レイヤー化した.case__cardの境界でアンチエイリアシングにより
          // 内部要素(border: 1px solid $green)の縁がうっすら二重に見えるため、
          // 完了後はinline styleを除去して素の状態に戻す
          clearProps: "clipPath,rotate",
        },
        0
      );

      if (photo) {
        tl.to(
          photo,
          {
            scale: 1,
            duration: isOffset ? 1.2 : 1,
            ease: "power2.out",
          },
          0
        );
      }

      if (pill) {
        tl.to(
          pill,
          {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.5,
            ease: "back.out(1.7)",
          },
          "-=0.35"
        );
      }
    });

    // offset列は少し速く視差をつけて、浮いているような奥行きを出す
    if (isOffset) {
      gsap.to(col, {
        yPercent: -6,
        ease: "none",
        scrollTrigger: {
          trigger: caseSection,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
        },
      });
    }
  });
})();
