
<?php
  $logo = IGV_get_option('_igv_site_options', '_igv_site_logo');
?>
  <footer id="footer" class="container margin-top-small margin-bottom-small">
    <div class="grid-row justify-between align-items-center">
      <div class="grid-item">
<?php
  if (!empty($logo)) {
?>
        <img src="<?php echo esc_url($logo); ?>" id="site-logo">
<?php
  } else {
    get_template_part('partials/durango-logo');
  }
?>
      </div>
      <div class="grid-item font-family-heading font-lighter font-size-larger">
        COPYRIGHT <?php echo date('Y'); ?>
      </div>
    </div>
  </footer>
