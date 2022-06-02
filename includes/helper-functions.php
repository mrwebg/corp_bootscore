<?php

/* GLOBALS
  ================================================== */
define("_NEWLINE", "\n");
define("_TPL", get_template_directory_uri());
define("_SITE", get_home_url('/'));
define("_SITENAME", get_bloginfo("name"));
define('_IMG', _TPL . '/library/images/');
define("_TAGLINE", get_bloginfo("description"));
define("_AJAX", admin_url('admin-ajax.php'));
define("_CMB", "_cmb_");
define("_SITEADMIN", "wordpress@blitsmotion.nl");
define("_SITEERROR", "FOUTMELDING op " . _SITENAME);

/* MRWEB_DEBUG
  ================================================== */

function gtwc_mrweb_init_debug($user_login, $user) {
    if (in_array('administrator', $user->roles)) {
        setcookie('MRWEB_DEBUG', 'on', time() + 86400, '/', '');
        error_log('MRWEB_DEBUG ON');
    }
}

add_action('wp_login', 'gtwc_mrweb_init_debug', 10, 2);

function gtwc_mrweb_stop_debug() {
    //error_log('MRWEB_DEBUG OFF');
    unset($_COOKIE['MRWEB_DEBUG']);
    setcookie('MRWEB_DEBUG', '', time() - 3600);
}

add_action('wp_logout', 'gtwc_mrweb_stop_debug', 10, 0);
/* DEBUG
  ================================================== */

if (!function_exists('grasland_start_admin_debug')) {

    function grasland_start_admin_debug($user_login, $user) {
        if (in_array('administrator', $user->roles)) {
            setcookie('wp_debug', 'on', time() + 86400, '/', '');
        }
    }

}

remove_action('wp_login', 'grasland_start_admin_debug', 10, 2);

if (!function_exists('grasland_stop_admin_debug')) {

    function grasland_stop_admin_debug() {
        setcookie("wp_debug", "", time() - 3600);
    }

}

remove_action('wp_logout', 'grasland_stop_admin_debug', 10, 0);

if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

}

if (!function_exists('notifyAdmin')) {

    function notifyAdmin($message, $subject = _SITEERROR, $to = _SITEADMIN) {
        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }
        $body = $message;
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $body, $headers);
    }

}

if (!function_exists('gtwc_return_cleanstring')) {

    function gtwc_return_cleanstring($str = '') {
        return preg_replace("/(\r\n)+|\r+|\n+|\t+/i", " ", $str);
    }

}

if (!function_exists('gtwc_return_post_meta_value')) {

    function gtwc_return_post_meta_value($post_id, $post_meta_key) {
        $post_meta_value = (!empty(get_post_meta($post_id, _CMB . $post_meta_key, true))) ? get_post_meta($post_id, _CMB . $post_meta_key, true) : '';
        return $post_meta_value;
    }

}

if (!function_exists('gtwc_return_phone_url')) {

    function gtwc_return_phone_url($str) {
        $needles = array("(0)", " ", "-");
        $replacements = array("");
        return "tel:" . str_replace($needles, $replacements, $str);
    }

}

if (!function_exists('gtwc_post_type_has_posts')) {

    function gtwc_post_type_has_posts($post_type = 'post', $meta_key = '', $meta_value = '') {
        $has_posts = false;
        $args = ( '' === $meta_key && '' === $meta_value) ? array('posts_per_page' => -1, 'post_type' => $post_type, 'suppress_filters' => true, 'post_status' => 'publish') : array('posts_per_page' => -1, 'post_type' => $post_type, 'meta_key' => $meta_key, 'meta_value' => $meta_value, 'suppress_filters' => true, 'post_status' => 'publish');
        $posts = get_posts($args);
        if (is_array($posts) && count($posts) > 0) {
            $has_posts = true;
        }
        return $has_posts;
    }

}

