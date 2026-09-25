<?php get_header(); ?>

  <main>
    <?php get_template_part('template-parts/contact-mv'); ?>

    <section class="contact-thanks">
      <div class="contact-thanks__inner inner">
        <h2 class="contact-thanks__title">お問い合わせありがとうございました</h2>
        <p class="contact-thanks__text">
          お問い合わせを受け付けました。<br>
          内容を確認のうえ、担当者よりご連絡いたします。<br>
          ご入力いただいたメールアドレス宛に自動返信メールをお送りしておりますので、あわせてご確認ください。
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="contact-thanks__more btn-more btn-more--solid">
          トップへ戻る
          <span class="btn-more__arrow" aria-hidden="true">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="矢印アイコン" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
        </a>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
