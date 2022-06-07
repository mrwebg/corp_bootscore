<?php
/* INCLUDES
  ================================================== */
require_once 'includes/helper-functions.php';
require_once 'includes/theme-admin.php';
require_once 'includes/theme-lockout-public.php';
require_once 'includes/theme-cpts.php';
require_once 'cmb2/cmb2-tabs.php';
require_once 'cmb2/cmb2-config.php';
require_once 'cmb2/cmb2-fields.php';

remove_filter('body_class', 'mrweb_featured_background_class');
/**
 * If the current page has a template, apply it's name to the list of classes. This is
 * necessary if there are multiple pages with the same template and you want to apply the
 * name of the template to the class of the body.
 *
 * @param array $classes The current array of attributes to be applied to the
 */
function mrweb_featured_background_class($classes){
  if (is_front_page()) {
      $classes[] = 'featured-background-image';
  }
  return array_filter($classes);
}
function hook_css() {
  global $post;
    ?>
        <style>
            .home.featured-background-image {
              <?php $featured_background_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
                background: url('<?php echo $featured_background_image[0]; ?>') no-repeat;
            }
        </style>
    <?php
}
remove_action('wp_head', 'hook_css');

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
