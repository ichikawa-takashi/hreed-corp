<?php get_header(); ?>

  <main>
    <section class="lower-mv">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text">News</span></span>
          <h2 class="lower-mv__heading"><span class="lower-mv__text">お知らせ</span></h2>
        </div>

        <div class="lower-mv__photo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/news/mv-photo.jpg" alt="Newsページメインビュー">
        </div>

        <svg width="56" height="124" viewBox="0 0 56 124" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--01" aria-hidden="true">
          <path class="js-draw" d="M55.3379 46V124H28.1641V100.852H0V46H55.3379ZM29.1641 123H54.3379V47H1V99.8516H29.1641V123Z" fill="#0C998A" stroke="#0C998A"/>
          <path d="M26 0V26H0V0H26ZM1 25H25V1H1V25Z" fill="#0C998A"/>
        </svg>
        <svg width="170" height="141" viewBox="0 0 170 141" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--02" aria-hidden="true">
          <path class="js-draw" d="M75.3252 69.7969V0H150.65V75.3252H107.114V107.114H0V69.7969H75.3252ZM76.3252 70.7969H1V106.114H106.114V74.3252H149.65V1H76.3252V70.7969Z" fill="#0C998A" stroke="#0C998A"/>
          <path d="M169 121.143C169 110.925 160.717 102.643 150.5 102.643C140.283 102.643 132 110.925 132 121.143C132 131.36 140.283 139.643 150.5 139.643V140.643C139.73 140.643 131 131.912 131 121.143C131 110.373 139.73 101.643 150.5 101.643C161.27 101.643 170 110.373 170 121.143C170 131.912 161.27 140.643 150.5 140.643V139.643C160.717 139.643 169 131.36 169 121.143Z" fill="#0C998A"/>
        </svg>
        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--03" aria-hidden="true">
          <rect class="js-draw" x="0.5" y="0.5" width="43" height="43" stroke="#0C998A"/>
        </svg>
        <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg" class="lower-mv__deco lower-mv__deco--04" aria-hidden="true">
          <circle class="js-draw" cx="28" cy="28" r="27.5" stroke="#0C998A"/>
        </svg>
      </div>
    </section>

    <section class="news-list">
      <div class="news-list__inner inner">
        <ul class="news-list__filter">
          <li>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="news-list__filter-link<?php echo is_home() ? ' is-active' : ''; ?>">すべて</a>
          </li>
          <?php foreach (get_categories(['hide_empty' => false]) as $cat) : ?>
          <li>
            <a href="<?php echo esc_url(get_category_link($cat)); ?>" class="news-list__filter-link<?php echo is_category($cat->term_id) ? ' is-active' : ''; ?>"><?php echo esc_html($cat->name); ?></a>
          </li>
          <?php endforeach; ?>
        </ul>

        <?php if (have_posts()) : ?>
        <ul class="news-list__items">
          <?php while (have_posts()) : the_post(); ?>
          <li class="news-list__item">
            <a href="<?php the_permalink(); ?>" class="news-list__link">
              <div class="news-list__wrap">
                <time class="news-list__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
                <?php if ($cat = hreed_first_term(get_the_ID(), 'category')) : ?>
                <span class="news-list__tag"><?php echo esc_html($cat->name); ?></span>
                <?php endif; ?>
              </div>
              <span class="news-list__title"><?php the_title(); ?></span>
              <span class="news-list__arrow"></span>
            </a>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php else : ?>
        <p class="news-list__empty">お知らせはまだありません。</p>
        <?php endif; ?>

        <?php hreed_pagination('news'); ?>
      </div>
    </section>

    <section class="cta-banner">
      <div class="cta-banner__inner inner">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-banner__link">
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/service-bg.jpg" alt="お問い合わせ背景" class="cta-banner__bg">

          <div class="cta-banner__wrapper">
            <div class="sec-title sec-title--reverse cta-banner__title">
              <h2 class="sec-title__en"><span class="sec-title__text">Contact us</span></h2>
              <p class="sec-title__ja"><span class="sec-title__text">お問い合わせ</span></p>
            </div>

            <div class="cta-banner__note">
              <p class="cta-banner__text">採用にお困りの方はこちらから</p>
              <span class="btn-more__arrow" aria-hidden="true">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
              </span>
            </div>
          </div>
        </a>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
