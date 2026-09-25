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
          <path class="js-draw" d="M54.838 46.5V123.5H28.664V100.352H0.5V46.5Z" stroke="#0C998A"/>
          <rect class="js-draw" x="0.5" y="0.5" width="25" height="25" stroke="#0C998A"/>
        </svg>
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
