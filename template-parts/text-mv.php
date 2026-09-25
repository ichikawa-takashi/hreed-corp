<?php
// テキストのみのページ(プライバシーポリシー・利用規約・サイトポリシーなど)共通のMV
// 使い方: get_template_part('template-parts/text-mv', null, ['en' => 'Privacy Policy', 'ja' => 'プライバシーポリシー']);
?>
    <section class="lower-mv lower-mv--text">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text"><?php echo esc_html($args['en']); ?></span></span>
          <h2 class="lower-mv__heading"><span class="lower-mv__text"><?php echo esc_html($args['ja']); ?></span></h2>
        </div>

        <svg width="170" height="141" viewBox="0 0 170 141" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--02" aria-hidden="true">
          <path class="js-draw" d="M75.825 70.297V0.5H150.15V74.825H106.614V106.614H0.5V70.297Z" stroke="#0C998A"/>
          <circle class="js-draw" cx="150.5" cy="121.143" r="19" stroke="#0C998A"/>
        </svg>
        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--03" aria-hidden="true">
          <rect class="js-draw" x="0.5" y="0.5" width="43" height="43" stroke="#0C998A"/>
        </svg>
        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--04" aria-hidden="true">
          <circle class="js-draw" cx="28" cy="28" r="27.5" stroke="#0C998A"/>
        </svg>
      </div>
    </section>
