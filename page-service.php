<?php get_header(); ?>

  <main>
    <section class="lower-mv">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text">Service</span></span>
          <h1 class="lower-mv__heading"><span class="lower-mv__text">事業内容</span></h1>
        </div>

        <div class="lower-mv__photo">
          <img src="<?php echo esc_url(hreed_img_url('service/feature-photo-internal.jpg')); ?>" alt="打ち合わせをするHreedのメンバー">
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

    <!-- ================= Lead ================= -->
    <section class="service-lead">
      <img class="service-lead__arrows" src="<?php echo esc_url(hreed_img_url('service/second-arrow.svg')); ?>" alt="" aria-hidden="true">

      <div class="service-lead__inner inner">
        <h2 class="service-lead__heading">
          採用に悩む時間を、<span class="service-lead__heading-accent">事業成長の時間へ。</span>
        </h2>
        <p class="service-lead__text">「採用できない」を、「採用が仕組みで回る」状態へ</p>
      </div>

      <div class="service-lead__divider"></div>

      <?php
      $service_logos = [
        ['file' => 'kurashiru_logo.png',    'alt' => 'クラシル株式会社'],
        ['file' => 'fundbook_logo.jpg',     'alt' => '株式会社fundbook'],
        ['file' => 'leading_mark_logo.jpg', 'alt' => '株式会社Leading Mark'],
        ['file' => 'levarages.jpg',         'alt' => 'レバレジーズ株式会社'],
        ['file' => 'ma_soken_logo.png',     'alt' => '株式会社M&A総合研究所'],
      ];
      ?>
      <div class="service-lead__logo-band">
        <div class="inner">
          <div class="service-lead__logos swiper js-logo-marquee">
            <ul class="service-lead__logo-list swiper-wrapper">
              <?php // ループ再生で途切れないよう2周分出力し、2周目は読み上げ対象から外す ?>
              <?php for ($round = 0; $round < 2; $round++) : ?>
              <?php foreach ($service_logos as $logo) : ?>
              <li class="service-lead__logo swiper-slide"<?php echo $round ? ' aria-hidden="true"' : ''; ?>>
                <img src="<?php echo esc_url(hreed_img_url('service/logo/' . $logo['file'])); ?>" alt="<?php echo $round ? '' : esc_attr($logo['alt']); ?>" class="service-lead__logo-img">
              </li>
              <?php endforeach; ?>
              <?php endfor; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ================= Worry ================= -->
    <section class="worry">
      <div class="worry__inner inner">
        <span class="worry__tag">こんな<span class="worry__tag-accent">お悩み</span>ありませんか？</span>

        <ul class="worry__list">
          <li class="worry__item">
            <span class="worry__icon">
              <img src="<?php echo esc_url(hreed_img_url('service/worry-icon-turnover.png')); ?>" alt="">
            </span>
            <div class="worry__card">
              <span class="worry__title">採用したのに、すぐに辞めてしまう</span>
              <span class="worry__text">ミスマッチが起き、採用コストと時間だけが失われている。</span>
            </div>
          </li>

          <li class="worry__item worry__item--reverse">
            <span class="worry__icon">
              <img src="<?php echo esc_url(hreed_img_url('service/worry-icon-busy.png')); ?>" alt="">
            </span>
            <div class="worry__card">
              <span class="worry__title">採用活動に手が回らない</span>
              <span class="worry__text">本業が忙しく、応募対応や面接調整が後回しになっている。</span>
            </div>
          </li>

          <li class="worry__item">
            <span class="worry__icon">
              <img src="<?php echo esc_url(hreed_img_url('service/worry-icon-mismatch.png')); ?>" alt="">
            </span>
            <div class="worry__card">
              <span class="worry__title">欲しい人材が集まらない</span>
              <span class="worry__text">エージェントに任せても、なぜか「合わない人」ばかり紹介される。</span>
            </div>
          </li>

          <li class="worry__item worry__item--reverse">
            <span class="worry__icon">
              <img src="<?php echo esc_url(hreed_img_url('service/worry-icon-noteam.png')); ?>" alt="">
            </span>
            <div class="worry__card">
              <span class="worry__title">自社に採用担当がいない</span>
              <span class="worry__text">採用を兼任で進めており、ノウハウも蓄積されない。</span>
            </div>
          </li>

          <li class="worry__item">
            <span class="worry__icon">
              <img src="<?php echo esc_url(hreed_img_url('service/worry-icon-strength.png')); ?>" alt="">
            </span>
            <div class="worry__card">
              <span class="worry__title">自社の強みが分からない</span>
              <span class="worry__text">何を魅力として伝えればよいのか整理できていない。</span>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- ================= Approach ================= -->
    <section class="approach">
      <div class="approach__inner inner">
        <img src="<?php echo esc_url(hreed_img_url('common/mv-deco01.png')); ?>" alt="" aria-hidden="true" class="approach__deco approach__deco--01">
        <img src="<?php echo esc_url(hreed_img_url('common/mv-deco02.png')); ?>" alt="" aria-hidden="true" class="approach__deco approach__deco--02">
        <img src="<?php echo esc_url(hreed_img_url('common/mv-deco03.png')); ?>" alt="" aria-hidden="true" class="approach__deco approach__deco--03">
        <img src="<?php echo esc_url(hreed_img_url('common/mv-deco04.png')); ?>" alt="" aria-hidden="true" class="approach__deco approach__deco--04">

        <h2 class="approach__head">
          採用を「<span class="approach__head-accent">作業</span>」ではなく<br class="sp">「<span class="approach__head-accent">仕組み</span>」に変えます
        </h2>
        <p class="approach__lead">私たちは、単なる採用代行ではありません。</p>

        <p class="approach__flow">
          採用戦略の
          <span class="approach__flow-step">設計</span>
          <span class="approach__flow-arrow" aria-hidden="true">→</span>
          <span class="approach__flow-step">集客</span>
          <span class="approach__flow-arrow" aria-hidden="true">→</span>
          <span class="approach__flow-step">実行</span>
          <span class="approach__flow-arrow" aria-hidden="true">→</span>
          <span class="approach__flow-step">定着</span>
          までを一気通貫で支援します。
        </p>

        <ul class="approach__tags">
          <li class="approach__tag">企業ごとの課題・強みを整理</li>
          <li class="approach__tag">自社に合う人材像を明確化</li>
          <li class="approach__tag">採用プロセスを再設計</li>
          <li class="approach__tag">実務まで含めて伴走</li>
        </ul>
      </div>
    </section>

    <!-- ================= Feature ================= -->
    <section class="feature">
      <div class="feature__bg">
        <img class="feature__bg-img" src="<?php echo esc_url(hreed_img_url('top/service-bg.jpg')); ?>" alt="">
      </div>

      <div class="inner">
        <div class="feature__head sec-title sec-title--reverse">
          <h2 class="sec-title__en"><span class="sec-title__text">Feature</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">サービスの特長</span></p>
        </div>

        <ul class="feature__list">
          <li class="feature__item">
            <div class="feature__photo">
              <span class="feature__num">1</span>
              <img src="<?php echo esc_url(hreed_img_url('service/feature-photo-team.jpg')); ?>" alt="会議室で打ち合わせをするメンバー">
            </div>
            <div class="feature__body">
              <h3 class="feature__title">集客から実行まで一貫して対応</h3>
              <p class="feature__text">
                採用戦略の設計から、集客方法の選定、応募者対応、面接代行までを一貫して支援します。エージェント・求人広告・その他の手法に限定せず、企業ごとの課題や採用ターゲットに合わせて最適な方法を組み合わせます。
              </p>
              <p class="feature__text">
                採用業務の一部だけを切り出すのではなく、全体像を把握したうえで実行まで担うため、採用活動における抜け漏れや無駄を防ぎます。現場の負担を軽減しながら、スピード感と質の両立を実現します。
              </p>
              <p class="feature__text">
                結果として、担当者が本来注力すべき業務に集中できる環境を整え、採用活動を安定して回せる状態をつくります。
              </p>
            </div>
          </li>

          <li class="feature__item feature__item--reverse">
            <div class="feature__photo">
              <span class="feature__num">2</span>
              <img src="<?php echo esc_url(hreed_img_url('service/feature-photo-industry.jpg')); ?>" alt="オフィス・店舗・物流などさまざまな業界で働く人々">
            </div>
            <div class="feature__body">
              <h3 class="feature__title">幅広い業界の支援実績</h3>
              <p class="feature__text">
                業界や職種によって異なる採用市場の動向や人材特性を理解したうえで支援を行っています。これまでの多様な支援実績から得た知見を活かし、実情に即した採用戦略を設計します。
              </p>
              <p class="feature__text">
                特定の業界や成功事例に当てはめるのではなく、企業の事業内容・組織フェーズ・採用難易度に応じて柔軟に対応します。初めて採用に取り組む企業から、採用が伸び悩んでいる企業まで幅広く支援可能です。
              </p>
              <p class="feature__text">
                机上の理論に偏らず、現場で実行できる現実的な提案を行う点が強みです。
              </p>
            </div>
          </li>

          <li class="feature__item">
            <div class="feature__photo">
              <span class="feature__num">3</span>
              <img src="<?php echo esc_url(hreed_img_url('service/feature-photo-internal.jpg')); ?>" alt="ノートパソコンを使って打ち合わせをするメンバー">
            </div>
            <div class="feature__body">
              <h3 class="feature__title">内製化支援でノウハウを蓄積</h3>
              <p class="feature__text">
                採用業務を単に代行するだけでなく、プロセスや考え方を企業側に共有します。採用の進め方や判断基準を明確にし、属人化しやすい業務を整理・可視化します。
              </p>
              <p class="feature__text">
                その場限りの支援ではなく、採用活動を通じてノウハウが社内に残る仕組みを構築します。人事担当がいない、または兼任している企業でも、再現性のある採用体制を整えることが可能です。
              </p>
              <p class="feature__text">
                将来的には自社主導で採用を回せる状態を目指し、長期的な視点で企業の採用力向上を支援します。
              </p>
            </div>
          </li>
        </ul>
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

        <a href="<?php echo esc_url(home_url('/case/')); ?>" class="case__more btn-more btn-more--solid">
          一覧を見る
          <span class="btn-more__arrow" aria-hidden="true">
            <img src="<?php echo esc_url(hreed_img_url('common/arrow-green.svg')); ?>" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo esc_url(hreed_img_url('common/arrow-green.svg')); ?>" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
        </a>
      </div>
      <p class="case__watermark" aria-hidden="true">Case</p>
    </section>

    <!-- ================= Flow ================= -->
    <section class="flow">
      <div class="inner">
        <div class="flow__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Flow</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">ご支援の流れ</span></p>
        </div>

        <ol class="flow__list">
          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle">1</span>
              <img class="flow__num-arrow" src="<?php echo esc_url(hreed_img_url('service/arrow-bottom.svg')); ?>" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title">採用全体の設計</p>
              <p class="flow__text">
                事業内容・組織状況・採用目的をヒアリングし、<span class="flow__text-accent">自社に合った人材像・採用戦略・プロセス</span>を設計します。
              </p>
            </div>
          </li>

          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle">2</span>
              <img class="flow__num-arrow" src="<?php echo esc_url(hreed_img_url('service/arrow-bottom.svg')); ?>" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title">集客方法の選定</p>
              <p class="flow__text">
                ターゲット人材に合わせて、<span class="flow__text-accent">エージェント・求人広告・両方の併用</span>など最適な集客方法を選定します。
              </p>
            </div>
          </li>

          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle">3</span>
              <img class="flow__num-arrow" src="<?php echo esc_url(hreed_img_url('service/arrow-bottom.svg')); ?>" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title">ブランディング支援</p>
              <p class="flow__text">
                HPやSNSを活用し、<span class="flow__text-accent">転職者が働くイメージを具体的に描ける情報発信</span>を行います。
              </p>
            </div>
          </li>

          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle">4</span>
              <img class="flow__num-arrow" src="<?php echo esc_url(hreed_img_url('service/arrow-bottom.svg')); ?>" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title">実行（採用オペレーション・面接代行）</p>
              <p class="flow__text">
                応募者対応、日程調整、面接代行など、<span class="flow__text-accent">採用実務を一括して対応</span>し、現場の負担を軽減します。
              </p>
            </div>
          </li>

          <li class="flow__item">
            <div class="flow__num">
              <span class="flow__num-circle">5</span>
              <img class="flow__num-arrow" src="<?php echo esc_url(hreed_img_url('service/arrow-bottom.svg')); ?>" alt="" aria-hidden="true">
            </div>
            <div class="flow__body">
              <p class="flow__title">定着支援（OJT・フォロー面談）</p>
              <p class="flow__text">
                入社後のOJT設計や定期的なフォロー面談を実施。<span class="flow__text-accent">早期離職を防ぎ、現場で活躍できる状態まで伴走</span>します。
              </p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- ================= FAQ ================= -->
    <section class="faq">
      <div class="inner">
        <div class="faq__head sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">FAQ</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">よくあるご質問</span></p>
        </div>

        <ul class="faq__list">
          <li class="faq__item is-open">
            <button type="button" class="faq__question js-faq-question" aria-expanded="true">
              <span class="faq__q-icon" aria-hidden="true">Q</span>
              <span class="faq__q-text">RPO（採用代行）とはどこまで対応してもらえるサービスですか？</span>
              <span class="faq__toggle" aria-hidden="true"></span>
            </button>
            <div class="faq__answer">
              <span class="faq__a-icon">A</span>
              <p class="faq__a-text">
                採用戦略の設計から、集客、応募対応、面接代行、入社後の定着支援まで対応します。<br>
                企業の状況に応じて、必要な業務だけを切り出して依頼することも可能です。
              </p>
            </div>
          </li>

          <li class="faq__item">
            <button type="button" class="faq__question js-faq-question" aria-expanded="false">
              <span class="faq__q-icon" aria-hidden="true">Q</span>
              <span class="faq__q-text">採用担当者がいなくても依頼できますか？</span>
              <span class="faq__toggle" aria-hidden="true"></span>
            </button>
            <div class="faq__answer" style="display:none;">
              <span class="faq__a-icon">A</span>
              <p class="faq__a-text">
                問題ございません。採用業務を兼任・未経験の方でも、当社が実務を代行しながら進め方をお伝えします。
              </p>
            </div>
          </li>

          <li class="faq__item">
            <button type="button" class="faq__question js-faq-question" aria-expanded="false">
              <span class="faq__q-icon" aria-hidden="true">Q</span>
              <span class="faq__q-text">スポット（短期間）での利用は可能ですか？</span>
              <span class="faq__toggle" aria-hidden="true"></span>
            </button>
            <div class="faq__answer" style="display:none;">
              <span class="faq__a-icon">A</span>
              <p class="faq__a-text">
                可能です。繁忙期のみの応募対応や面接調整など、必要な期間・業務のみのご依頼にも対応しています。
              </p>
            </div>
          </li>

          <li class="faq__item">
            <button type="button" class="faq__question js-faq-question" aria-expanded="false">
              <span class="faq__q-icon" aria-hidden="true">Q</span>
              <span class="faq__q-text">採用できなかった場合でも費用は発生しますか？</span>
              <span class="faq__toggle" aria-hidden="true"></span>
            </button>
            <div class="faq__answer" style="display:none;">
              <span class="faq__a-icon">A</span>
              <p class="faq__a-text">
                料金体系はご契約プランにより異なります。詳細はお問い合わせ時に採用状況に合わせてご案内いたします。
              </p>
            </div>
          </li>

          <li class="faq__item">
            <button type="button" class="faq__question js-faq-question" aria-expanded="false">
              <span class="faq__q-icon" aria-hidden="true">Q</span>
              <span class="faq__q-text">土日や平日夜の面接も代行してもらえますか？</span>
              <span class="faq__toggle" aria-hidden="true"></span>
            </button>
            <div class="faq__answer" style="display:none;">
              <span class="faq__a-icon">A</span>
              <p class="faq__a-text">
                対応可能です。候補者の都合に合わせて、土日・平日夜間の日程調整や面接代行も承っております。
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- ================= Link cards (Company / Recruit) ================= -->
    <?php get_template_part('template-parts/link-cards', null, ['cards' => ['company', 'recruit']]); ?>

    <!-- ================= CTA banner (Contact) ================= -->
    <?php get_template_part('template-parts/cta-banner'); ?>
  </main>

<?php get_footer(); ?>
