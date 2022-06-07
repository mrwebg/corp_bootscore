<?php

/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Bootscore
*/

?>
<footer>
  <div class="container-fluid bootscore-footer p-3 bg-dark">
    <div class="row">
      <div class="col-md-6 my-auto text-white">
        <?php
        // BEDRIJFSGEGEVENS
        $bedrijfsgegevens = get_option('bedrijfsgegevens');
        if(is_array($bedrijfsgegevens) && count($bedrijfsgegevens) > 0 ):
          $adres_naam = (array_key_exists('adres_naam', $bedrijfsgegevens))? $bedrijfsgegevens['adres_naam'] . ' ' : '';
          $adres_straat = (array_key_exists('adres_straat', $bedrijfsgegevens))? $bedrijfsgegevens['adres_straat'] . ' ' : '';
          $adres_huisnummer = (array_key_exists('adres_huisnummer', $bedrijfsgegevens))? $bedrijfsgegevens['adres_huisnummer'] : '';
          $adres_postcode = (array_key_exists('adres_postcode', $bedrijfsgegevens))? ', ' . $bedrijfsgegevens['adres_postcode'] . ' ' : '';
          $adres_woonplaats = (array_key_exists('adres_woonplaats', $bedrijfsgegevens))? $bedrijfsgegevens['adres_woonplaats'] : '';
          print '<span class="fw-bold">'.$adres_naam.'</span>'.$adres_straat.$adres_huisnummer.$adres_postcode.$adres_woonplaats;
        endif;
        ?>
      </div>
      <div class="col-md-6">
        <?php
        // FOOTER MENU
        wp_nav_menu(array(
          'theme_location' => 'footer-menu',
          'container' => 'nav',
          'container_class'=> 'navbar navbar-expand-md navbar-dark',
          'menu_class' => 'ms-md-auto',
          'fallback_cb' => '__return_false',
          'items_wrap' => '<ul id="footer-menu" class="nav %2$s">%3$s</ul>',
          'depth' => 1,
          'walker' => new bootstrap_5_wp_nav_menu_walker()
        ));
        ?>
      </div>
    </div>
  </div>
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
