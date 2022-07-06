<?php

if(!function_exists('mrweb_expertise_page_url')){
    function mrweb_expertise_page_url($term_id){
        $page_url = '#';
        $lang = pll_current_language(); 
        $post_type = 'page';
        $taxonomy = 'expertise';
        // get_posts
        $args = array(
            'numberposts' => 1,
            'post_type'   => $post_type,
            'lang' => $lang,
            'tax_query' => array(
                array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => $term_id
                 )
              )
            );
        $posts = get_posts($args);
        $page =  $posts[0];
        $page_id =  $page->ID;
        $page_url =  get_the_permalink($page_id);        
        return $page_url;
    }
}