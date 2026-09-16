gsap.registerPlugin(ScrollTrigger);

(function () {
  var head = document.querySelector(".lower-mv__head");
  if (!head) return;

  var lines = head.querySelectorAll(".lower-mv__tag, .lower-mv__heading");
  if (!lines.length) return;

  var tl = gsap.timeline({
    scrollTrigger: {
      trigger: head,
      start: "top 90%",
      once: true,
    },
  });

  lines.forEach(function (line, i) {
    var text = line.querySelector(".lower-mv__text");

    // 緑の背景が左から右へ広がる
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
})();