if (!function_exists('gtwc_return_post_array')) {

    function gtwc_return_post_array($post_type = 'post', $meta_key = '', $meta_value = '') {

        $array = array();
        $args = array('posts_per_page' => -1, 'post_type' => $post_type, 'suppress_filters' => true);
        if ('vac_functiegroep' === $post_type) {
            $args['orderby'] = 'menu_order';
            $args['order'] = 'ASC';
        } else {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        }
        if ('' !== $meta_key && '' !== $meta_value) {
            $args['meta_key'] = $meta_key;
            $args['$meta_value'] = $meta_value;
        }

        $posts = get_posts($args);
        if (is_array($posts) && count($posts) > 0) {
            $array = $posts;
        }
        return $array;
    }

}

if (!function_exists('gtwc_return_osm_embed')) {

    /**
     * Return embedded iframe with open street map source wrapped in a div with certain class
     * @param string         $osm_iframe_source  iframe source
     * @param string         $osm_wrapper_class  iframe wrapper class
     * @param int            $osm_iframe_height  iframe height. Default 350.
     * @return string with embed code for open street map.
     */
    function gtwc_return_osm_embed($osm_iframe_source = '', $osm_wrapper_class = 'open-street-map', $osm_iframe_height = 350) {
        $iframe_embed = '';
        if (isset($osm_iframe_source) && !empty($osm_iframe_source) && isset($osm_wrapper_class) && !empty($osm_wrapper_class) && isset($osm_iframe_height) && !empty($osm_iframe_height)) {
            $iframe_embed = '<div class="' . $osm_wrapper_class . '"><iframe src="' . $osm_iframe_source . '" scrollwheel="false" width="100%" height="' . $osm_iframe_height . '" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></div>';
        }
        return $iframe_embed;
    }

}

if (!function_exists('gtwc_return_osm_map_link')) {

    /**
     * Return link to open street map large map wrapped in a div with certain class
     * @param string    $osm_map_source         map source
     * @param string    $osm_map_wrapper_class  map wrapper class
     * @param string    $osm_map_link_class     link wrapper class
     * @param string    $osm_map_link_text      link text
     * @return string with link to a larger open street map.
     */
    function gtwc_return_osm_map_link($osm_map_source = '', $osm_map_wrapper_class = 'open-street-map-link-container', $osm_map_link_class = 'open-street-map-link h6 tdn') {
        $map_link = '';
        if (isset($osm_map_source) && !empty($osm_map_source) && isset($osm_map_wrapper_class) && !empty($osm_map_wrapper_class) && isset($osm_map_link_class) && !empty($osm_map_link_class)) {
            $map_link = '<div class="centertext ' . $osm_map_wrapper_class . '"><a href="' . $osm_map_source . '" class="' . $osm_map_link_class . '" target="_blank">' . __('bekijk een grotere routekaart', 'grasland') . '</a></div>';
        }
        return $map_link;
    }

}

/**
 * Return sprite css by spriteName
 * @param string    $spriteName     name of the sprite
 * @param string    $padding        padding values : 0 0 30px 0
 * @return string with sprite css
 */
function gtwc_return_sprite($spriteName, $padding = 0) {
    $spriteCoordinate = '';
    $spriteSize = '';
    $spriteStyle = '';
    $spriteCss = '';
    $spriteUrl = (function_exists('gtwc_return_parts_field')) ? gtwc_return_parts_field(_CMB . 'file_sprite') : '';
    $sprites = array(
        'telefoon' => array('0 0;', 'width:21px;height:21px;'),
        'email' => array('-21px 0;', 'width:21px;height:21px;'),
        'linkedin' => array('0 -21px;', 'width:21px;height:21px;'),
        'profile' => array('-21px -21px;', 'width:21px;height:21px;'),
        'search' => array('-42px 0;', 'width:42px;height:42px;'),
        'quote' => array('-84px 0;', 'width:42px;height:42px;'),
    );
    foreach ($sprites as $key => $value) {
        if ($spriteName === $key) {
            $spriteCoordinate = $value[0];
            $spriteSize = $value[1];
            $spriteStyle = $spriteSize . 'background:url(' . $spriteUrl . ')' . $spriteCoordinate . 'padding:' . $padding . ';';
            break;
        }
    }
    $spriteCss = (!empty($spriteStyle)) ? ' style="' . $spriteStyle . '"' : '';
    return $spriteCss;
}
