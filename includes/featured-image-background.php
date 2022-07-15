<?php
function corp_featured_image_background() {
  global $post;
  if (! is_page_template( 'page-team.php' ) && ! is_singular( 'mensen' ) && ! is_singular( 'vacature' ) && ! is_singular('post')) {    
    $html = '';
    $post_id = (is_home())? get_option( 'page_for_posts' ) : $post->ID;
    $featured_image_alt = get_the_title($post_id);
    $featured_thumbail_id = get_post_thumbnail_id($post_id);
    if(!empty($featured_thumbail_id) && $featured_thumbail_id > 0){
      $featured_image_source = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), "full")[0];
      if(!empty($featured_image_source) && '' !== $featured_image_source){
        $html .='
        <!-- .featured-image-background -->
        <figure class="featured-image-background">
        <picture>
        <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
        </picture>
        <noscript>
        <picture>
        <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
        </picture>
        </noscript>
        </figure><!-- /.featured-image-background -->
        ';
      }
    }
    echo $html;
  }
}
add_action( 'wp_footer', 'corp_featured_image_background' );