<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $works = get_post_meta($post->ID, '_igv_home_work_group', true);
?>

        <article <?php post_class('grid-row justify-center'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-6 text-align-center font-serif font-large">
            <?php the_content(); ?>
          </div>
        </article>

<?php
    if (!empty($works)) {
?>

        <div id="home-work-holder" class="grid-row">

<?php
      foreach ($works as $work) {
        if (!empty($work['work_id'])) {

          $work_image = get_the_post_thumbnail($work['work_id'], 'home-work', array('class'=>'home-work-image'));

          if (!empty($work['image_id'])) {
            $work_image = wp_get_attachment_image($work['image_id'], 'home-work', array('class'=>'home-work-image'));
          }

          $work_url = get_the_permalink($work['work_id']);
          $work_title = get_the_title($work['work_id']);
          $work_cats = get_the_category($work['work_id']);

?>

          <a class="home-work-item" href="<?php echo $work_url; ?>">
            <?php echo $work_image; ?>
            <div class="home-work-details grid-column text-align-center justify-around align-items-center">
              <h2><?php echo $work_title; ?></h2>
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
    </div>
  </section>

</main>

<?php
get_footer();
?>
