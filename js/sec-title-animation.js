gsap.registerPlugin(ScrollTrigger);

(function () {
  var titles = document.querySelectorAll(".sec-title");
  if (!titles.length) return;

  titles.forEach(function (title) {
    var lines = title.querySelectorAll(".sec-title__en, .sec-title__ja");
    if (!lines.length) return;

    var tl = gsap.timeline({
      scrollTrigger: {
        trigger: title,
        start: "top 85%",
        toggleActions: "play none none none",
      },
    });

    lines.forEach(function (line, i) {
      var text = line.querySelector(".sec-title__text");

      // 緑（またはreverse時は白）の背景が左から右へ広がる
      tl.fromTo(
        line,
        { scaleX: 0 },
        { scaleX: 1, duration: 0.6, ease: "power3.out", transformOrigin: "left center" },
        i === 0 ? 0 : "-=0.15"
      );

      // 背景の展開に続いてテキストがふわっと現れる
      if (text) {
        tl.fromTo(
          text,
          { opacity: 0, y: 8 },
          { opacity: 1, y: 0, duration: 0.5, ease: "power2.out" },
          "-=0.2"
        );
      }
    });
  });
})();
