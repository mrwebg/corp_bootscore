<?php

if(!function_exists('mrweb_expertise_page_url')){
    function mrweb_expertise_page_url($expertise_term_id){
        $url = 'not found yet';
        $lang = WPLANG;
        $post_type = 'page';
        $expertise_category = 'expertise';
        // get_posts
        $args = array(
            'numberposts' => -1,
            'post_type'   => 'page'
          );
        return $lang;
    }
}