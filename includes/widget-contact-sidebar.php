<?php
function corp_widget_contact_sidebar() {
  global $post;
  $bedrijfsgegevens = get_option('bedrijfsgegevens');
  if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ){
    $adres_telefoon = (array_key_exists('adres_telefoon', $bedrijfsgegevens))? $bedrijfsgegevens['adres_telefoon'] : '';
    $adres_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $adres_telefoon);
    $adres_email = (array_key_exists('adres_email', $bedrijfsgegevens))? $bedrijfsgegevens['adres_email'] : '';
    $social_linkedin = (array_key_exists('social_linkedin', $bedrijfsgegevens))? $bedrijfsgegevens['social_linkedin'] : '';
    $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : '';
    if(!empty($adres_telefoon) && '' !== $adres_telefoon && !empty($adres_email) && '' !== $adres_email && !empty($maps_url) && '' !== $maps_url){
      ?> 
      <!-- widget-contact-sidebar-wrapper --> 
      <div class="widget-contact-sidebar-wrapper">
        <ul class="widget-contact-sidebar">
          <li class="d-none d-md-block"><!-- phone icon with tooltip on desktop -->
            <a href="#" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $adres_telefoon;?>"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a> 
          </li>  
          <li class="d-block d-md-none"><!-- phone icon with tel: link on mobile -->
            <a href="tel:<?php echo $adres_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a>
          </li>             
          <li>
            <a href="mailto:<?php echo $adres_email;?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $adres_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg><span><?php echo $adres_email;?></span></a>      
          </li>
          <li>
            <a href="<?php echo $social_linkedin;?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo esc_html_e('Volg ons op Linkedin', 'corp' ); ?>" target="_blank"><svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg><span><?php esc_html_e('Volg ons op Linkedin', 'corp'); ?></span></a>       
          </li>            
          <li>
            <a href="<?php echo $maps_url;?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo esc_html_e('Locatie op Google Maps', 'corp' ); ?>" target="_blank"><svg class="icon icon-location"><use xlink:href="#icon-location"></use></svg><span><?php esc_html_e('Lokatie op Google Maps', 'corp'); ?></span></a>       
          </li>                        
        </ul>
      </div>
      <!-- /.widget-contact-sidebar-wrapper -->
<?php
    }
  }
}
add_action( 'wp_footer', 'corp_widget_contact_sidebar' );
