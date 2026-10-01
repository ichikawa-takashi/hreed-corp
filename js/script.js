jQuery(function ($) { // この中であればWordpressでも「$」が使用可能になる

    var topBtn = $('.pagetop');
    topBtn.hide();

    // ボタンの表示設定
    $(window).scroll(function () {
        if ($(this).scrollTop() > 70) {
            // 指定px以上のスクロールでボタンを表示
            topBtn.fadeIn();
        } else {
            // 画面が指定pxより上ならボタンを非表示
            topBtn.fadeOut();
        }
    });

    // ボタンをクリックしたらスクロールして上に戻る
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 300, 'swing');
        return false;
    });

    // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)
    $(document).on('click', 'a[href*="#"]', function () {
        let time = 400;
        let header = $('header').innerHeight();
        let target = $(this.hash);
        if (!target.length) return;
        let targetY = target.offset().top - header;
        $('html,body').animate({
            scrollTop: targetY
        }, time, 'swing');
        return false;
    });

    // ハンバーガーメニュー
    $(function () {
        $(".js-hamburger").click(function () {
            $(this).toggleClass("is-open");
            if ($(this).hasClass("is-open")) {
                openDrawer();
            } else {
                closeDrawer();
            }
        });

        // backgroundまたはページ内リンクをクリックで閉じる
        $(".js-drawer a[href]").on("click", function () {
            closeDrawer();
        });

        // resizeイベント
        $(window).on('resize', function () {
            if (window.matchMedia("(min-width: 768px)").matches) {
                closeDrawer();
            }
        });
    });

    function openDrawer() {
        $(".js-drawer").addClass("is-open");
        $(".js-hamburger").addClass("is-open");
        $("body").addClass("is-drawer-open");
    }

    function closeDrawer() {
        $(".js-drawer").removeClass("is-open");
        $(".js-hamburger").removeClass("is-open");
        $("body").removeClass("is-drawer-open");
    }

    // modal
    $(".js-modal-open").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            var target = $(this).data("target");
            var modal = document.getElementById(target);
            $(modal).fadeIn();
            $("html,body").css("overflow", "hidden");
        });
    });
    $(".js-modal-close").on("click", function () {
        $(".js-modal").fadeOut();
        $("html,body").css("overflow", "initial");
    });

    // モーダルを開いたまま前後のメンバーに切り替える(端まで行ったら反対側へループ)
    function switchModal(step) {
        var modals = $(".js-modal");
        var current = modals.filter(":visible").first();
        if (!current.length) return;
        var next = modals.eq((modals.index(current) + step + modals.length) % modals.length);
        current.stop(true, true).hide();
        next.show();
        next.find(".modal__inner, .modal__info").scrollTop(0);
        next.find(".modal__inner").css("opacity", 0).animate({ opacity: 1 }, 250);
    }
    $(".js-modal-prev").on("click", function () {
        switchModal(-1);
    });
    $(".js-modal-next").on("click", function () {
        switchModal(1);
    });
    $(document).on("keydown", function (e) {
        if (!$(".js-modal:visible").length) return;
        if (e.key === "ArrowLeft") switchModal(-1);
        if (e.key === "ArrowRight") switchModal(1);
    });

    // FAQ アコーディオン
    $(".js-faq-question").on("click", function () {
        var item = $(this).closest(".faq__item");
        var answer = item.find(".faq__answer");

        item.toggleClass("is-open");
        $(this).attr("aria-expanded", item.hasClass("is-open"));
        answer.stop().slideToggle(300);
    });

    // 採用ページのエントリーボタン・ハラスメント防止方針の相談窓口リンクから来たときは、お問い合わせの種別を選択済みにしておく
    var subjectParams = { recruit: "採用について", harassment: "就活ハラスメント相談窓口" };
    var subject = subjectParams[new URLSearchParams(location.search).get("subject")];
    var subjectSelect = $("#your-subject");
    if (subject && subjectSelect.find('option[value="' + subject + '"]').length) {
        subjectSelect.val(subject).trigger("change");
    }
});


/* ==================================================
*  headerカラー変更
================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector(".header");
    const lowerMv = document.querySelector(".lower-mv");
    const fvHeight = lowerMv ? lowerMv.offsetHeight : header.offsetHeight; // FVの高さ（mvがないページはheader分でスクロール判定）

    window.addEventListener("scroll", () => {
        if (window.scrollY > fvHeight) {
            header.classList.add("is-scrolled");
        } else {
            header.classList.remove("is-scrolled");
        }
    });
});