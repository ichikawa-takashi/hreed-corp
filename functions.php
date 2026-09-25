<?php

// テーマ設定
function my_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_theme_setup');

// タイトルの区切り文字を「|」にする(例: 私たちについて | Hreed株式会社)
function my_document_title_separator()
{
    return '|';
}
add_filter('document_title_separator', 'my_document_title_separator');


// bodyに固定ページのスラッグを付与する
// .about / .service / .case / .news などはトップのセクション用クラスと重なるため「page-」を付ける
function my_body_class($classes)
{
    if (is_page()) {
        $page = get_post();
        $classes[] = 'page-' . $page->post_name;
    }

    // MVのないページ(お知らせ詳細・専用テンプレートのない固定ページ)
    $is_plain_page = is_page() && !is_front_page() && !locate_template('page-' . get_post()->post_name . '.php');
    if (is_singular('post') || $is_plain_page) {
        $classes[] = 'is-no-mv';
    }
    return $classes;
}
add_filter('body_class', 'my_body_class');


// Google Fontsのpreconnect
function my_resource_hints($urls, $relation_type)
{
    if ($relation_type === 'preconnect') {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        ];
    }
    return $urls;
}
add_filter('wp_resource_hints', 'my_resource_hints', 10, 2);


function enqueue_custom_styles_and_scripts() {
    $uri  = get_template_directory_uri();
    $path = get_template_directory();

    // ページの種類(トップ / MVのある下層ページ / セクション見出しアニメを使うページ)
    $is_top          = is_front_page();
    $is_news_list    = is_home() || is_category();
    $is_case_list    = is_post_type_archive('case') || is_tax(['case_cat', 'case_tag', 'case_client']);
    $has_lower_mv    = is_page(['about', 'company', 'service', 'contact', 'confirm', 'thanks']) || $is_news_list || $is_case_list;
    $has_sec_title   = $is_top || is_page(['about', 'company', 'service']) || $is_news_list || $is_case_list || is_singular('case');
    $has_scroll_anim = $is_top || $has_lower_mv || $has_sec_title;

    // Google Fonts
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Noto+Sans+JP:wght@400;500;600;700&display=swap', [], null );

    // Swiper CSS(トップのMVスライドショー)
    if ( $is_top ) {
        wp_enqueue_style( 'swiper-css', $uri . '/css/swiper-bundle.min.css', [], null );
    }

    // Main Stylesheet
    wp_enqueue_style( 'main-style', $uri . '/css/style.css', [], filemtime( $path . '/css/style.css' ) );

    // jQuery
    wp_enqueue_script( 'jquery-cdn', 'https://code.jquery.com/jquery-3.7.1.min.js', [], null, true );

    // Custom Scripts
    wp_enqueue_script( 'custom-script', $uri . '/js/script.js', ['jquery-cdn'], filemtime( $path . '/js/script.js' ), true );

    // GSAP Scripts
    wp_enqueue_script( 'gsap-core', $uri . '/js/gsap.js', [], null, true );
    if ( $has_scroll_anim ) {
        wp_enqueue_script( 'gsap-scrolltrigger', $uri . '/js/ScrollTrigger.js', ['gsap-core'], null, true );
    }

    // トップページ
    if ( $is_top ) {
        wp_enqueue_script( 'about-animation', $uri . '/js/about-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/about-animation.js' ), true );
    }

    // セクション見出しアニメーション
    if ( $has_sec_title ) {
        wp_enqueue_script( 'sec-title-animation', $uri . '/js/sec-title-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/sec-title-animation.js' ), true );
    }

    // 下層ページMV
    if ( $has_lower_mv ) {
        wp_enqueue_script( 'lower-mv-animation', $uri . '/js/lower-mv-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/lower-mv-animation.js' ), true );
    }

    if ( $is_top ) {
        wp_enqueue_script( 'service-animation', $uri . '/js/service-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/service-animation.js' ), true );
        wp_enqueue_script( 'case-animation', $uri . '/js/case-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/case-animation.js' ), true );
        wp_enqueue_script( 'news-animation', $uri . '/js/news-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/news-animation.js' ), true );
        wp_enqueue_script( 'link-cards-animation', $uri . '/js/link-cards-animation.js', ['gsap-scrolltrigger'], filemtime( $path . '/js/link-cards-animation.js' ), true );

        // Swiper Script
        wp_enqueue_script( 'swiper-js', $uri . '/js/vendor/swiper-bundle.min.js', [], null, true );
        wp_enqueue_script( 'mv-slideshow', $uri . '/js/mv-slideshow.js', ['swiper-js'], filemtime( $path . '/js/mv-slideshow.js' ), true );

        // オープニング演出
        wp_enqueue_script( 'three', $uri . '/js/vendor/three.min.js', [], null, true );
        wp_enqueue_script( 'svg-loader', $uri . '/js/vendor/SVGLoader.js', ['three'], null, true );
        wp_enqueue_script( 'opening-logo', $uri . '/js/opening-logo.js', ['svg-loader'], filemtime( $path . '/js/opening-logo.js' ), true );
        wp_enqueue_script( 'opening-animation', $uri . '/js/opening-animation.js', ['opening-logo', 'gsap-core'], filemtime( $path . '/js/opening-animation.js' ), true );
    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles_and_scripts' );



// wppagenaviのカスタマイズ

function custom_wp_pagenavi($html) {
    // 前へのリンクのテキストを画像に置き換える
    $html = str_replace('←', '<img src="' . get_template_directory_uri() . '/img/common/next-arrow.svg" alt="前へ">', $html);

    // 次へのリンクのテキストを画像に置き換える
    $html = str_replace('→', '<img src="' . get_template_directory_uri() . '/img/common/next-arrow.svg" alt="次へ">', $html);

    return $html;
}
add_filter('wp_pagenavi', 'custom_wp_pagenavi');


