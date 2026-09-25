<?php get_header(); ?>

  <main>
  <!-- ================= MV ================= -->
  <section class="mv">
    <img class="mv__deco" src="<?php echo get_template_directory_uri(); ?>/img/top/mv-deco.svg" alt="" aria-hidden="true">

    <div class="mv__inner">
      <h1 class="mv__head"><span class="mv__head-text">Make Classic</span></h1>

      <div class="mv__row">
        <p class="mv__tag"><span class="mv__tag-text">次のスタンダードを作る</span></p>

        <div class="mv__media">
          <div class="mv__photo swiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide mv__photo-slide">
                <img class="mv__photo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/mv-photo.jpg" alt="Hreedのオフィス風景">
              </div>
              <div class="swiper-slide mv__photo-slide">
                <img class="mv__photo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/mv-photo-reception.jpg" alt="Hreedのオフィス風景">
              </div>
              <div class="swiper-slide mv__photo-slide">
                <img class="mv__photo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/mv-photo-meeting.jpg" alt="Hreedのオフィス風景">
              </div>
            </div>
          </div>

          <?php $latest = get_posts(['posts_per_page' => 1]); ?>
          <?php if ($latest) : $latest = $latest[0]; ?>
          <a href="<?php echo esc_url(get_permalink($latest)); ?>" class="mv__news">
            <div class="mv__news-meta">
              <time class="mv__news-date" datetime="<?php echo get_the_date('Y-m-d', $latest); ?>"><?php echo get_the_date('Y.m.d', $latest); ?></time>
              <?php if ($cat = hreed_first_term($latest->ID, 'category')) : ?>
              <span class="mv__news-tag"><?php echo esc_html($cat->name); ?></span>
              <?php endif; ?>
            </div>
            <p class="mv__news-text"><?php echo esc_html(get_the_title($latest)); ?></p>
            <span class="mv__news-arrow btn-more__arrow" aria-hidden="true">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
            </span>
          </a>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= About ================= -->
  <section class="about">
    <div class="inner about__inner">
      <div class="about__deco" aria-hidden="true">
        <svg class="about__deco-svg about__deco-svg--square" viewBox="0 0 64 64">
          <rect class="js-draw" x="1" y="1" width="62" height="62" />
        </svg>

        <svg class="about__deco-svg about__deco-svg--top" viewBox="0 0 194 251">
          <path class="js-draw"
            d="M182.726 145.442H66.6885V98.3027H10.0654V249.811H66.6885V188.77H136.052V249.771H183.052V189.771H182.726V145.442Z" />
          <circle class="js-draw" cx="159.552" cy="81.589" r="34.448" />
          <circle class="js-draw" cx="34.448" cy="34.448" r="34.448" />
        </svg>

        <svg class="about__deco-svg about__deco-svg--bottom" viewBox="0 0 246 203">
          <path class="js-draw" d="M109 101V0H218V109H155V155H0V101H109Z" />
          <circle class="js-draw" cx="218" cy="175" r="27.5" />
        </svg>

        <svg class="about__deco-svg about__deco-svg--lone" viewBox="0 0 56 56">
          <circle class="js-draw" cx="28" cy="28" r="27.5" />
        </svg>
      </div>

      <div class="about__head sec-title">
        <h2 class="sec-title__en"><span class="sec-title__text">About</span></h2>
        <p class="sec-title__ja"><span class="sec-title__text">私たちについて</span></p>
      </div>

      <div class="about__body">
        <div class="about__photos">
          <img class="about__photo about__photo--1" src="<?php echo get_template_directory_uri(); ?>/img/top/about-photo-sub.jpg" alt="">
          <img class="about__photo about__photo--2" src="<?php echo get_template_directory_uri(); ?>/img/top/about-photo-main.jpg" alt="採用コンサルティングの様子">
        </div>

        <div class="about__content">
          <p class="about__text">
            採用は、事業のスピードと未来を左右します。<br>
            Hreedは、人材紹介と採用コンサルティングを掛け合わせ、<br>
            短期的な充足ではなく、<br>
            事業成長につながる採用を設計・実行します。<br>
            採用を、もっと戦略的に。<br>
            人と事業の可能性を、まっすぐつなぐために。
          </p>
          <a href="<?php echo esc_url(home_url('/about/')); ?>" class="about__more btn-more">
            もっと見る
            <span class="btn-more__arrow" aria-hidden="true">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= Service ================= -->
  <section class="service">
    <div class="service__bg">
      <img class="service__bg-img" src="<?php echo get_template_directory_uri(); ?>/img/top/service-bg.jpg" alt="">
    </div>
    <p class="service__watermark" aria-hidden="true">Service</p>

    <div class="inner">
      <div class="service__head sec-title sec-title--reverse">
        <h2 class="sec-title__en"><span class="sec-title__text">Service</span></h2>
        <p class="sec-title__ja"><span class="sec-title__text">事業内容</span></p>
      </div>

      <ul class="service__list">
        <li class="service__item">
          <span class="service__num">01</span>
          <div class="service__cards">
            <div class="service__logo">
              <img class="service__logo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/service-logo-growth.png" alt="Growth&amp;Growth">
            </div>
            <div class="service__body">
              <h3 class="service__body-title">転職支援サービス</h3>
              <p class="service__body-text">
                テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                テキストが入ります。テキストが入ります。テキストが入ります。
              </p>
            </div>
          </div>
        </li>

        <li class="service__item">
          <span class="service__num">02</span>
          <div class="service__cards">
            <div class="service__logo">
              <img class="service__logo-img" src="<?php echo get_template_directory_uri(); ?>/img/top/service-logo-banson.png" alt="バーソン">
            </div>
            <div class="service__body">
              <h3 class="service__body-title">採用支援サービス</h3>
              <p class="service__body-text">
                テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                テキストが入ります。テキストが入ります。テキストが入ります。
              </p>
            </div>
          </div>
        </li>

        <li class="service__item service__item--wide">
          <span class="service__num">03</span>
          <div class="service__body service__body--wide">
            <h3 class="service__body-title service__body-title--center">クリエイティブ制作</h3>
            <p class="service__body-text">
              テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
            </p>
          </div>
        </li>
      </ul>

      <a href="<?php echo esc_url(home_url('/service/')); ?>" class="service__more btn-more">
        もっと見る
        <span class="btn-more__arrow" aria-hidden="true">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
        </span>
      </a>
    </div>
  </section>

  <!-- ================= Case ================= -->
  <section class="case">
    <div class="inner">
      <div class="case__head sec-title">
        <h2 class="sec-title__en"><span class="sec-title__text">Case</span></h2>
        <p class="sec-title__ja"><span class="sec-title__text">ご支援事例</span></p>
      </div>

      <?php
      $cases = new WP_Query([
        'post_type'      => 'case',
        'posts_per_page' => 4,
      ]);
      // 2列に振り分ける(右列は下にずらして配置)
      $cols = [[], []];
      foreach ($cases->posts as $i => $case) {
        $cols[$i % 2][] = $case;
      }
      ?>
      <?php if ($cases->have_posts()) : ?>
      <div class="case__grid">
        <?php foreach ($cols as $n => $col) : ?>
        <div class="case__col<?php echo $n === 1 ? ' case__col--offset' : ''; ?>">
          <?php foreach ($col as $post) : setup_postdata($post); ?>
          <?php get_template_part('template-parts/case-card'); ?>
          <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>

      <a href="<?php echo esc_url(get_post_type_archive_link('case')); ?>" class="case__more btn-more btn-more--solid">
        一覧を見る
        <span class="btn-more__arrow" aria-hidden="true">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
        </span>
      </a>
    </div>
    <p class="case__watermark" aria-hidden="true">Case</p>
  </section>

  <!-- ================= News ================= -->
  <section class="news">
    <div class="inner">
      <div class="news__grid">
        <div class="news__side">
          <div class="news__head sec-title">
            <h2 class="sec-title__en"><span class="sec-title__text">News</span></h2>
            <p class="sec-title__ja"><span class="sec-title__text">お知らせ</span></p>
          </div>

          <ul class="news__filter">
            <li class="news__filter-item">
              <label class="news__filter-label">
                <input type="radio" name="news-category" class="news__filter-input" checked>
                <span class="news__filter-radio" aria-hidden="true"></span>
                すべて
              </label>
            </li>
            <li class="news__filter-item">
              <label class="news__filter-label">
                <input type="radio" name="news-category" class="news__filter-input">
                <span class="news__filter-radio" aria-hidden="true"></span>
                お知らせ
              </label>
            </li>
            <li class="news__filter-item">
              <label class="news__filter-label">
                <input type="radio" name="news-category" class="news__filter-input">
                <span class="news__filter-radio" aria-hidden="true"></span>
                プレスリリース
              </label>
            </li>
          </ul>

          <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="news__more btn-more btn-more--solid">
            一覧を見る
            <span class="btn-more__arrow" aria-hidden="true">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
            </span>
          </a>
        </div>

        <?php $news = new WP_Query(['posts_per_page' => 5]); ?>
        <?php if ($news->have_posts()) : ?>
        <ul class="news__list">
          <?php while ($news->have_posts()) : $news->the_post(); ?>
          <li class="news__item">
            <a href="<?php the_permalink(); ?>" class="news__item-link">
              <div class="news__item-meta">
                <time class="news__item-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
                <?php if ($cat = hreed_first_term(get_the_ID(), 'category')) : ?>
                <span class="news__item-tag"><?php echo esc_html($cat->name); ?></span>
                <?php endif; ?>
              </div>
              <p class="news__item-text"><?php the_title(); ?></p>
              <span class="news__item-arrow" aria-hidden="true"></span>
            </a>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
    <p class="news__watermark" aria-hidden="true">News</p>
  </section>

  <!-- ================= Link cards (Company / Recruit) ================= -->
  <section class="link-cards">
    <div class="link-cards__inner inner">
      <ul class="link-cards__list">
        <li class="link-cards__item">
          <a href="<?php echo esc_url(home_url('/company/')); ?>" class="link-cards__card">
            <div class="link-cards__photo">
              <img src="<?php echo get_template_directory_uri(); ?>/img/company/mv-photo.jpg" alt="Company">
            </div>
            <div class="link-cards__foot">
              <div class="sec-title sec-title--reverse">
                <h3 class="sec-title__en"><span class="sec-title__text">Company</span></h3>
                <p class="sec-title__ja"><span class="sec-title__text">会社概要</span></p>
              </div>
              <span class="btn-more__arrow" aria-hidden="true">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
              </span>
            </div>
          </a>
        </li>

        <li class="link-cards__item">
          <a href="<?php echo esc_url(home_url('/recruit/')); ?>" class="link-cards__card">
            <div class="link-cards__photo">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-recruit.jpg" alt="Recruit">
            </div>
            <div class="link-cards__foot">
              <div class="sec-title sec-title--reverse">
                <h3 class="sec-title__en"><span class="sec-title__text">Recruit</span></h3>
                <p class="sec-title__ja"><span class="sec-title__text">採用情報</span></p>
              </div>
              <span class="btn-more__arrow" aria-hidden="true">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-white.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
              </span>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-deco01.png" alt="装飾01" class="link-cards__deco link-cards__deco--01">
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-deco02.png" alt="装飾02" class="link-cards__deco link-cards__deco--02">
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-deco03.png" alt="装飾03" class="link-cards__deco link-cards__deco--03">
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-deco04.png" alt="装飾04" class="link-cards__deco link-cards__deco--04">
    <img src="<?php echo get_template_directory_uri(); ?>/img/common/link-deco05.png" alt="装飾05" class="link-cards__deco link-cards__deco--05">
  </section>

  <!-- ================= CTA banner (Contact) ================= -->
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
