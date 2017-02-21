<?php
get_header();
?>

<main id="main-content">
  <section id="info">
    <div class="container">
      <div class="grid-row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $team = get_post_meta($post->ID, '_igv_teammate_group', true);
    $collaborators = get_post_meta($post->ID, '_igv_collaborator_group', true);
    $clients = get_post_meta($post->ID, '_igv_client_group', true);
    $services = get_post_meta($post->ID, '_igv_service_group', true);
    $contact = get_post_meta($post->ID, '_igv_contact', true);
?>

        <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">
            <h2>About</h2>
    <?php the_content(); ?>

    <?php
    if (!empty($team)) {
    ?>

          <section>
            <ul>

      <?php
      foreach ($team as $teammate) {
        $teammate_picture = wp_get_attachment_image($teammate['_igv_teammate_picture_id'], 'some-size'); // TODO: Change image size
        $teammate_name = $teammate['_igv_teammate_name'];
        $teammate_description = apply_filters('the_content', $teammate['_igv_teammate_description']);
      ?>
              <li>
                <?php echo $teammate_picture; ?>
                <h3><?php echo $teammate_name; ?></h3>
                <?php echo $teammate_description; ?>
              </li>
      <?php
      }
      ?>

            </ul>
          </section>

    <?php
    }
    ?>

    <?php
    if (!empty($collaborators)) {
    ?>
          <section>
            <h2>Clientes</h2>
            <ul>

      <?php
      foreach ($collaborators as $collaborator) {
        $collaborator_picture = wp_get_attachment_image($collaborator['_igv_collaborator_picture_id'], 'some-size'); // TODO: Change image size
        $collaborator_name = $collaborator['_igv_collaborator_name'];
        $collaborator_role = $collaborator['_igv_collaborator_role'];
      ?>
              <li>
                <p><?php echo $collaborator_picture; ?></p>
                <h3><?php echo $collaborator_name; ?></h3>
                <p><?php echo $collaborator_role; ?></p>
              </li>
      <?php
      }
      ?>

            </ul>
          </section>

    <?php
    }
    ?>

    <?php
    if (!empty($clients)) {
    ?>
          <section>
            <h2>Clientes</h2>
            <ul>

      <?php
      foreach ($clients as $client) {
        $client_name = $client['_igv_client_name'];
      ?>
              <li><?php echo $client_name; ?></li>
      <?php
      }
      ?>

            </ul>
          </section>

    <?php
    }
    ?>

    <?php
    if (!empty($services)) {
    ?>
          <section>
            <h2>Servicios</h2>
            <ul>

      <?php
      foreach ($services as $service) {
        $service_name = $service['_igv_service_name'];
        $service_description = $service['_igv_service_description'];
      ?>
              <li>
                <h3><?php echo $service_name; ?></h3>
                <p><?php echo $service_description; ?></p>
              </li>
      <?php
      }
      ?>

            </ul>
          </section>

    <?php
    }
    ?>

    <?php
    if (!empty($contact)) {
    ?>
          <section>
            <h2>Contacto</h2>
      <?php
      echo apply_filters('the_content', $contact);
      ?>

          </section>

    <?php
    }
    ?>


          <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>


        </article>

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
