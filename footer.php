<?php
  $logo = IGV_get_option('_igv_site_options', '_igv_site_logo');
?>
  <footer id="footer" class="container">
    <div class="grid-row">
<?php
  if (!empty($logo)) {
?>
      <div class="grid-item item-s-6">
        <img src="<?php echo esc_url($logo); ?>" id="site-logo">
      </div>
<?php
  }
?>
      <div class="grid-item item-s-6 font-din font-lighter font-larger">
        COPYRIGHT <?php echo date('Y'); ?>
      </div>
    </div>
  </footer>

</section>

<?php
  get_template_part('partials/scripts');
  get_template_part('partials/schema-org');
?>

</body>
</html>
