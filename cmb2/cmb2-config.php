<?php

// ADMIN ENQUEUE CMB2 js file for conditional field display logic
function cmb2_js_enqueue() {
  $modified_cmb2JS = date('YmdHi', filemtime(get_stylesheet_directory() . '/cmb2/js/cmb2-functions.min.js'));
  wp_enqueue_script('cmb2-script', get_stylesheet_directory_uri() . '/cmb2/js/cmb2-functions.min.js', array('jquery'), false, $modified_cmb2JS);
}
add_action('admin_enqueue_scripts', 'cmb2_js_enqueue');

// Disable Wordpress block editor on all pages
function disable_content_editor() {
  remove_post_type_support('page', 'editor');
}
remove_action('admin_init', 'disable_content_editor');

// Helper function to show each box on per-slug basis
function be_metabox_show_on_slug($display, $meta_box) {
  if (!isset($meta_box['show_on']['key'], $meta_box['show_on']['value'])) {
    return $display;
  }
  if ('slug' !== $meta_box['show_on']['key']) {
    return $display;
  }
  $post_id = 0;
  // If we're showing it based on ID, get the current ID
  if (isset($_GET['post'])) {
    $post_id = $_GET['post'];
  } elseif (isset($_POST['post_ID'])) {
    $post_id = $_POST['post_ID'];
  }
  if (!$post_id) {
    return $display;
  }
  $slug = get_post($post_id)->post_name;
  // See if there's a match
  return in_array($slug, (array) $meta_box['show_on']['value']);
}
add_filter('cmb2_show_on', 'be_metabox_show_on_slug', 10, 2);
// return selectbox with id's of a post type.
function mrweb_return_posts($post_type) {
    $return_array = array();
    $post_args = array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => true,
        'orderby' => array('menu_order' => 'ASC', 'title' => 'ASC'),
    );
    if (is_admin()) {
        if (function_exists('pll_is_translated_post_type') && false !== pll_is_translated_post_type($post_type)) {
            // get the language of the current post
            $current_post_id = (isset($_GET['post'])) ? $_GET['post'] : '';
            if (!empty($current_post_id) && function_exists('pll_get_post_language')) {
                $current_post_language = pll_get_post_language($current_post_id);
                if (false !== $current_post_language) {
                    // add current post language to the query
                    $post_args['lang'] = $current_post_language;
                }
            }
        }
    }
    $post_array = get_posts($post_args);
    if (is_array($post_array) && count($post_array) > 0) {
        foreach ($post_array as $post) {
            $post_id = $post->ID;
            $post_title = get_the_title($post_id);
            $return_array[$post_id] = $post_title;
        }
    }
    return $return_array;
}

// only show metabox on front page
function mrweb_show_on_front_page( $cmb ) {
	// Get ID of page set as front page, 0 if there isn't one
	$front_page = get_option( 'page_on_front' );
	// There is a front page set  - are we editing it?
	return $cmb->object_id() == $front_page;
}
