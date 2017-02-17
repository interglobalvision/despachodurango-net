<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/
function add_menu_icons_styles(){
?>

<style>
#menu-posts-project .dashicons-admin-post:before {
    content: '\f319';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types
add_action( 'init', 'register_cpt_work' );

function register_cpt_work() {

    $labels = array(
        'name' => _x( 'Works', 'work' ),
        'singular_name' => _x( 'Work', 'work' ),
        'add_new' => _x( 'Add New', 'work' ),
        'add_new_item' => _x( 'Add New Work', 'work' ),
        'edit_item' => _x( 'Edit Work', 'work' ),
        'new_item' => _x( 'New Work', 'work' ),
        'view_item' => _x( 'View Work', 'work' ),
        'search_items' => _x( 'Search Works', 'work' ),
        'not_found' => _x( 'No works found', 'work' ),
        'not_found_in_trash' => _x( 'No works found in Trash', 'work' ),
        'parent_item_colon' => _x( 'Parent Work:', 'work' ),
        'menu_name' => _x( 'Works', 'work' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'work', $args );
}
