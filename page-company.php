<?php get_header(); ?>

  <main>
    <section class="lower-mv">
      <div class="lower-mv__inner inner">
        <div class="lower-mv__head">
          <span class="lower-mv__tag"><span class="lower-mv__text">Company</span></span>
          <h1 class="lower-mv__heading"><span class="lower-mv__text">会社概要</span></h1>
        </div>

        <div class="lower-mv__photo">
          <img src="<?php echo esc_url(hreed_img_url('company/mv-photo.jpg')); ?>" alt="Hreedのオフィスの会議室">
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

    <section class="company-overview">
      <div class="company-overview__inner inner">
        <dl class="company-table">
          <div class="company-table__row">
            <dt class="company-table__label">
              会社名
            </dt>
            <dd class="company-table__value">Hreed株式会社（フレッド）</dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              所在地
            </dt>
            <dd class="company-table__value">
              <p class="company-table__heading">本社</p>
              <p class="company-table__address">
                〒107-0052<br>
                東京都港区赤坂4-13-5 赤坂オフィスハイツ
              </p>

              <p class="company-table__heading company-table__heading--sub">サテライトオフィス</p>
              <p class="company-table__address">
                クロスコープ渋谷ネクストサイトオフィス<br>
                〒150-0002<br>
                東京都渋谷区渋谷2-12-4 ネクストサイト渋谷ビル 5F
              </p>
            </dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              設立
            </dt>
            <dd class="company-table__value">2022年12月12日</dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              資本金
            </dt>
            <dd class="company-table__value">500万円</dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              事業内容
            </dt>
            <dd class="company-table__value">
              <ul class="company-table__list">
                <li>採用コンサルティング事業</li>
                <li>転職支援事業</li>
                <li>クリエイティブ制作事業</li>
              </ul>
            </dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              代表取締役
            </dt>
            <dd class="company-table__value">五十君 隆之介</dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              有料職業紹介<br class="pc">事業者番号
            </dt>
            <dd class="company-table__value">13-ユ-315119</dd>
          </div>

          <div class="company-table__row">
            <dt class="company-table__label">
              取引銀行
            </dt>
            <dd class="company-table__value">りそな銀行芝支店<br>芝信用金庫赤坂オフィス</dd>
          </div>
        </dl>
      </div>
    </section>

    <section class="company-access">
      <div class="company-access__inner inner">
        <div class="sec-title">
          <h2 class="sec-title__en"><span class="sec-title__text">Access</span></h2>
          <p class="sec-title__ja"><span class="sec-title__text">アクセス</span></p>
        </div>

        <div class="company-access__map">
          <iframe
            src="https://maps.google.com/maps?q=%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%B8%8B%E8%B0%B7%E5%8C%BA%E6%B8%8B%E8%B0%B72-12-4%20%E3%83%8D%E3%82%AF%E3%82%B9%E3%83%88%E3%82%B5%E3%82%A4%E3%83%88%E6%B8%8B%E8%B0%B7%E3%83%93%E3%83%AB&z=16&output=embed"
            title="クロスコープ渋谷ネクストサイトオフィスの地図" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

          <div class="company-access__info">
            <p class="company-access__name">クロスコープ渋谷ネクストサイトオフィス</p>
            <p class="company-access__address">
              〒150-0002<br>
              東京都渋谷区渋谷2-12-4 ネクストサイト渋谷ビル 5F
            </p>
            <p class="company-access__walk">
              <img src="<?php echo esc_url(hreed_img_url('company/icon-walk.svg')); ?>" alt="">
              渋谷駅より 徒歩5分
            </p>
          </div>
        </div>
      </div>
    </section>

    <?php get_template_part('template-parts/link-cards'); ?>

    <?php get_template_part('template-parts/cta-banner'); ?>

  </main>

<?php get_footer(); ?>
