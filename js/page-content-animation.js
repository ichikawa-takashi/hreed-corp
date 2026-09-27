gsap.registerPlugin(ScrollTrigger);

(function () {
  // 下からふわっと現れる（要素ごとに画面に入ったタイミングで再生）
  function fadeUp(selector, opts) {
    opts = opts || {};
    document.querySelectorAll(selector).forEach(function (el) {
      gsap.set(el, { opacity: 0, y: opts.y || 32 });

      gsap.to(el, {
        opacity: 1,
        y: 0,
        duration: opts.duration || 0.9,
        delay: opts.delay || 0,
        ease: "power3.out",
        scrollTrigger: {
          trigger: el,
          start: opts.start || "top 85%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  // 複数要素を順番に現れさせる（親が画面に入ったタイミングで再生）
  function staggerUp(triggerSelector, itemSelector, opts) {
    opts = opts || {};
    document.querySelectorAll(triggerSelector).forEach(function (trigger) {
      var items = trigger.querySelectorAll(itemSelector);
      if (!items.length) return;

      gsap.set(items, { opacity: 0, y: opts.y || 32 });

      gsap.to(items, {
        opacity: 1,
        y: 0,
        duration: opts.duration || 0.8,
        stagger: opts.stagger || 0.12,
        ease: "power3.out",
        scrollTrigger: {
          trigger: trigger,
          start: opts.start || "top 85%",
          toggleActions: "play none none none",
        },
      });
    });
  }

  /* ------------------------------
    About
  ------------------------------ */

  // Make Classic：左の装飾は横から、本文は段落ごとに下から
  var mcSide = document.querySelector(".about-mc__side");
  if (mcSide) {
    gsap.set(mcSide, { opacity: 0, x: -40 });

    gsap.to(mcSide, {
      opacity: 1,
      x: 0,
      duration: 1.1,
      ease: "power3.out",
      scrollTrigger: {
        trigger: ".about-mc__row",
        start: "top 80%",
        toggleActions: "play none none none",
      },
    });
  }
  fadeUp(".about-mc__text");
  fadeUp(".about-mc__lead", { y: 40, duration: 1.1 });

  // Value：スクロール量に連動して1つずつ現れる（番号の丸がポップインし、本文は丸の反対側からスライド）
  document.querySelectorAll(".about-value__item").forEach(function (item, i) {
    var circle = item.querySelector(".about-value__circle");
    var content = item.querySelector(".about-value__content");
    var fromX = i % 2 === 0 ? -48 : 48;

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 95%",
        end: "top 65%",
        scrub: 0.6,
      },
    });

    if (circle) {
      tl.fromTo(
        circle,
        { opacity: 0, scale: 0.6 },
        { opacity: 1, scale: 1, duration: 0.5, ease: "back.out(1.7)" }
      );
    }

    if (content) {
      tl.fromTo(
        content,
        { opacity: 0, x: fromX },
        { opacity: 1, x: 0, duration: 0.6, ease: "power2.out" },
        "-=0.25"
      );
    }
  });

  // Message：写真は下から、本文は少し遅れて
  fadeUp(".about-message__photo", { y: 48, duration: 1.1 });
  fadeUp(".about-message__body", { delay: 0.2 });

  // Member：カードを順番に
  staggerUp(".about-member__list", ".about-member__item", { stagger: 0.1 });

  /* ------------------------------
    Company
  ------------------------------ */

  // 会社概要テーブル：行ごとに下から
  fadeUp(".company-table__row", { y: 20, duration: 0.7, start: "top 90%" });

  // Access：地図、住所情報の順に
  fadeUp(".company-access__map iframe", { y: 40, duration: 1 });
  fadeUp(".company-access__info", { delay: 0.2 });
})();
