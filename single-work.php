<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container section-border-bottom">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $cats = get_the_category($post->ID);
    $gallery = get_post_meta($post->ID, '_igv_work_gallery', true);
?>

        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

          <div class="grid-row margin-bottom-mid">

            <div class="grid-item item-s-12 item-m-4 font-uppercase margin-bottom-small">
              <h1 class="font-family-heading font-size-heading-small"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
<?php
    if (!empty($cats)) {
?>
              <ul>
<?php
      foreach($cats as $cat) {
?>
                <li><?php echo $cat->name; ?></li>
<?php
      }
?>
              </ul>
<?php
    }
?>
            </div>

            <div class="grid-item item-s-12 item-m-8" id="work-content"><?php the_content(); ?></div>

          </div>

<?php
    if (!empty($gallery)) {
?>
          <div id="work-gallery" class="grid-row">
<?php
      foreach($gallery as $image_id) {
        $attachment = get_post($image_id);
        $image = wp_get_attachment_image($image_id, 'gallery');
        $caption = $attachment->post_excerpt;
?>
            <div class="work-gallery-image grid-item item-s-12 margin-bottom-small">
              <?php echo $image; ?>
              <div class="text-align-center margin-top-tiny"><?php echo $caption; ?></div>
            </div>
<?php
      }
?>
          </div>
<?php
    }
?>

        </article>
  <?php get_template_part('partials/single-pagination'); ?>

<?php
  }
} else {
?>
        <article class="u-alert grid-row">
          <div class="grid-item item-s-12">
            <?php _e('Sorry, no posts matched your criteria :{'); ?>
          </div>
        </article>
<?php
} ?>

      </div>
    </div>
  </section>


</main>

<?php
get_footer();
?>
