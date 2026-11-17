<?php
$title       = get_sub_field('title') ?: __('Explore', 'projecttheme');
$intro       = get_sub_field('intro');
$categories  = get_sub_field('categories') ?: [];
$stamps      = get_sub_field('stamps') ?: [];
$day_title   = get_sub_field('stamp_day_title') ?: __('Stamp of the day', 'projecttheme');
$day_link    = get_sub_field('stamp_day_view_all') ?: [];
$day_image   = get_sub_field('stamp_day_image');
$day_country = get_sub_field('stamp_day_country');
$day_year    = get_sub_field('stamp_day_year');
$day_stamp   = get_sub_field('stamp_day_stamp_title');
$day_artist  = get_sub_field('stamp_day_artist');
$day_value   = get_sub_field('stamp_day_value');
$day_text    = get_sub_field('stamp_day_description');

$day_url     = is_array($day_link) ? ($day_link['url'] ?? '') : '';
$day_label   = is_array($day_link) ? ($day_link['title'] ?? '') : '';
$day_target  = is_array($day_link) ? ($day_link['target'] ?? '_self') : '_self';
$day_rel     = $day_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="explore-content">
  <div class="explore-content__main">
    <header class="explore-content__intro">
      <h2 class="explore-content__title"><?php echo esc_html($title); ?></h2>
      <?php if ($intro): ?>
        <div class="explore-content__description"><?php echo wp_kses_post($intro); ?></div>
      <?php endif; ?>
    </header>

    <?php if ($categories): ?>
      <nav class="explore-content__categories" aria-label="<?php esc_attr_e('Explore categories', 'projecttheme'); ?>">
        <?php foreach ($categories as $index => $category):
          $label = $category['label'] ?? '';
          $url   = $category['url'] ?? '';
          if (!$label) {
            continue;
          }
        ?>
          <?php if ($url): ?>
            <a class="explore-content__category<?php echo $index === 0 ? ' is-active' : ''; ?>" href="<?php echo esc_url($url); ?>">
              <?php echo esc_html($label); ?>
            </a>
          <?php else: ?>
            <span class="explore-content__category<?php echo $index === 0 ? ' is-active' : ''; ?>">
              <?php echo esc_html($label); ?>
            </span>
          <?php endif; ?>
        <?php endforeach; ?>
      </nav>
    <?php endif; ?>

    <?php if ($stamps): ?>
      <div class="explore-content__stamps">
        <?php foreach ($stamps as $stamp):
          $image = $stamp['image'] ?? 0;
          $url   = $stamp['url'] ?? '';
          if (!$image) {
            continue;
          }
        ?>
          <?php if ($url): ?>
            <a class="explore-content__stamp" href="<?php echo esc_url($url); ?>">
              <?php echo wp_get_attachment_image($image, 'large', false, ['loading' => 'lazy', 'decoding' => 'async']); ?>
            </a>
          <?php else: ?>
            <div class="explore-content__stamp">
              <?php echo wp_get_attachment_image($image, 'large', false, ['loading' => 'lazy', 'decoding' => 'async']); ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <aside class="explore-content__day">
    <header class="explore-content__day-header">
      <h3><?php echo esc_html($day_title); ?></h3>
      <?php if ($day_url): ?>
        <a href="<?php echo esc_url($day_url); ?>"
           target="<?php echo esc_attr($day_target); ?>"
           rel="<?php echo esc_attr($day_rel); ?>">
          <?php echo esc_html($day_label ?: __('View all', 'projecttheme')); ?>
          <span aria-hidden="true">&rarr;</span>
        </a>
      <?php endif; ?>
    </header>

    <?php if ($day_image): ?>
      <div class="explore-content__day-image">
        <?php echo wp_get_attachment_image($day_image, 'large', false, ['loading' => 'lazy', 'decoding' => 'async']); ?>
      </div>
    <?php endif; ?>

    <dl class="explore-content__details">
      <?php foreach ([
        __('Country', 'projecttheme') => $day_country,
        __('Year', 'projecttheme') => $day_year,
        __('Title', 'projecttheme') => $day_stamp,
        __('Artist', 'projecttheme') => $day_artist,
        __('Value', 'projecttheme') => $day_value,
      ] as $label => $value): ?>
        <?php if ($value): ?>
          <div>
            <dt><?php echo esc_html($label); ?></dt>
            <dd><?php echo esc_html($value); ?></dd>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </dl>

    <?php if ($day_text): ?>
      <div class="explore-content__day-description"><?php echo wp_kses_post($day_text); ?></div>
    <?php endif; ?>
  </aside>
</div>
