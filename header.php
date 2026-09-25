<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
<?php if (is_front_page()) : ?>
  <div class="opening js-opening" aria-hidden="true">
    <div class="js-opening-stage opening__stage"></div>

    <div class="opening__loader js-opening-loader">
      <p class="opening__loader-percent">
        <span class="js-opening-percent">0</span><span class="opening__loader-percent-sign">%</span>
      </p>
      <div class="opening__loader-bar">
        <div class="opening__loader-bar-fill js-opening-bar-fill"></div>
      </div>
    </div>
  </div>
<?php endif; ?>

  <header class="header js-header">
    <div class="header__inner">
      <h1 class="header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.svg" alt="Hreed">
        </a>
      </h1>

      <nav class="header__nav">
        <ul class="header__nav-list">
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">私たちについて</span>
              <span class="header__nav-link-en">About</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/company/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">会社概要</span>
              <span class="header__nav-link-en">Company</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/service/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">サービス</span>
              <span class="header__nav-link-en">Service</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/news/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">お知らせ</span>
              <span class="header__nav-link-en">News</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/case/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">支援事例</span>
              <span class="header__nav-link-en">Case</span>
            </a>
          </li>
          <li class="header__nav-item">
            <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="header__nav-link">
              <span class="header__nav-link-ja">採用</span>
              <span class="header__nav-link-en">Recruit</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="header__side">
        <a href="https://note.com/" class="header__note" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/icon-note.svg" alt="note">
        </a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="header__contact">
          Contact
          <span class="btn-more__arrow" aria-hidden="true">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
        </a>
      </div>

      <button type="button" class="header__hamburger js-hamburger" aria-label="メニューを開閉する">
        <span class="header__hamburger-line"></span>
        <span class="header__hamburger-line"></span>
        <span class="header__hamburger-line"></span>
      </button>
    </div>

    <div class="header__drawer js-drawer">
      <nav class="header__drawer-nav">
        <ul class="header__drawer-list">
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">私たちについて</span>
              <span class="header__drawer-link-en">About</span>
            </a>
          </li>
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/company/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">会社概要</span>
              <span class="header__drawer-link-en">Company</span>
            </a>
          </li>
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/service/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">サービス</span>
              <span class="header__drawer-link-en">Service</span>
            </a>
          </li>
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/news/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">お知らせ</span>
              <span class="header__drawer-link-en">News</span>
            </a>
          </li>
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/case/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">支援事例</span>
              <span class="header__drawer-link-en">Case</span>
            </a>
          </li>
          <li class="header__drawer-item">
            <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="header__drawer-link">
              <span class="header__drawer-link-ja">採用</span>
              <span class="header__drawer-link-en">Recruit</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="header__drawer-side">
        <a href="https://note.com/" class="header__drawer-note" target="_blank" rel="noopener noreferrer">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/icon-note.svg" alt="note">
        </a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="header__drawer-contact">
          Contact
          <span class="btn-more__arrow" aria-hidden="true">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
        </a>
      </div>
    </div>
  </header>
