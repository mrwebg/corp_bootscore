<?php
/**
* Template Name: Contact pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col-lg-6">
            <header class="entry-header">
              <?php the_post(); ?>
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- .entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?>
            <!-- LEFT COLUMN ADRES & MAPS. --> 
            <?php $bedrijfsgegevens = get_option('bedrijfsgegevens');?>
            <?php if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ){
              $adres_naam = (array_key_exists('adres_naam', $bedrijfsgegevens))? $bedrijfsgegevens['adres_naam'] : 'bedrijfsnaam ontbreekt';
              $adres_straat = (array_key_exists('adres_straat', $bedrijfsgegevens))? $bedrijfsgegevens['adres_straat'] : 'straatnaam ontbreekt';
              $adres_huisnummer = (array_key_exists('adres_huisnummer', $bedrijfsgegevens))? $bedrijfsgegevens['adres_huisnummer'] : 'huisnummer ontbreekt';
              $adres_postcode = (array_key_exists('adres_postcode', $bedrijfsgegevens))? $bedrijfsgegevens['adres_postcode'] : 'postcode ontbreekt';
              $adres_woonplaats = (array_key_exists('adres_woonplaats', $bedrijfsgegevens))? $bedrijfsgegevens['adres_woonplaats'] : 'woonplaats ontbreekt';
              $maps_url = (array_key_exists('maps_url', $bedrijfsgegevens))? $bedrijfsgegevens['maps_url'] : 'map url ontbreekt';
              ?>
              <div class="wrapper-contact-adres-map-link">
                <p>
                  <?php echo $adres_naam; ?></br>
                  <?php echo $adres_straat; ?> <?php echo $adres_huisnummer; ?></br>
                  <?php echo $adres_postcode; ?> <?php echo $adres_woonplaats; ?>
                </p>
                <p class="maps-url">
                  <a href="<?php echo $maps_url; ?>" target="_blank"><?php echo esc_html_e('Locatie op Google Maps', 'corp' ); ?></a>
                </p>
              </div>
            <?php } ?>
          </div><!-- /.col- -->
          <div class="col-6">
            <!-- RIGHT COLUMN CONTACT ICONS. -->
            <?php if (is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0) {
              $adres_telefoon = (array_key_exists('adres_telefoon', $bedrijfsgegevens))? $bedrijfsgegevens['adres_telefoon'] : 'telefoon nummer ontbreekt';
              $adres_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $adres_telefoon);                 
              $adres_email = (array_key_exists('adres_email', $bedrijfsgegevens))? $bedrijfsgegevens['adres_email'] : 'e-mailadres ontbreekt';
              $social_linkedin = (array_key_exists('social_linkedin', $bedrijfsgegevens))? $bedrijfsgegevens['social_linkedin'] : 'linkedin url ontbreekt'; ?>
            <?php } ?>
            <div class="wrapper-contact-icons">
              <h2><?php echo esc_html_e('Direct contact', 'corp' ); ?></h2>
              <ul class="list-contact-icons">
              <?php if (!empty($adres_email)) { ?>
                <li title="<?php echo $adres_email;?>">
                  <a href="mailto:<?php echo $adres_email;?>" target="_blank">
                    <svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg>
                  </a>
                  <span><?php echo $adres_email; ?></span>
                </li>
              <?php } ?>                 
              <?php if (!empty($adres_telefoon)) { ?>
                <li title="<?php echo $adres_telefoon;?>">
                  <a href="tel:<?php echo $adres_telefoon_formatted;?>" target="_blank">
                    <svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg>
                  </a>
                  <span><?php echo $adres_telefoon; ?></span>
                </li>
              <?php } ?>
              <?php if (!empty($social_linkedin)) { ?>
                <li title="<?php echo $social_linkedin;?>">
                  <a href="<?php echo $social_linkedin;?>" target="_blank">
                    <svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg>
                  </a>
                  <span><?php echo esc_html_e('Volg ons op Linkedin', 'corp' ); ?></span>
                </li>
              <?php } ?>              
              </ul>  
            </div>                                              
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
            <div class="wrapper-contact-algemene-info">
              <h2><?php echo esc_html_e('Algemene informatie', 'corp' ); ?></h2>
              <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'algemene_informatie', true))) { ?>              
              <div class="contact-algemene-info"><?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'algemene_informatie', true));?></div>
              <?php } ?>  
            </div>         
          </div><!-- /.col- -->
        </div><!-- /.row -->        
      </div><!-- /.container.entry-content -->          
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php get_footer();
