<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $work_meta = new_cmb2_box( array(
    'id'            => $prefix . 'work_meta',
    'title'         => esc_html__( 'Work Metabox', 'cmb2' ),
    'object_types'  => array( 'work', ), // Post type
  ) );

  $work_meta->add_field( array(
    'name' => 'Gallery Images',
    'desc' => 'Upload and manage gallery images',
    'button' => 'Manage gallery', // Optionally set button label
    'clear-button' => 'Clear gallery', // Optionally set clear button label
    'id'   => $prefix . 'work_gallery',
    'type' => 'pw_gallery',
    'preview_size' => array( 150, 150 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
  ) );

}
?>
