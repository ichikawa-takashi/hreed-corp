<?php
// ページ下部の関連ページへのリンクカード(トップ・About・Company・Serviceで共通)
// 使い方: get_template_part('template-parts/link-cards', null, ['cards' => ['company', 'recruit']]);
// cards を省略した場合は Service / Recruit を表示する
$link_cards_all = [
  'service' => ['url' => home_url('/service/'), 'img' => 'common/link-service.jpg', 'en' => 'Service', 'ja' => 'サービス'],
  'company' => ['url' => home_url('/company/'), 'img' => 'common/mv-photo.jpg', 'en' => 'Company', 'ja' => '会社概要'],
  'recruit' => ['url' => home_url('/recruit/'), 'img' => 'common/link-recruit.jpg', 'en' => 'Recruit', 'ja' => '採用情報'],
];
$link_cards = $args['cards'] ?? ['service', 'recruit'];
$theme_uri  = get_template_directory_uri();
?>
    <section class="link-cards">
      <div class="link-cards__inner inner">
        <ul class="link-cards__list">
          <?php foreach ($link_cards as $key) : $card = $link_cards_all[$key]; ?>
          <li class="link-cards__item">
            <a href="<?php echo esc_url($card['url']); ?>" class="link-cards__card">
              <div class="link-cards__photo">
                <img src="<?php echo $theme_uri; ?>/img/<?php echo $card['img']; ?>" alt="">
              </div>
              <div class="link-cards__foot">
                <div class="sec-title sec-title--reverse">
                  <h3 class="sec-title__en"><span class="sec-title__text"><?php echo esc_html($card['en']); ?></span></h3>
                  <p class="sec-title__ja"><span class="sec-title__text"><?php echo esc_html($card['ja']); ?></span></p>
                </div>
                <span class="btn-more__arrow" aria-hidden="true">
                  <img src="<?php echo $theme_uri; ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                  <img src="<?php echo $theme_uri; ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
                </span>
              </div>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <img src="<?php echo $theme_uri; ?>/img/common/link-deco01.png" alt="" class="link-cards__deco link-cards__deco--01">
      <img src="<?php echo $theme_uri; ?>/img/common/link-deco02.png" alt="" class="link-cards__deco link-cards__deco--02">
      <img src="<?php echo $theme_uri; ?>/img/common/link-deco03.png" alt="" class="link-cards__deco link-cards__deco--03">
      <img src="<?php echo $theme_uri; ?>/img/common/link-deco04.png" alt="" class="link-cards__deco link-cards__deco--04">
      <img src="<?php echo $theme_uri; ?>/img/common/link-deco05.png" alt="" class="link-cards__deco link-cards__deco--05">
    </section>
