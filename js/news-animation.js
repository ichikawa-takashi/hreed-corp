gsap.registerPlugin(ScrollTrigger);

(function () {
  var news = document.querySelector(".news");
  if (!news) return;

  // 透かし文字のパララックス
  var watermark = news.querySelector(".news__watermark");
  if (watermark) {
    gsap.to(watermark, {
      xPercent: 6,
      ease: "none",
      scrollTrigger: {
        trigger: news,
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    });
  }

  // サイドの見出し・フィルター・ボタンはまとめてふわっと
  var side = news.querySelector(".news__side");
  if (side) {
    var sideTargets = side.querySelectorAll(".news__head, .news__filter, .news__more");
    gsap.set(sideTargets, { opacity: 0, y: 24 });

    gsap.to(sideTargets, {
      opacity: 1,
      y: 0,
      duration: 0.8,
      stagger: 0.1,
      ease: "power3.out",
      scrollTrigger: {
        trigger: side,
        start: "top 85%",
        toggleActions: "play none none none",
      },
    });
  }

  // リスト項目は左右交互にスライドして単調にならないようにする
  // (最初に表示されている「すべて」のパネルのみ。切り替え後のパネルは下の処理で表示する)
  var items = news.querySelectorAll(".news__panel:not([hidden]) .news__item, .news__panel:not([hidden]) .news__empty");
  items.forEach(function (item, i) {
    var fromX = i % 2 === 0 ? -24 : 24;
    gsap.set(item, { opacity: 0, x: fromX });

    gsap.to(item, {
      opacity: 1,
      x: 0,
      duration: 0.6,
      ease: "power3.out",
      scrollTrigger: {
        trigger: item,
        start: "top 92%",
        toggleActions: "play none none none",
      },
    });
  });

  // カテゴリーのラジオボタンで表示するパネルを切り替え、「一覧を見る」のリンク先も合わせる
  var more = news.querySelector(".news__more");
  var panels = news.querySelectorAll(".news__panel");
  news.querySelectorAll(".news__filter-input").forEach(function (input) {
    input.addEventListener("change", function () {
      if (!input.checked) return;
      if (more && input.dataset.link) more.setAttribute("href", input.dataset.link);

      panels.forEach(function (panel) {
        var isTarget = panel.dataset.newsPanel === input.value;
        panel.hidden = !isTarget;
        if (!isTarget) return;

        var targets = panel.querySelectorAll(".news__item, .news__empty");
        gsap.fromTo(
          targets,
          { opacity: 0, y: 12 },
          { opacity: 1, y: 0, duration: 0.5, stagger: 0.06, ease: "power3.out", overwrite: true }
        );
      });
      ScrollTrigger.refresh();
    });
  });
})();
