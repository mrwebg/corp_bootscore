<?php
/* ENQUEUE SCRIPTS & STYLES.
  ================================================== */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {
// style.css
wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
// Compiled Bootstrap
$modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/css/lib/bootstrap.min.css'));
wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/lib/bootstrap.min.css', array('parent-style'), $modified_bootscoreChildCss);
// custom.js
$modified_bootscoreChildJs = date('YmdHi', filemtime(get_stylesheet_directory() . '/js/custom.js'));
wp_enqueue_script('corp-bootscore', get_stylesheet_directory_uri() . '/js/custom.js', array('bootstrap', 'bootscore-script'), $modified_bootscoreChildJs, true);
}
/* TEXTDOMAIN CORP
================================================== */
function add_child_theme_textdomain() {
  load_child_theme_textdomain( 'corp_bootscore', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );
/* ADMIN SCRIPTS HOOKED
  ================================================== */
if (is_admin()) {
  add_action('admin_init', 'mrweb_add_column_templatename');
  add_action('admin_init', 'gtwc_remove_column_date');
}
/* MIME TYPES.
  ================================================== */
  function mrweb_enable_custom_mimes( $mime_types ){
    $mime_types['vcf'] = 'text/vcard';
    $mime_types['vcard'] = 'text/vcard';
    $mimes['svg'] = 'image/svg+xml';    
    return $mime_types;
  }
  add_filter('upload_mimes', 'mrweb_enable_custom_mimes' );
  /* DISABLE GUTENBERG
    ================================================== */
  function mrweb_disable_block_styles() {
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    wp_deregister_script('wp-embed');
    wp_dequeue_script('wp-embed');
  }
  add_action('wp_enqueue_scripts', 'mrweb_disable_block_styles');
  add_filter("use_block_editor_for_post_type", "mrweb_disable_gutenberg_editor");
  function mrweb_disable_gutenberg_editor()
  {
  return false;
  }
  add_action('after_setup_theme', function () {
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
  }, 10, 0);
  /* CHANGE ADMIN MENU ORDER
    ================================================== */
  function reorder_admin_menu( $__return_true ) {
    return array(
      'index.php', // Dashboard
      'upload.php', // Media
      'edit.php?post_type=page', // Pages
      'edit.php', // Posts
      'edit.php?post_type=deals', // Track record
      'edit.php?post_type=mensen', // Team
      'edit.php?post_type=vacature', // Vacature
      'edit.php?post_type=quotes', // Quotes
      'separator1', // --Space--
      'themes.php', // Appearance
      'users.php', // Users
      'plugins.php', // Plugins
      'tools.php', // Tools
      'options-general.php', // Settings
      'separator2', // --Space--
      'admin.php?page=wpseo_dashboard', // Yoast
      'admin.php?page=mlang', // Yoast
      'admin.php?page=Wordfence', // Yoast
    );
  }
  add_filter( 'custom_menu_order', 'reorder_admin_menu' );
  add_filter( 'menu_order', 'reorder_admin_menu' );

  // MENSEN PORTRAIT IMAGE SIZE;
  add_image_size( 'team-portrait', 600, 600, false );

  // UNSET PAGE TEMPLATE FROM PAGE ATTRIBUTES METABOX TEMPLATE DROPDOWN.
  add_filter( 'theme_page_templates', 'mrweb_remove_page_template' );
  function mrweb_remove_page_template( $pages_templates ) {
    //$temp = $pages_templates['page-test.php'];
    // add it back
    //$page_templates[] = 'page-sidebar-left.php';
    // remove the template.
    //unset( $pages_templates['page-test.php'] );
    unset($pages_templates['page-sidebar-left.php']);
    unset( $pages_templates['page-sidebar-none.php'] );
    unset($pages_templates['page-full-width-image.php']);
    unset($pages_templates['page-blank-with-container.php']);
    unset($pages_templates['page-blank-without-container.php']);
    return $pages_templates;
  }

/* POST-LISTING => ADD COLUMN TEMPLATE FOR POSTTYPE PAGE
  ================================================== */

function mrweb_add_column_templatename() {
    $posttype = "page";
    if (post_type_exists($posttype)) {
        $filter = 'manage_edit-' . $posttype . '_columns';
        add_filter($filter, 'mrweb_page_column_add_template');
        // populate the column
        $action = 'manage_' . $posttype . '_posts_custom_column';
        add_action($action, 'mrweb_page_column_populate_template', 10, 2);
    }
}

function mrweb_page_column_add_template($columns) {
    $columns['page_template'] = 'Page-Template';
    return $columns;
}

function mrweb_page_column_populate_template($column, $post_id) {
    if ($column == 'page_template') {
        $page_template_name = get_post_meta($post_id, '_wp_page_template', true);
        $page_templates = get_page_templates();
        if (in_array($page_template_name, $page_templates)) {
            foreach ($page_templates as $key => $value) {
                if ($page_template_name == $value) {
                    echo $key;
                }
            }
        } else {
            echo 'DEFAULT';
        }
    }
}
/* POST-LISTING => REMOVE COLUMN DATE FOR ANY POSTTYPE
  ================================================== */

function gtwc_remove_column_date() {
    $posttypes = array("page", "mensen", "quotes");
    if (is_array($posttypes) && count($posttypes) > 0) {
        foreach ($posttypes as $posttype) {
            if (post_type_exists($posttype)) {
                $filter = 'manage_edit-' . $posttype . '_columns';
                add_filter($filter, 'grasland_post_remove_column_date');
            }
        }
    }
}

function grasland_post_remove_column_date($columns) {
    unset($columns['date']);
    return $columns;
}

/* REMOVE EMOJI'S
  ================================================== */
/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}
// ADD CLASS LEAD TO FIRST PARAGRAPH OF THE CONTENT.
function mrweb_first_paragraph_class_lead($content){
  // Testing to see if the content is a Page or Custom Post Type of school, if so, display the text normally (without the class = intro).
  if ( 'deals' === get_post_type()) {
    return preg_replace('/<p([^>]+)?>/', '<p$1>', $content, 1);
  } else {
    return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
  }
}
add_filter('the_content', 'mrweb_first_paragraph_class_lead');