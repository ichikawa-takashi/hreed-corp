<?php
// お問い合わせへの誘導バナー(全ページ共通)
// 使い方: get_template_part('template-parts/cta-banner');
?>
    <section class="cta-banner">
      <div class="cta-banner__inner inner">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-banner__link">
          <img src="<?php echo esc_url(hreed_img_url('top/service-bg.jpg')); ?>" alt="" class="cta-banner__bg">

          <div class="cta-banner__wrapper">
            <div class="sec-title sec-title--reverse cta-banner__title">
              <h2 class="sec-title__en"><span class="sec-title__text">Contact us</span></h2>
              <p class="sec-title__ja"><span class="sec-title__text">お問い合わせ</span></p>
            </div>
  
            <div class="cta-banner__note">
              <p class="cta-banner__text">採用にお困りの方はこちらから</p>
              <span class="btn-more__arrow" aria-hidden="true">
                <img src="<?php echo esc_url(hreed_img_url('common/arrow-green.svg')); ?>" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
                <img src="<?php echo esc_url(hreed_img_url('common/arrow-green.svg')); ?>" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
              </span>
            </div>
          </div>
        </a>
      </div>
    </section>
