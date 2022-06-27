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
      $social_linkedin = (array_key_exists('social_linkedin', $bedrijfsgegevens))? $bedrijfsgegevens['social_linkedin'] : '';
      $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : '';
      if(!empty($adres_telefoon) && '' !== $adres_telefoon && !empty($adres_email) && '' !== $adres_email && !empty($maps_url) && '' !== $maps_url){
        ?>       
        <div class="widget-contact-sidebar-wrapper">
          <ul class="widget-contact-sidebar">
            <li>
              <svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg><span><?php echo $adres_telefoon;?></span>  
            </li>     
            <li>
              <svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg><span class="p-2"><?php echo $adres_email;?></span>       
            </li>
            <li>
              <svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg><span class="p-2"><?php echo $social_linkedin;?></span>       
            </li>            
            <li>
              <svg class="icon icon-location"><use xlink:href="#icon-location"></use></svg><span class="p-2"><?php echo $maps_url;?></span>       
            </li>
          </ul>
        </div>
<?php
      }
    }
  }
}
add_action( 'wp_footer', 'corp_widget_contact_sidebar' );
