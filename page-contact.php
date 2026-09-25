<?php get_header(); ?>

  <main>
    <?php get_template_part('template-parts/contact-mv'); ?>

    <section class="contact-form">
      <div class="contact-form__inner inner">
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
