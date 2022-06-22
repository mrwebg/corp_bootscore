<?php
function corp_widget_contact_sidebar() {
  if ( is_page()){
    global $post;
    $html = '<!-- widget-contact-sidebar -->';
    // BEDRIJFSGEGEVENS
    $bedrijfsgegevens = get_option('bedrijfsgegevens');
    if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ){
      $adres_telefoon = (array_key_exists('adres_telefoon', $bedrijfsgegevens))? $bedrijfsgegevens['adres_telefoon'] : '';
      $adres_email = (array_key_exists('adres_email', $bedrijfsgegevens))? $bedrijfsgegevens['adres_email'] : '';
      $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : '';
      if(!empty($adres_telefoon) && '' !== $adres_telefoon && !empty($adres_email) && '' !== $adres_email && !empty($maps_url) && '' !== $maps_url){
        $html .='
        <div class="widget-contact-sidebar-wrapper">
        <ul class="widget-contact-sidebar">
        <li>'.$adres_telefoon.'</li>
        <li>'.$adres_email.'</li>
        <li>'.$maps_url.'</li>
        </ul>
        </div>
        ';
      }
    }
    echo $html;
  }
}
add_action( 'wp_footer', 'corp_widget_contact_sidebar' );
