<?php get_header(); ?>

  <main>
    <?php while (have_posts()) : the_post(); ?>
    <section class="single-news">
      <div class="single-news__inner inner">
        <div class="single-news__meta">
          <time class="single-news__date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
          <?php if ($cat = hreed_first_term(get_the_ID(), 'category')) : ?>
          <span class="single-news__tag"><?php echo esc_html($cat->name); ?></span>
          <?php endif; ?>
        </div>

        <h1 class="single-news__title"><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
        <div class="single-news__thumb">
          <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
        </div>
        <?php endif; ?>

        <div class="single-news__contents">
          <?php the_content(); ?>
        </div>

        <div class="single-news__back">
          <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="single-news__back-link">
            <span class="single-news__back-icon btn-more__arrow" aria-hidden="true">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
            </span>
            お知らせ一覧へ戻る
          </a>
        </div>
      </div>
    </section>
    <?php endwhile; ?>
  </main>

<?php get_footer(); ?>
