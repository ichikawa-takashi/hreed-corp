<?php
// 専用テンプレートのない固定ページ(採用・プライバシーポリシー・利用規約など)
// レイアウトはお知らせ詳細を流用する
get_header();
?>

  <main>
    <?php while (have_posts()) : the_post(); ?>
    <section class="news-detail">
      <div class="news-detail__inner inner">
        <h2 class="news-detail__title"><?php the_title(); ?></h2>

        <div class="news-detail__content">
          <?php the_content(); ?>
        </div>
      </div>
    </section>
    <?php endwhile; ?>
  </main>

<?php get_footer(); ?>
