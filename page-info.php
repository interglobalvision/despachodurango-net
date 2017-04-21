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
    $address = get_post_meta($post->ID, '_igv_contact_address', true);
    $phone = get_post_meta($post->ID, '_igv_contact_phone', true);
    $email = get_post_meta($post->ID, '_igv_contact_email', true);
    $map = get_post_meta($post->ID, '_igv_contact_map', true);
?>
      <section id="about" class="grid-row padding-top-mid padding-bottom-mid">
        <div class="grid-item item-s-12 item-l-4">
          <h2 class="font-family-heading font-uppercase font-size-heading margin-bottom-small">About</h2>
        </div>
        <div class="grid-item item-s-12 item-l-8 text-cols text-col-count-s-1 text-col-count-m-2">
          <?php the_content(); ?>
        </div>
      </section>

      <section class="grid-row padding-top-mid padding-bottom-mid section-border-bottom js-masonry">
    <?php
    if (!empty($team)) {
    ?>



      <?php
      foreach ($team as $teammate) {
        $teammate_picture = wp_get_attachment_image($teammate['_igv_teammate_picture_id'], 'some-size', false,  array('data-no-lazysizes'=>''));
        $teammate_name = $teammate['_igv_teammate_name'];
        $teammate_description = apply_filters('the_content', $teammate['_igv_teammate_description']);
      ?>
        <div class="grid-item item-s-12 item-m-6 item-l-4">
          <?php echo $teammate_picture; ?>
          <h3 class="font-family-heading font-uppercase font-size-heading"><?php echo $teammate_name; ?></h3>
          <?php echo $teammate_description; ?>
        </div>
      <?php
      }
      ?>

    <?php
    }
    ?>

    <?php
    if (!empty($collaborators)) {
    ?>
        <div class="grid-item item-s-12 item-m-6 item-l-4 no-gutter">
          <div class="grid-row">
            <div class="grid-item item-s-12">
              <h2 class="font-family-heading font-uppercase font-size-heading margin-bottom-small">Colaboradores</h2>
            </div>
            <div class="grid-item item-s-12 no-gutter">
              <ul class="grid-row">

      <?php
      foreach ($collaborators as $collaborator) {
        $collaborator_picture = wp_get_attachment_image($collaborator['_igv_collaborator_picture_id'], 'col-4'); // TODO: Change image size
        $collaborator_name = $collaborator['_igv_collaborator_name'];
        $collaborator_role = $collaborator['_igv_collaborator_role'];
      ?>
            <li class="grid-item item-s-6">
              <?php echo $collaborator_picture; ?>
              <h3 class="font-family-heading font-size-heading-small"><?php echo $collaborator_name; ?></h3>
              <p><?php echo $collaborator_role; ?></p>
            </li>
      <?php
      }
      ?>

              </ul>
            </div>
          </div>
        </div>


    <?php
    }
    ?>

    </section>

    <?php
    if (!empty($clients)) {
    ?>
      <section id="clients" class="grid-row padding-top-mid padding-bottom-mid section-border-bottom">
        <div class="grid-item item-s-12 item-l-4">
          <h2 class="font-family-heading font-uppercase font-size-heading margin-bottom-small">Clientes</h2>
        </div>
        <div class="grid-item item-s-12 item-l-8">
          <ul class="text-cols text-col-count-s-2 text-col-count-m-4 text-cols-no-break">

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
      <section id="services" class="grid-row padding-top-mid padding-bottom-mid section-border-bottom">
        <div class="grid-item item-s-12 item-l-4">
          <h2 class="font-family-heading font-uppercase font-size-heading margin-bottom-small">Servicios</h2>
        </div>
        <div class="grid-item item-s-12 item-l-8">
          <ul class="text-cols text-col-count-s-1 text-col-count-m-2 text-cols-no-break">

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
    if (!empty($address) || !empty($phone) || !empty($email) || !empty($map)) {
    ?>
      <section id="contact" class="grid-row padding-top-mid padding-bottom-mid section-border-bottom">
        <div class="grid-item item-s-12 item-l-4">
          <h2 class="font-family-heading font-uppercase font-size-heading margin-bottom-small">Contacto</h2>
        </div>
        <div class="grid-item item-s-12 item-m-4 item-l-3">
          <?php
          if (!empty($address)) {
          ?>
            <h3 class="font-family-heading font-uppercase">Dirección</h3>
            <?php echo apply_filters('the_content', $address); ?>
          <?php
          }
          if (!empty($phone)) {
          ?>
            <h3 class="font-family-heading font-uppercase">Teléfono</h3>
            <p><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
          <?php
          }
          if (!empty($email)) {
          ?>
            <h3 class="font-family-heading font-uppercase">Mail</h3>
            <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
          <?php
          }
          ?>
        </div>
    <?php
      if (!empty($map)) {
    ?>
        <div id="contact-map" class="grid-item item-s-12 item-m-8 item-l-5">
          <?php echo $map; ?>
        </div>
    <?php
      }
    ?>
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
