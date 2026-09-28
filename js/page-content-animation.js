gsap.registerPlugin(ScrollTrigger);

(function () {
  // 下からふわっと現れる（要素ごとに画面に入ったタイミングで再生）
  function fadeUp(selector, opts) {
    opts = opts || {};
    document.querySelectorAll(selector).forEach(function (el) {
      gsap.set(el, { opacity: 0, y: opts.y || 32, visibility: "visible" });

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

      gsap.set(items, { opacity: 0, y: opts.y || 32, visibility: "visible" });

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
    gsap.set(mcSide, { opacity: 0, x: -40, visibility: "visible" });

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

  /* ------------------------------
    Service
  ------------------------------ */

  // リード：見出し・本文を下から、区切り線は左から伸ばし、ロゴは最後に
  // PCではMVのすぐ下で最初から画面内に入っているため、スクロールトリガーだけだと
  // 読み込み直後に再生が終わってしまう。最初にスクロールされるまで再生を待つ
  var lead = document.querySelector(".service-lead");
  if (lead) {
    var leadHeading = lead.querySelector(".service-lead__heading");
    var leadText = lead.querySelector(".service-lead__text");
    var leadDivider = lead.querySelector(".service-lead__divider");
    var leadLogos = lead.querySelector(".service-lead__logos");

    var leadTl = gsap.timeline({ paused: true });

    if (leadHeading) {
      leadTl.fromTo(
        leadHeading,
        { opacity: 0, y: 40 },
        { opacity: 1, y: 0, duration: 1.1, ease: "power3.out" },
        0
      );
    }

    if (leadText) {
      leadTl.fromTo(
        leadText,
        { opacity: 0, y: 32 },
        { opacity: 1, y: 0, duration: 0.9, ease: "power3.out" },
        0.15
      );
    }

    if (leadDivider) {
      leadTl.fromTo(
        leadDivider,
        { scaleX: 0, transformOrigin: "left center" },
        { scaleX: 1, duration: 1, ease: "power3.inOut" },
        0.3
      );
    }

    if (leadLogos) {
      leadTl.fromTo(
        leadLogos,
        { opacity: 0, y: 32 },
        { opacity: 1, y: 0, duration: 0.9, ease: "power3.out" },
        0.4
      );
    }

    // 初期状態をセットしてから、CSSで隠していた要素を表示する
    gsap.set([leadHeading, leadText, leadDivider, leadLogos].filter(Boolean), { visibility: "visible" });

    ScrollTrigger.create({
      trigger: lead,
      start: "top 85%",
      once: true,
      onEnter: function () {
        whenScrolled(function () {
          leadTl.play();
        });
      },
    });
  }

  // すでにスクロール済みならすぐ、そうでなければ最初のスクロールで実行する
  function whenScrolled(callback) {
    if (window.scrollY > 0) {
      callback();
      return;
    }

    window.addEventListener("scroll", callback, { once: true, passive: true });
  }

  // Worry：アイコンがポップインし、吹き出しはアイコン側から横にスライド
  fadeUp(".worry__tag", { y: 20 });

  document.querySelectorAll(".worry__item").forEach(function (item) {
    var icon = item.querySelector(".worry__icon");
    var card = item.querySelector(".worry__card");
    var fromX = item.classList.contains("worry__item--reverse") ? 40 : -40;

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 88%",
        toggleActions: "play none none none",
      },
    });

    if (icon) {
      tl.fromTo(
        icon,
        { opacity: 0, scale: 0.6 },
        { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" }
      );
    }

    if (card) {
      tl.fromTo(
        card,
        { opacity: 0, x: fromX },
        { opacity: 1, x: 0, duration: 0.8, ease: "power3.out" },
        "-=0.35"
      );
    }
  });

  // Approach：見出し→リード→流れの順に下から、タグは順番に
  fadeUp(".approach__head", { y: 40, duration: 1.1 });
  fadeUp(".approach__lead", { delay: 0.15 });
  fadeUp(".approach__flow", { delay: 0.25 });
  staggerUp(".approach__tags", ".approach__tag", { y: 20, stagger: 0.1 });

  // Feature：写真は上から幕が下りるように現れて番号がポップイン、本文は下から
  document.querySelectorAll(".feature__item").forEach(function (item) {
    var photo = item.querySelector(".feature__photo");
    var img = photo ? photo.querySelector("img") : null;
    var num = item.querySelector(".feature__num");
    var body = item.querySelector(".feature__body");

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 82%",
        toggleActions: "play none none none",
      },
    });

    if (img) {
      tl.fromTo(
        img,
        { clipPath: "inset(0% 0% 100% 0%)" },
        {
          clipPath: "inset(0% 0% 0% 0%)",
          duration: 1.1,
          ease: "power3.out",
          clearProps: "clipPath",
        },
        0
      );
    }

    if (num) {
      tl.fromTo(
        num,
        { opacity: 0, scale: 0.5 },
        { opacity: 1, scale: 1, duration: 0.6, ease: "back.out(1.7)" },
        0.5
      );
    }

    if (body) {
      tl.fromTo(
        body,
        { opacity: 0, y: 32 },
        { opacity: 1, y: 0, duration: 0.9, ease: "power3.out" },
        0.25
      );
    }
  });

  // Flow：スクロール量に連動してステップが1つずつ現れる（番号の丸がポップインし、本文は下から）
  document.querySelectorAll(".flow__item").forEach(function (item) {
    var circle = item.querySelector(".flow__num-circle");
    var arrow = item.querySelector(".flow__num-arrow");
    var body = item.querySelector(".flow__body");

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: item,
        start: "top 92%",
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

    if (body) {
      tl.fromTo(
        body,
        { opacity: 0, y: 24 },
        { opacity: 1, y: 0, duration: 0.6, ease: "power2.out" },
        "-=0.25"
      );
    }

    if (arrow) {
      tl.fromTo(
        arrow,
        { opacity: 0, y: -8 },
        { opacity: 1, y: 0, duration: 0.4, ease: "power2.out" }
      );
    }
  });

  // FAQ：質問を順番に
  staggerUp(".faq__list", ".faq__item", { y: 24, stagger: 0.08 });
})();
