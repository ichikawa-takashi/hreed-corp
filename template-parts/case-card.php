<?php
// 支援事例カード
// $args['frame']: 写真を枠(.case__photo-frame)で囲むか(関連記事一覧では囲まない)
$frame  = $args['frame'] ?? true;
$client = hreed_first_term(get_the_ID(), 'case_client');
$cat    = hreed_first_term(get_the_ID(), 'case_cat');
$photo  = get_the_post_thumbnail(null, 'large', ['class' => 'case__photo', 'alt' => $client ? $client->name . '様' : get_the_title()]);
?>
<a href="<?php the_permalink(); ?>" class="case__card">
  <?php if ($client) : ?>
  <p class="case__client"><?php echo esc_html($client->name); ?>様</p>
  <?php endif; ?>
  <?php if ($frame) : ?>
  <div class="case__photo-frame">
    <?php echo $photo; ?>
  </div>
  <?php else : ?>
  <?php echo $photo; ?>
  <?php endif; ?>
  <h3 class="case__card-title"><?php the_title(); ?></h3>
  <?php if (has_excerpt()) : ?>
  <p class="case__card-text"><?php echo esc_html(get_the_excerpt()); ?></p>
  <?php endif; ?>
  <?php if ($cat) : ?>
  <span class="case__pill"><?php echo esc_html($cat->name); ?></span>
  <?php endif; ?>
</a>
