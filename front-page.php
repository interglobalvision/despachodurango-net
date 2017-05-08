<?php
get_header();
?>

<main id="main-content">
  <div id="skrollr-body">
  <section id="posts" class="padding-bottom-mid">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $works = get_post_meta($post->ID, '_igv_home_work_group', true);
?>

        <article <?php post_class('grid-row justify-center'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12 item-m-6 text-align-center font-serif font-size-large">
            <?php the_content(); ?>
          </div>
        </article>

<?php
    if (!empty($works)) {
?>

        <div id="home-work-holder" class="grid-row padding-top-mid padding-bottom-large js-masonry margin-bottom-large">

<?php
      foreach ($works as $work) {
        if (!empty($work['work_id'])) {

          $work_image = get_the_post_thumbnail($work['work_id'], 'item-s-12', false, array('data-no-lazysizes'=>true, 'class'=>'home-work-image'));

          if (!empty($work['image_id'])) {
            $work_image = wp_get_attachment_image($work['image_id'], 'item-s-12', false, array('data-no-lazysizes'=>true, 'class'=>'home-work-image'));
          }

          $work_url = get_the_permalink($work['work_id']);
          $work_title = get_the_title($work['work_id']);
          $work_cats = get_the_category($work['work_id']);

          $trans_y = (mt_rand(-10,10) / 10) * 50;
          $trans_x = (mt_rand(-10,10) / 10) * 50;

          $margin_top = mt_rand(1,4) * 50;
          $margin_left = mt_rand(-2,2) * 50;
          $margin = $margin_top . 'px 0 0 ' . $margin_left . 'px';

          $scale_start = IGV_get_option('_igv_site_options', '_igv_scale_start');
          $scale_end = IGV_get_option('_igv_site_options', '_igv_scale_end');

          $scale_start = !empty($scale_start) ? $scale_start : 0.7;
          $scale_end = !empty($scale_end) ? $scale_end : 1;
?>

          <a class="home-work-item grid-item item-s-12 item-m-6 item-l-4" href="<?php echo $work_url; ?>"
            data-0-bottom-top="transform[sqrt]: translateY(<?php echo -($trans_y); ?>%) translateX(<?php echo -($trans_x); ?>%) scale(<?php echo $scale_start; ?>);"
            data-0-top-bottom="transform[sqrt]: translateY(<?php echo $trans_y; ?>%) translateX(<?php echo $trans_x; ?>%) scale(<?php echo $scale_end; ?>);">
            <div class="home-work-contents-holder" style="margin: <?php echo $margin; ?>">
              <div class="home-work-contents text-align-center">

                <div class="home-work-details font-size-basic grid-column text-align-center justify-center align-items-center">
                  <h2 class="font-size-heading-small font-family-heading font-uppercase"><?php echo $work_title; ?></h2>
                  <?php
                    if (!empty($work_cats)) {
                      echo '<ul>';
                      foreach ($work_cats as $cat) {
                        echo '<li>' . $cat->name . '</li>';
                      }
                      echo '</ul>';
                    }
                  ?>
                </div>
                <?php echo $work_image; ?>
              </div>
            </div>
          </a>

<?php
        }
      }
?>

        </div>
<?php
    }
?>



<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

    </div>

  </section>
  <?php get_template_part('partials/footer'); ?>
</div>

</main>

<div id="saturation-filter"></div>

<?php
get_footer();
?>
