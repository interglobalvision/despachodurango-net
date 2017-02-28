<?php
get_header();
?>

<main id="main-content">
  <section id="info">
    <div id="post-<?php the_ID(); ?>" class="container">

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
      <section class="grid-row">
        <div class="grid-item item-m-4">
          <h2 class="font-family-heading font-uppercase font-size-heading">About</h2>
        </div>
        <div class="grid-item item-m-8">
          <?php the_content(); ?>
        </div>
      </section>

    <?php
    if (!empty($team)) {
    ?>

      <section class="grid-row">

      <?php
      foreach ($team as $teammate) {
        $teammate_picture = wp_get_attachment_image($teammate['_igv_teammate_picture_id'], 'some-size'); // TODO: Change image size
        $teammate_name = $teammate['_igv_teammate_name'];
        $teammate_description = apply_filters('the_content', $teammate['_igv_teammate_description']);
      ?>
        <div class="grid-item item-m-4">
          <?php echo $teammate_picture; ?>
          <h3 class="font-family-heading font-uppercase font-size-heading"><?php echo $teammate_name; ?></h3>
          <?php echo $teammate_description; ?>
        </div>
      <?php
      }
      ?>

      </section>

    <?php
    }
    ?>

    <?php
    if (!empty($collaborators)) {
    ?>
      <section>
        <div class="grid-item item-m-4">
          <h2 class="font-family-heading font-uppercase font-size-heading">Colaboradores</h2>
          <ul>

      <?php
      foreach ($collaborators as $collaborator) {
        $collaborator_picture = wp_get_attachment_image($collaborator['_igv_collaborator_picture_id'], 'col-4'); // TODO: Change image size
        $collaborator_name = $collaborator['_igv_collaborator_name'];
        $collaborator_role = $collaborator['_igv_collaborator_role'];
      ?>
            <li>
              <p><?php echo $collaborator_picture; ?></p>
              <h3 class="font-family-heading font-size-heading-small"><?php echo $collaborator_name; ?></h3>
              <p><?php echo $collaborator_role; ?></p>
            </li>
      <?php
      }
      ?>

          </ul>
        </div>
      </section>

    <?php
    }
    ?>

    <?php
    if (!empty($clients)) {
    ?>
      <section class="grid-row">
        <div class="grid-item item-m-4">
          <h2 class="font-family-heading font-uppercase font-size-heading">Clientes</h2>
        </div>
        <div class="grid-item item-m-8">
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
        </div>
      </section>

    <?php
    }
    ?>

    <?php
    if (!empty($services)) {
    ?>
      <section class="grid-row">
        <div class="grid-item item-m-4">
          <h2 class="font-family-heading font-uppercase font-size-heading">Servicios</h2>
        </div>
        <div class="grid-item item-m-8">
          <ul>

      <?php
      foreach ($services as $service) {
        $service_name = $service['_igv_service_name'];
        $service_description = $service['_igv_service_description'];
      ?>
            <li>
              <h3 class="font-family-heading font-uppercase font-size-heading-small"><?php echo $service_name; ?></h3>
              <p><?php echo $service_description; ?></p>
            </li>
      <?php
      }
      ?>

          </ul>
        </div>
      </section>

    <?php
    }
    ?>

    <?php
    if (!empty($contact)) {
    ?>
      <section class="grid-row">
        <div class="grid-item item-m-12">
          <h2 class="font-family-heading font-uppercase font-size-heading">Contacto</h2>
        <?php
        echo apply_filters('the_content', $contact);
        ?>
        </div>

      </section>

    <?php
    }
  }
} else {
?>
        <?php _e('Sorry, no posts matched your criteria :{'); ?>
<?php
} ?>

    </div>
  </section>

</main>

<?php
get_footer();
?>
