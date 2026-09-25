<?php get_header(); ?>

  <main>
    <?php while (have_posts()) : the_post(); ?>
    <?php
    $client = hreed_first_term(get_the_ID(), 'case_client');
    $cat    = hreed_first_term(get_the_ID(), 'case_cat');
    $cats   = get_the_terms(get_the_ID(), 'case_cat');
    $tags   = get_the_terms(get_the_ID(), 'case_tag');
    ?>
    <section class="case-hero">
      <div class="case-hero__inner inner">
        <div class="case-hero__body">
          <?php if ($cat) : ?>
          <span class="case-hero__pill"><?php echo esc_html($cat->name); ?></span>
          <?php endif; ?>
          <h2 class="case-hero__title"><?php the_title(); ?></h2>
          <p class="case-hero__meta">
            <span>作成日：<?php echo get_the_date('Y.m.d'); ?></span>
            <span>更新日：<?php echo get_the_modified_date('Y.m.d'); ?></span>
          </p>
        </div>

        <?php if (has_post_thumbnail()) : ?>
        <div class="case-hero__photo">
          <?php the_post_thumbnail('large', ['alt' => $client ? $client->name . '様' : get_the_title()]); ?>
        </div>
        <?php endif; ?>
      </div>
    </section>

    <section class="case-detail">
      <div class="case-detail__inner inner">
        <div class="case-detail__row">
          <div class="case-detail__main">
            <div class="case-overview">
              <?php if ($client) : ?>
              <h3 class="case-overview__name"><?php echo esc_html($client->name); ?></h3>
              <?php endif; ?>
              <?php if (has_excerpt()) : ?>
              <p class="case-overview__lead"><?php echo esc_html(get_the_excerpt()); ?></p>
              <?php endif; ?>

              <div class="case-overview__list">
                <?php if ($cats && !is_wp_error($cats)) : ?>
                <div class="case-overview__row">
                  <span class="case-overview__label">カテゴリ</span>
                  <span class="case-overview__value"><?php echo esc_html(implode('、', wp_list_pluck($cats, 'name'))); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($tags && !is_wp_error($tags)) : ?>
                <div class="case-overview__row">
                  <span class="case-overview__label">タグ</span>
                  <span class="case-overview__value"><?php echo esc_html(implode('、', wp_list_pluck($tags, 'name'))); ?></span>
                </div>
                <?php endif; ?>
                <div class="case-overview__row">
                  <span class="case-overview__label">公開日</span>
                  <span class="case-overview__value"><?php echo get_the_date('Y.m'); ?></span>
                </div>
              </div>
            </div>

            <div class="case-content">
              <?php the_content(); ?>
            </div>

            <div class="case-detail__back">
              <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="case-detail__back-link">
                <span class="case-detail__back-icon">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/icon-arrow_wh.svg" alt="矢印アイコン">
                </span>
                一覧に戻る
              </a>
            </div>
          </div>

          <aside class="case-detail__side">
            <?php
            $pickup = new WP_Query([
              'post_type'      => 'case',
              'posts_per_page' => 3,
              'post__not_in'   => [get_the_ID()],
            ]);
            ?>
            <?php if ($pickup->have_posts()) : ?>
            <div class="case-side">
              <h3 class="case-side__title">ピックアップ記事</h3>
              <ul class="case-side__list">
                <?php while ($pickup->have_posts()) : $pickup->the_post(); ?>
                <li class="case-side__item">
                  <a href="<?php the_permalink(); ?>" class="case-side__link">
                    <span class="case-side__thumb">
                      <?php the_post_thumbnail('medium', ['alt' => '']); ?>
                    </span>
                    <span class="case-side__item-title"><span class="case-side__item-title-clamp"><?php the_title(); ?></span></span>
                  </a>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

            <?php foreach (['case_cat' => 'カテゴリー', 'case_tag' => 'タグ'] as $taxonomy => $label) : ?>
            <?php $terms = get_terms(['taxonomy' => $taxonomy]); ?>
            <?php if ($terms && !is_wp_error($terms)) : ?>
            <div class="case-side">
              <h3 class="case-side__title"><?php echo esc_html($label); ?></h3>
              <ul class="case-side__tags">
                <?php foreach ($terms as $term) : ?>
                <li><a href="<?php echo esc_url(get_term_link($term)); ?>" class="case-side__tag"><?php echo esc_html($term->name); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
          </aside>
        </div>
      </div>
    </section>

    <?php
    // 関連記事: 同じカテゴリーの支援事例
    $related = new WP_Query([
      'post_type'      => 'case',
      'posts_per_page' => 4,
      'post__not_in'   => [get_the_ID()],
      'tax_query'      => $cat ? [[
        'taxonomy' => 'case_cat',
        'terms'    => $cat->term_id,
      ]] : [],
    ]);
    ?>
    <?php if ($related->have_posts()) : ?>
    <div class="case-related">
      <div class="case-related__inner inner">
        <div class="case-related__heading">
          <span>関連記事一覧</span>
        </div>
        <ul class="case-related__grid">
          <?php while ($related->have_posts()) : $related->the_post(); ?>
          <li>
            <?php get_template_part('template-parts/case-card', null, ['frame' => false]); ?>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php endwhile; ?>

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
