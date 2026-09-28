<?php get_header(); ?>

  <main>
    <?php while (have_posts()) : the_post(); ?>
    <?php
    $client = hreed_case_client();
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
          <h1 class="case-hero__title"><?php the_title(); ?></h1>
          <p class="case-hero__meta">
            <span>作成日：<?php echo get_the_date('Y.m.d'); ?></span>
            <span>更新日：<?php echo get_the_modified_date('Y.m.d'); ?></span>
          </p>
        </div>

        <?php if (has_post_thumbnail()) : ?>
        <div class="case-hero__photo">
          <?php the_post_thumbnail('large', ['alt' => $client ? $client . '様' : get_the_title()]); ?>
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
              <h3 class="case-overview__name"><?php echo esc_html($client); ?></h3>
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

            <?php
            // 前後の支援事例(並び順は管理画面の並び順に従う)
            $pager = array_filter([
              'prev' => get_previous_post(),
              'next' => get_next_post(),
            ]);
            ?>
            <?php if ($pager) : ?>
            <nav class="case-pager" aria-label="前後の支援事例">
              <?php foreach ($pager as $dir => $item) : ?>
              <div class="case-pager__item case-pager__item--<?php echo $dir; ?>">
                <a href="<?php echo esc_url(get_permalink($item)); ?>" class="case-pager__link">
                  <span class="case-pager__icon btn-more__arrow" aria-hidden="true">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
                  </span>
                  <?php if (has_post_thumbnail($item)) : ?>
                  <span class="case-pager__thumb">
                    <?php echo get_the_post_thumbnail($item, 'medium', ['alt' => '']); ?>
                  </span>
                  <?php endif; ?>
                  <span class="case-pager__body">
                    <span class="case-pager__label"><?php echo $dir === 'prev' ? 'Prev' : 'Next'; ?></span>
                    <span class="case-pager__title"><?php echo esc_html(get_the_title($item)); ?></span>
                  </span>
                </a>
              </div>
              <?php endforeach; ?>
            </nav>
            <?php endif; ?>

            <div class="case-detail__back">
              <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="case-detail__back-link">
                <span class="case-detail__back-icon btn-more__arrow" aria-hidden="true">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
                </span>
                一覧に戻る
              </a>
            </div>
          </div>

          <aside class="case-detail__side">
            <?php
            // 管理画面で「ピックアップ記事に表示」(ACF: case_pickup)をオンにした事例を表示する
            // (閲覧中の記事も除外しない。除外すると事例が少ないときにチェックした記事が出ず、枠ごと消えてしまうため)
            $pickup = new WP_Query([
              'post_type'      => 'case',
              'posts_per_page' => 3,
              'meta_key'       => 'case_pickup',
              'meta_value'     => '1',
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

    <?php get_template_part('template-parts/cta-banner'); ?>

  </main>

<?php get_footer(); ?>
