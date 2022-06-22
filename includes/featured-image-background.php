<?php
function corp_featured_image_background() {
  if ( is_page()){
    global $post;
    $html = '<!-- featured-image-background -->';
    $featured_image_alt = $post->post_title;
    $featured_thumbail_id = get_post_thumbnail_id($post->ID);
    if(!empty($featured_thumbail_id) && $featured_thumbail_id > 0){
      $featured_image_source = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full")[0];
      if(!empty($featured_image_source) && '' !== $featured_image_source){
        $html .='
        <figure class="featured-image-background" style="display:none;">
        <picture>
        <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
        </picture>
        <noscript>
        <picture>
        <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
        </picture>
        </noscript>
        </figure>
        ';
      }
      echo $html;
    }
  }
}
add_action( 'wp_footer', 'corp_featured_image_background' );