// サンクスページへの遷移
// Multi-Stepでは入力画面の送信時にもwpcf7mailsentが発火するため、確認画面でのみ出力する
add_action('wp_footer', 'add_thanks_page');
function add_thanks_page()
{
    if (!is_page('confirm')) {
        return;
    }
    ?>
	<script>
		document.addEventListener('wpcf7mailsent', function(event) {
			location = '<?php echo esc_url(home_url('/contact/thanks/')); ?>'; /* 遷移先のURL */
		}, false);
	</script>
<?php }


// 投稿に紐づく最初のタームを取得する(なければnull)
function hreed_first_term($post_id, $taxonomy)
{
    $terms = get_the_terms($post_id, $taxonomy);
    return ($terms && !is_wp_error($terms)) ? $terms[0] : null;
}

// テキストエリアの値を1行ずつの配列にする(空行は除く)
function hreed_lines($text)
{
    return array_values(array_filter(array_map('trim', preg_split('/\R/', (string) $text))));
}


// ページネーション
// $block: 'news' / 'case'(.news-pagination / .case-pagination)
function hreed_pagination($block)
{
    global $wp_query;
    $total   = (int) $wp_query->max_num_pages;
    $current = max(1, (int) get_query_var('paged'));
    if ($total < 2) {
        return;
    }

    $arrow = function ($modifier, $page, $label, $disabled) use ($block) {
        $class = "{$block}-pagination__arrow {$block}-pagination__arrow--{$modifier}";
        if ($disabled) {
            return '<span class="' . $class . ' is-disabled" aria-hidden="true"></span>';
        }
        return '<a href="' . esc_url(get_pagenum_link($page)) . '" class="' . $class . '" aria-label="' . esc_attr($label) . '"></a>';
    };

    // 現在ページの前後2ページまで表示する
    $start = max(1, $current - 2);
    $end   = min($total, $current + 2);
    ?>
    <nav class="<?php echo $block; ?>-pagination" aria-label="ページネーション">
      <?php echo $arrow('first', 1, '最初のページ', $current === 1); ?>
      <?php echo $arrow('prev', $current - 1, '前のページ', $current === 1); ?>

      <ul class="<?php echo $block; ?>-pagination__list">
        <?php for ($i = $start; $i <= $end; $i++) : ?>
        <?php if ($i === $current) : ?>
        <li><span class="<?php echo $block; ?>-pagination__link is-current" aria-current="page"><?php echo $i; ?></span></li>
        <?php else : ?>
        <li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="<?php echo $block; ?>-pagination__link"><?php echo $i; ?></a></li>
        <?php endif; ?>
        <?php endfor; ?>
      </ul>

      <?php echo $arrow('next', $current + 1, '次のページ', $current === $total); ?>
      <?php echo $arrow('last', $total, '最後のページ', $current === $total); ?>
    </nav>
    <?php
}


// 支援事例一覧の表示件数
function hreed_pre_get_posts($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    if ($query->is_post_type_archive('case') || $query->is_tax(['case_cat', 'case_tag', 'case_client'])) {
        $query->set('posts_per_page', 10);
    }
}
add_action('pre_get_posts', 'hreed_pre_get_posts');


// Contact Form 7
// 自動で<p><br>が挿入されるとレイアウトが崩れるため無効化する
add_filter('wpcf7_autop_or_not', '__return_false');

// メールアドレス(確認)の一致チェック
function hreed_validate_email_confirm($result, $tag)
{
    if ($tag->name === 'your-email-confirm') {
        $email   = isset($_POST['your-email']) ? trim(wp_unslash($_POST['your-email'])) : '';
        $confirm = isset($_POST['your-email-confirm']) ? trim(wp_unslash($_POST['your-email-confirm'])) : '';
        if ($email !== $confirm) {
            $result->invalidate($tag, 'メールアドレスが一致しません。');
        }
    }
    return $result;
}
add_filter('wpcf7_validate_email*', 'hreed_validate_email_confirm', 20, 2);

// 確認画面に表示する入力値はHTMLとして解釈させない
function hreed_escape_multiform_value($value)
{
    return esc_html($value);
}
add_filter('cf7msm_form_field_value', 'hreed_escape_multiform_value');


// 支援事例のスラッグが日本語(URLエンコード)になる場合は「case-{投稿ID}」にする
function hreed_case_slug($slug, $post_id, $post_status, $post_type)
{
    if ($post_type === 'case' && $post_id && preg_match('/%[0-9a-f]{2}/i', $slug)) {
        return 'case-' . $post_id;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'hreed_case_slug', 10, 4);


// タイトル欄のプレースホルダー
function hreed_enter_title_here($text, $post)
{
    return $post->post_type === 'member' ? '氏名を入力(例: 山田 太郎)' : $text;
}
add_filter('enter_title_here', 'hreed_enter_title_here', 10, 2);


// Contact Form 7・Multi-Stepのスクリプト/CSSはフォームのあるページだけで読み込む
// (全ページで読み込むとWordPress同梱のjQueryまで読み込まれ、CDN版と二重になるため)
function hreed_dequeue_cf7_assets()
{
    if (is_page(['contact', 'confirm', 'thanks'])) {
        return;
    }
    foreach (['cf7msm', 'contact-form-7', 'swv'] as $handle) {
        wp_dequeue_script($handle);
    }
    foreach (['cf7msm_styles', 'contact-form-7'] as $handle) {
        wp_dequeue_style($handle);
    }
}
add_action('wp_enqueue_scripts', 'hreed_dequeue_cf7_assets', 100);
