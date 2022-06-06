<?php
/* CHANGE POST TYPE POST NAME AND POSITION */
add_action( 'init', 'mrweb_change_post_object' );
// Change dashboard Posts to News
function mrweb_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Nieuws';
        $labels->singular_name = 'Nieuws';
        $labels->add_new = 'Voeg een bericht toe';
        $labels->add_new_item = 'Voeg een bericht toe';
        $labels->edit_item = 'Bewerk een bericht';
        $labels->new_item = 'Nieuws';
        $labels->view_item = 'Bekijk bericht';
        $labels->search_items = 'Zoek nieuws';
        $labels->not_found = 'Geen bericht gevonden';
        $labels->not_found_in_trash = 'Geen berichten gevonden in de prullenbak';
        $labels->all_items = 'Alle berichten';
        $labels->menu_name = 'Nieuws';
        $labels->name_admin_bar = 'Nieuws';
}

/* DESCRIPTION OF FUNCTION */
function return_WPLANG_slug($default_slug){
  $slug = str_replace("_", "-", $default_slug);
  // return a default slug
  if( ! defined( 'WPLANG' ) || ! WPLANG || 'en_GB' == WPLANG ) return $slug;
  // array of slug data
  $slugs = array(
    'track_record' => array(
      'nl_NL' => 'track-record',
      'en_US' => 'track-record'
    ),
    'team' => array(
      'nl_NL' => 'mensen',
      'en_US' => 'team'
    ),
    'vacature' => array(
      'nl_NL' => 'vacature',
      'en_US' => 'jobs'
    ),
  );
  return $slugs[$default_slug][WPLANG];
}
// THEME CPT'S.
function add_theme_cpts() {
  // ct. Custom Taxonomy shared by deals en mensen.
  register_taxonomy(
    'expertise',
    array('deals','mensen','page'),
    array(
      'hierarchical' => true,
      'label' => 'Expertise [categorie]',
      'query_var' => true,
      'rewrite' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'show_in_rest' => true,
      'show_in_menu' => false,
    ),
  );
  // ADD EXPERTISE TERMS.
  if(!term_exists('Corporate M&A', 'expertise')){
    wp_insert_term('Corporate M&A','expertise', array('show_in_menu' => false,'show_in_nav_menus' => false,'show_in_admin_bar' => false,'description' => 'Term for Corporate M&A','slug' => 'corporate-m-a',));
  }
  if(!term_exists('Corporate Litigation', 'expertise')){
    wp_insert_term('Corporate Litigation','expertise', array('show_in_menu' => false,'show_in_nav_menus' => false,'show_in_admin_bar' => false, 'description' => 'Term for Corporate Litigation','slug' => 'corporate-litigation',));
  }
  if(!term_exists('Corporate Employment', 'expertise')){
    wp_insert_term('Corporate Employment','expertise', array('show_in_menu' => false,'show_in_nav_menus' => false,'show_in_admin_bar' => false, 'description' => 'Term for Corporate Employment','slug' => 'corporate-employment',));
  }
  // CUSTOM POST TYPE DEALS (slug = track-record)
  $slug_tr = return_WPLANG_slug('track_record');
  $labels_tr = array(
    'name' => 'Track record',
    'singular_name' => 'Track record',
    'add_new' =>'Nieuw track record',
    'add_new_item' =>'Nieuw track record',
    'edit_item' => 'Bewerk track record',
    'new_item' => 'Nieuw track record',
    'all_items' =>'Alle track records',
    'view_item' => 'Bekijk track record',
    'search_items' => 'Zoek track record',
    'not_found' => 'Geen track record gevonden',
    'not_found_in_trash' => 'Geen track record gevonden in de prullenbak',
    'parent_item_colon' => '',
    'menu_name' => 'Track record'
  );
  $args_tr = array(
    'label' => 'Track record',
    'description' => 'Post type deals',
    'labels' => $labels_tr,
    'supports' => array('title', 'editor', 'page-attributes'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => false,
    'show_in_admin_bar' => true,
    'menu_position' => 21,
    'menu_icon' => 'dashicons-awards',
    'can_export' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    'has_archive' => false,
    'show_in_rest' => true,
    'rest_base' => 'track_record',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'rewrite' => array('slug' => $slug_tr),
  );
  register_post_type('deals', $args_tr);
  // CPT VACATURE
  $slug_va = return_WPLANG_slug('vacature');
  $labels_va = array(
    'name' => 'Vacature',
    'singular_name' => 'Vacature',
    'add_new' =>'Nieuw vacature',
    'add_new_item' =>'Nieuw vacature',
    'edit_item' => 'Bewerk vacature',
    'new_item' => 'Nieuw vacature',
    'all_items' =>'Alle vacatures',
    'view_item' => 'Bekijk vacature',
    'search_items' => 'Zoek vacature',
    'not_found' => 'Geen vacature gevonden',
    'not_found_in_trash' => 'Geen vacature gevonden in de prullenbak',
    'parent_item_colon' => '',
    'menu_name' => 'Vacatures'
  );
  $args_va = array(
    'label' => 'Vacature',
    'description' => 'Post type vacature',
    'labels' => $labels_va,
    'supports' => array('title', 'editor', 'page-attributes'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => false,
    'show_in_admin_bar' => true,
    'menu_position' => 21,
    'menu_icon' => 'dashicons-welcome-learn-more',
    'can_export' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    'has_archive' => false,
    'show_in_rest' => true,
    'rest_base' => 'vacature',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'rewrite' => array('slug' => $slug_va),
  );
  register_post_type('vacature', $args_va);
  // CPT MENSEN
  $slug_m = return_WPLANG_slug('team');
  $labels_m = array(
    'name' => 'Team',
    'singular_name' => 'Teamlid',
    'add_new' =>'Nieuw teamlid',
    'add_new_item' =>'Nieuw teamlid',
    'edit_item' => 'Bewerk teamlid',
    'new_item' => 'Nieuw teamlid',
    'all_items' =>'Alle teamleden',
    'view_item' => 'Bekijk teamlid',
    'search_items' => 'Zoek teamlid',
    'not_found' => 'Geen teamlid gevonden',
    'not_found_in_trash' => 'Geen teamlid gevonden in de prullenbak',
    'parent_item_colon' => '',
    'menu_name' => 'Team'
  );
  $args_m = array(
    'label' =>'Team',
    'description' => 'Post type mensen',
    'labels' => $labels_m,
    'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 22,
    'menu_icon' => 'dashicons-id-alt',
    'can_export' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    'has_archive' => false,
    'show_in_rest' => true,
    'rest_base' => 'team',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'rewrite' => array('slug' => $slug_m),
  );
  register_post_type('mensen', $args_m);
  // QUOTES.
  $labels_q = array(
      'name' => 'Quotes',
      'singular_name' => 'Quote',
      'add_new' =>'Nieuwe quote',
      'add_new_item' =>'Nieuwe quote',
      'edit_item' => 'Bewerk quote',
      'new_item' => 'Nieuwe quote',
      'all_items' =>'Alle quotes',
      'view_item' => 'Bekijk quote',
      'search_items' => 'Zoek quotes',
      'not_found' => 'Geen quote gevonden',
      'not_found_in_trash' => 'Geen quotes gevonden in de prullenbak',
      'parent_item_colon' => '',
      'menu_name' => 'Quotes'
  );
  $args_q = array(
      'label' => 'Quotes',
      'description' =>'Post type quotes',
      'labels' => $labels_q,
      'supports' => array('title', 'editor'),
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => false,
      'show_in_admin_bar' => true,
      'menu_position' => 23,
      'menu_icon' => 'dashicons-format-quote',
      'can_export' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'page',
      'has_archive' => false,
      'show_in_rest' => true,
      'rest_base' => 'quotes',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'rewrite' => array('slug' => 'quotes'),
  );
  register_post_type('quotes', $args_q);
}
add_action('init', 'add_theme_cpts');

/* POLYLANG TRANSLATE THE CUSTOM TAXONOMY EXPERTISE. */
add_filter( 'pll_copy_taxonomies', 'mrweb_copy_custom_tax', 10, 2 );
function mrweb_copy_custom_tax( $taxonomies, $sync ) {
    $taxonomies[] = 'expertise';
    return $taxonomies;
}
/* HIDE SUBMENU TAXONOMY EXPERTISE FOR DEALS & MENSEN. */
function mrweb_remove_menu_pages() {
  //remove_submenu_page( 'edit.php?post_type=deals', 'edit-tags.php?taxonomy=expertise&amp;post_type=deals' );
  //remove_submenu_page( 'edit.php?post_type=mensen', 'edit-tags.php?taxonomy=expertise&amp;post_type=mensen' );
}
add_action('admin_menu','mrweb_remove_menu_pages', 999 );
/* ORDER DEALS BY PUBLICATIO DATE. */
function mrweb_admin_order_cpt_by_date( $wp_query ) {
  if (is_admin()) {
    $post_type = $wp_query->query['post_type'];
    if ( $post_type == 'deals') {
      $wp_query->set('orderby', 'date');
      $wp_query->set('order', 'DESC');
    }
  }
}
add_filter('pre_get_posts', 'mrweb_admin_order_cpt_by_date');
/* REMOVE COMMENTS COMPLETELY. */
// Removes from admin menu
add_action( 'admin_menu', 'pk_remove_admin_menus' );
function pk_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

// Removes from post and pages
add_action('init', 'pk_remove_comment_support', 100);
function pk_remove_comment_support() {
   remove_post_type_support( 'post', 'comments' );
   remove_post_type_support( 'page', 'comments' );
}

// Removes from admin bar
add_action( 'wp_before_admin_bar_render', 'pk_remove_comments_admin_bar' );
function pk_remove_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
