<?php get_header(); ?>

  <main>
    <?php get_template_part('template-parts/contact-mv'); ?>

    <section class="contact-form">
      <div class="contact-form__inner inner">
        <div class="contact-form__notice">
          <p class="contact-form__notice-title">営業・協業のご連絡について</p>
          <p class="contact-form__notice-text">弊社への営業・サービスのご案内、協業・提携のご相談は、本フォームではなく下記の専用フォームよりお問い合わせください。</p>
          <a class="contact-form__notice-link" href="https://docs.google.com/forms/d/e/1FAIpQLSdoJlwCYJjx2_qhO9nbrxVlx85waS1rqHEi-tG28O_DO4OZGA/viewform" target="_blank" rel="noopener noreferrer">営業・協業・提携のお問い合わせフォーム（別タブで開きます）</a>
        </div>
        <?php
        // フォームは固定ページ本文のContact Form 7ショートコードで出力する
        while (have_posts()) : the_post();
          the_content();
        endwhile;
        ?>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
