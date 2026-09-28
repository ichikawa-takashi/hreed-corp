<?php get_header(); ?>

  <main>
    <?php get_template_part('template-parts/text-mv', null, ['en' => '404 Not Found', 'ja' => 'ページが見つかりません']); ?>

    <section class="not-found">
      <div class="not-found__inner inner">
        <p class="not-found__code" aria-hidden="true">404</p>
        <h2 class="not-found__title">お探しのページは見つかりませんでした</h2>
        <p class="not-found__text">
          アクセスいただいたページは、移動または削除された可能性があります。<br>
          URLに誤りがないかご確認いただくか、トップページから目的のページをお探しください。
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="not-found__back btn-more btn-more--solid">
          <span class="not-found__back-icon btn-more__arrow" aria-hidden="true">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--current">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/arrow-green.svg" alt="" class="btn-more__arrow-icon btn-more__arrow-icon--next">
          </span>
          トップへ戻る
        </a>
      </div>
    </section>

  </main>

<?php get_footer(); ?>
