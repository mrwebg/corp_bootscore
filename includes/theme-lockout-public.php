<?php
/* CODE EXECUTED BEFORE HEAD TO CLOSE OFF NOT LOGGED IN USERS FROM FRONTEND
================================================== */
add_action('template_redirect', 'corp_bailout_non_users', 10);
function corp_bailout_non_users() {

  if (function_exists('is_user_logged_in') && false === is_user_logged_in()) {
    if (function_exists('wp_safe_redirect')) {
      $location = wp_login_url();
      wp_safe_redirect($location);
      exit;
    }
  }
}
