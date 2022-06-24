<?php
function corp_widget_contact_sidebar() {
  if ( is_page()){
    global $post;?>
    <!-- widget-contact-sidebar -->
    <?php
    // BEDRIJFSGEGEVENS
    $bedrijfsgegevens = get_option('bedrijfsgegevens');
    if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ){
      $adres_telefoon = (array_key_exists('adres_telefoon', $bedrijfsgegevens))? $bedrijfsgegevens['adres_telefoon'] : '';
      $adres_email = (array_key_exists('adres_email', $bedrijfsgegevens))? $bedrijfsgegevens['adres_email'] : '';
      $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : '';
      if(!empty($adres_telefoon) && '' !== $adres_telefoon && !empty($adres_email) && '' !== $adres_email && !empty($maps_url) && '' !== $maps_url){
        ?>       
        <div class="widget-contact-sidebar-wrapper">
          <ul class="widget-contact-sidebar">
            <li>
              <div class="d-flex flex-row mb-0">
                <div class="p-2"><i class="icon fa-solid fa-phone"></i></div>
                <div class="p-2"><?php echo $adres_telefoon;?></div>       
              </div>
            <li>
              <div class="d-flex flex-row mb-0">
                <div class="p-2"><i class="fa-solid fa-envelope"></i></div>
                <div class="p-2"><?php echo $adres_email;?></div>       
              </div>
            </li>
            <li>
              <div class="d-flex flex-row mb-0">
                <div class="p-2"><i class="fa-solid fa-location-dot"></i></div>
                <div class="p-2"><?php echo $maps_url;?></div>       
              </div>
            </li>
          </ul>
        </div>
<?php
      }
    }
  }
}
add_action( 'wp_footer', 'corp_widget_contact_sidebar' );
