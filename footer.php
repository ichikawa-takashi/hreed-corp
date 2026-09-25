  <footer class="footer">
    <div class="footer__inner inner">
      <div class="footer__top">
        <h2 class="footer__logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/logo.svg" alt="Hreed">
          </a>
        </h2>

        <div class="footer__wrap">
          <nav class="footer__nav">
            <ul class="footer__nav-list">
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/about/')); ?>">私たちについて</a></li>
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/service/')); ?>">サービス</a></li>
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ</a></li>
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/case/')); ?>">支援事例</a></li>
              <li class="footer__nav-item"><a href="<?php echo esc_url(home_url('/recruit/')); ?>">採用</a></li>
              <li class="footer__nav-item"><a href="https://note.com/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/common/icon-note.svg" alt="note"></a></li>
            </ul>
          </nav>

          <ul class="footer__legal">
            <li class="footer__legal-item"><a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a></li>
            <li class="footer__legal-item"><a href="<?php echo esc_url(home_url('/terms/')); ?>">利用規約</a></li>
          </ul>
        </div>
      </div>

      <p class="footer__copyright">&copy; 2023 Hreed株式会社. All Rights Reserved.</p>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>

</html>
