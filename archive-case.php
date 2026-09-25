<?php get_header(); ?>

  <main>
    <section class="lower-mv">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text">Case</span></span>
          <h2 class="lower-mv__heading"><span class="lower-mv__text">支援事例</span></h2>
        </div>

        <div class="lower-mv__photo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/top/case-photo-systemrenovate.jpg" alt="Caseページメインビュー">
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

    <section class="case-list">
      <div class="case-list__inner inner">
        <ul class="case-list__filter">
          <li>
            <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="case-list__filter-link<?php echo is_post_type_archive('case') ? ' is-active' : ''; ?>">すべて</a>
          </li>
          <?php foreach (get_terms(['taxonomy' => 'case_cat', 'hide_empty' => false]) as $term) : ?>
          <li>
            <a href="<?php echo esc_url(get_term_link($term)); ?>" class="case-list__filter-link<?php echo is_tax('case_cat', $term->term_id) ? ' is-active' : ''; ?>"><?php echo esc_html($term->name); ?></a>
          </li>
          <?php endforeach; ?>
        </ul>

        <?php if (have_posts()) : ?>
        <?php
        // 2列に振り分ける(左→右の順に交互に並べる)
        $cols = [[], []];
        $i    = 0;
        while (have_posts()) {
          the_post();
          $cols[$i++ % 2][] = $post;
        }
        ?>
        <div class="case-list__grid case__grid">
          <?php foreach ($cols as $col) : ?>
          <div class="case__col">
            <?php foreach ($col as $post) : setup_postdata($post); ?>
            <?php get_template_part('template-parts/case-card'); ?>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p class="case-list__empty">支援事例はまだありません。</p>
        <?php endif; ?>

        <?php hreed_pagination('case'); ?>
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
