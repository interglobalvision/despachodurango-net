<?php
  if (!is_front_page()) {
    get_template_part('partials/footer');
  }
?>

</section>

<?php
  get_template_part('partials/scripts');
  get_template_part('partials/schema-org');
?>

</body>
</html>
