<?php
function corp_widget_contact_sidebar() {
  if ( is_page()){
    global $post;?>
    <!-- WIDGET CONTACT SIDEBAR -->
    <?php
    // BEDRIJFSGEGEVENS
    $bedrijfsgegevens = get_option('bedrijfsgegevens');
    if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ){
      $adres_telefoon = (array_key_exists('adres_telefoon', $bedrijfsgegevens))? $bedrijfsgegevens['adres_telefoon'] : '';
      $adres_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $adres_telefoon);
      $adres_email = (array_key_exists('adres_email', $bedrijfsgegevens))? $bedrijfsgegevens['adres_email'] : '';
      $social_linkedin = (array_key_exists('social_linkedin', $bedrijfsgegevens))? $bedrijfsgegevens['social_linkedin'] : '';
      $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : '';
      if(!empty($adres_telefoon) && '' !== $adres_telefoon && !empty($adres_email) && '' !== $adres_email && !empty($maps_url) && '' !== $maps_url){
        ?>  
        <style>
          .widget-contact-sidebar-wrapper {
            position:absolute;
            top: 0;
            right:0px;
            width:48px;
            height:100%;
            background-color:#000;
            z-index: 5000;
          }
          .widget-contact-sidebar {
            list-style:none;
            position:absolute;
            left:10px;
            top:50vh;
            margin:0;
            padding:0;
          }
          .widget-contact-sidebar > li{
            white-space: nowrap;
            padding-left:.5rem;            
          } 
          .widget-contact-sidebar span{
            padding-left:.1rem;
          }          
          .widget-contact-sidebar svg, .widget-contact-sidebar span, .widget-contact-sidebar a{
            color:#fff;
          }                               
        </style>     
        <div class="widget-contact-sidebar-wrapper">
          <ul class="widget-contact-sidebar">
            <li>
              <a href="tel:<?php echo $adres_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg><span><?php echo $adres_telefoon;?></span></a> 
            </li>     
            <li>
              <a href="mailto:<?php echo $adres_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg><span><?php echo $adres_email;?></span></a>      
            </li>
            <li>
              <a href="<?php echo $social_linkedin;?>" target="_blank"><svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg><span><?php _e('Volg ons op Linkedin', 'corp'); ?></span></a>       
            </li>            
            <li>
              <a href="<?php echo $maps_url;?>" target="_blank"><svg class="icon icon-location"><use xlink:href="#icon-location"></use></svg><span><?php esc_html_e('Lokatie op Google Maps', 'corp'); ?></span></a>       
            </li>
          </ul>
        </div>
        <!-- #WIDGET CONTACT SIDEBAR -->
<?php
      }
    }
  }
}
add_action( 'wp_footer', 'corp_widget_contact_sidebar' );
