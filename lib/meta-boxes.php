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

  $about_page = get_page_by_path('about');

  if ($about_page) {
    $team_meta  = new_cmb2_box( array(
      'id'            => $prefix . 'team_metabox',
      'title'         => esc_html__( 'Team', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => $about_page->ID),
    ) );

    $team_group_id = $team_meta->add_field( array(
      'id'         => $prefix . 'teammate_group',
      'desc'       => esc_html__( '', 'cmb2' ),
      'type'       => 'group',
      'options'     => array(
        'group_title'   => __( 'Teammate {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another Teammate', 'cmb2' ),
        'remove_button' => __( 'Remove Teammate', 'cmb2' ),
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ) );

    $team_meta->add_group_field($team_group_id, array(
      'name'       => esc_html__( 'Name', 'cmb2' ),
      'id'         => $prefix . 'teammate_name',
      'type'       => 'text',
    ) );

    $team_meta->add_group_field($team_group_id, array(
      'name'       => esc_html__( 'Picture', 'cmb2' ),
      'id'         => $prefix . 'teammate_picture',
      'type'       => 'file',
    ) );

    // collaborators meta
    $collaborators_meta  = new_cmb2_box( array(
      'id'            => $prefix . 'collaborators_metabox',
      'title'         => esc_html__( 'Collaborators', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => $about_page->ID),
    ) );

    $collaborator_group_id = $collaborators_meta->add_field( array(
      'id'         => $prefix . 'collaborator_group',
      'desc'       => esc_html__( '', 'cmb2' ),
      'type'       => 'group',
      'options'     => array(
        'group_title'   => __( 'Collaborator {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another Collaborator', 'cmb2' ),
        'remove_button' => __( 'Remove Collaborator', 'cmb2' ),
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ) );

    $collaborators_meta->add_group_field($collaborator_group_id, array(
      'name'       => esc_html__( 'Name', 'cmb2' ),
      'id'         => $prefix . 'collaborator_name',
      'type'       => 'text',
    ) );

    $collaborators_meta->add_group_field($collaborator_group_id, array(
      'name'       => esc_html__( 'Role', 'cmb2' ),
      'id'         => $prefix . 'collaborator_role',
      'type'       => 'text',
    ) );

    $collaborators_meta->add_group_field($collaborator_group_id, array(
      'name'       => esc_html__( 'Picture', 'cmb2' ),
      'id'         => $prefix . 'collaborator_picture',
      'type'       => 'file',
    ) );

    // clients meta
    $clients_meta  = new_cmb2_box( array(
      'id'            => $prefix . 'clients_metabox',
      'title'         => esc_html__( 'Clients', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => $about_page->ID),
    ) );

    $client_group_id = $clients_meta->add_field( array(
      'id'         => $prefix . 'client_group',
      'desc'       => esc_html__( '', 'cmb2' ),
      'type'       => 'group',
      'options'     => array(
        'group_title'   => __( 'Client {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another Client', 'cmb2' ),
        'remove_button' => __( 'Remove Client', 'cmb2' ),
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ) );

    $clients_meta->add_group_field($client_group_id, array(
      'name'       => esc_html__( 'Name', 'cmb2' ),
      'desc'       => esc_html__( 'Name', 'cmb2' ),
      'id'         => $prefix . 'client_name',
      'type'       => 'text',
    ) );

    // Services meta
    $services_meta  = new_cmb2_box( array(
      'id'            => $prefix . 'services_metabox',
      'title'         => esc_html__( 'Services', 'cmb2' ),
      'object_types'  => array( 'page', ), // Post type
      'show_on'      => array( 'key' => 'id', 'value' => $about_page->ID),
    ) );

    $service_group_id = $services_meta->add_field( array(
      'id'         => $prefix . 'service_group',
      'desc'       => esc_html__( '', 'cmb2' ),
      'type'       => 'group',
      'options'     => array(
        'group_title'   => __( 'Service {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'    => __( 'Add Another Service', 'cmb2' ),
        'remove_button' => __( 'Remove Service', 'cmb2' ),
        'sortable'      => true, // beta
        // 'closed'     => true, // true to have the groups closed by default
      ),
    ) );

    $services_meta->add_group_field($service_group_id, array(
      'name'       => esc_html__( 'Name', 'cmb2' ),
      'id'         => $prefix . 'service_name',
      'type'       => 'text',
    ) );

    $services_meta->add_group_field($service_group_id, array(
      'name'       => esc_html__( 'Description', 'cmb2' ),
      'id'         => $prefix . 'service_description',
      'type'       => 'wysiwyg',
    ) );

  }

}
?>
