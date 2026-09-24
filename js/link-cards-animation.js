gsap.registerPlugin(ScrollTrigger);

(function () {
  var linkCards = document.querySelector(".link-cards");
  if (!linkCards) return;

  // カードは写真がズームアウトして落ち着きながら現れる
  var items = linkCards.querySelectorAll(".link-cards__item");
  items.forEach(function (item) {
    var photoImg = item.querySelector(".link-cards__photo img");
    var foot = item.querySelector(".link-cards__foot");

    gsap.set(item, { opacity: 0, y: 40 });
    if (photoImg) gsap.set(photoImg, { scale: 1.25 });
    if (foot) gsap.set(foot, { opacity: 0, y: 16 });

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 85%",
        once: true,
      },
    });

    tl.to(item, { opacity: 1, y: 0, duration: 0.8, ease: "power3.out" }, 0);
    if (photoImg) {
      tl.to(photoImg, { scale: 1, duration: 1.1, ease: "power2.out" }, 0);
    }
    if (foot) {
      tl.to(foot, { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" }, 0.15);
    }
  });

  // 装飾はスクロールでそれぞれ違う速度でふわっと漂う(このページに装飾がある場合のみ)
  var decos = linkCards.querySelectorAll(".link-cards__deco");
  decos.forEach(function (deco, i) {
    var speed = 8 + (i % 3) * 6;
    gsap.to(deco, {
      yPercent: i % 2 === 0 ? -speed : speed,
      ease: "none",
      scrollTrigger: {
        trigger: linkCards,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    });
  });

  // マグネティックボタン(カーソルに矢印が少し寄る)
  var isFinePointer = window.matchMedia("(pointer: fine)").matches;
  if (!isFinePointer) return;

  linkCards.querySelectorAll(".link-cards__card").forEach(function (card) {
    var arrow = card.querySelector(".arrow-btn");
    if (!arrow) return;

    card.addEventListener("mousemove", function (e) {
      var rect = card.getBoundingClientRect();
      var relX = (e.clientX - rect.left) / rect.width - 0.5;
      var relY = (e.clientY - rect.top) / rect.height - 0.5;

      gsap.to(arrow, {
        x: relX * 14,
        y: relY * 14,
        duration: 0.4,
        ease: "power2.out",
      });
    });

    card.addEventListener("mouseleave", function () {
      gsap.to(arrow, { x: 0, y: 0, duration: 0.5, ease: "power3.out" });
    });
  });
})();
