<?php
/**
* Template Name: Single Page Vacature
* Template Post Type: vacature
* @package WordPress
* @subpackage corp_bootscore
*/
?>
<?php get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col-lg-6 corp-col-white-bg parallax-col" data-scroll-speed="12">
            <header class="entry-header">
              <?php the_post(); ?>
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- ..entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?>         
          </div><!-- /.col- -->
          <div class="col-lg-6 corp-col-white-bg parallax-col" data-scroll-speed="1"> 
            <div class="wrapper-contact-cf7-intro"> 
              <!-- RIGHT COLUMN CF7 INTRO. -->
              <h2 class="h4 corp-heading-border-bottom border-offset-right cf7_intro_title"><?php echo esc_html_e('Interesse? Neem contact met ons op.', 'corp' ); ?></h2><!-- /.cf7_intro_title -->  
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'cf7_intro_body', true))) { ?>
              <p class="cf7_intro_body"><?php echo get_post_meta(get_the_ID(), _CMB . 'cf7_intro_body', true) ;?></p><!-- /.cf7_intro_body -->  
            <?php } ?>            
              <h2 class="h4 corp-heading-border-bottom cf7_intro_title"><?php echo esc_html_e('Interesse? Neem contact met ons op.', 'corp' ); ?></h2><!-- /.cf7_intro_title -->  
              <p class="cf7_intro_body"><?php echo esc_html_e('Stuur door middel van onderstaand formulier je gegevens dan nemen wij spoedig contact met je op.', 'corp' ); ?></p><!-- /.cf7_intro_body -->                          
            </div><!-- /.wrapper-contact-cf7-intro -->
            <div class="wrapper-contact-cf7-featured-image mt-3 mb-3"> 
            <!-- CONTACT FORM 7. -->             
            <?php if ( shortcode_exists( 'contact-form-7' ) ) {?>
              <div class="wrapper-vacature-cf7"> 
                <?php $cf7_shortcode = '[contact-form-7 id="1585" title="vacature-formulier-nl"]';?>
                <?php echo apply_shortcodes($cf7_shortcode);?>
              </div><!-- /.wrapper-vacature-cf7 -->  
            <?php } ?>
            <!-- FEATURED BACKGROUND IMAGE. -->             
            <?php
            $featured_image_alt = get_the_title();
            //$featured_thumbail_id = get_post_thumbnail_id(get_the_ID());
            //if(!empty($featured_thumbail_id) && $featured_thumbail_id > 0){
              //$featured_image_source = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full")[0];
              $featured_image_source = 'https://corp.nl/_WPCA22/wp-content/uploads/2022/06/praia-de-odeceixe-mar-beach-wallpaper-preview.jpg';
              if(!empty($featured_image_source) && '' !== $featured_image_source){
                $html ='<figure class="featured-image-background-left">
                <picture>
                <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
                </picture>
                <noscript>
                <picture>
                <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
                </picture>
                </noscript>
                </figure><!-- /.featured-image-background -->';
              }
              echo $html;                 
            //}           
            ?>             
            </div><!-- /.wrapper-contact-cf7-featured-image --> 
            <!-- RIGHT COLUMN CONTACT PERSON INTRO. -->
              <h2 class="h5 cf7_contactpersoon_titel corp-heading-border-bottom border-offset-right"><?php echo esc_html_e('Of neem direct contact op met:', 'corp' ); ?></h2><!-- /.cf7_contactpersoon_titel -->                                             
            <?php
            $mensenID = intval(get_post_meta(get_the_ID(), _CMB . 'vacature_contact', true));
            if(!empty($mensenID) && is_int($mensenID)){                
              $postMensen = get_post($mensenID);
              $post_title = $postMensen->post_title;
              $text_email = get_post_meta($mensenID, _CMB . 'text_email', true);
              $text_telefoon = get_post_meta($mensenID, _CMB . 'text_telefoon', true);
              $text_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $text_telefoon);                
              $text_mobiel = get_post_meta($mensenID, _CMB . 'text_mobiel', true);
              $text_mobiel_formatted = str_replace(array(' ', '(', ')'), "", $text_mobiel);                   
              $permalink = get_the_permalink($mensenID); 
            } 
            if(!empty($post_title) && !empty($text_email) && !empty($permalink)){?>
              <div class="wrapper-vacatures-rechter-kolom-contactpersoon"> 
                <h3 class="contactpersoon-title"><a href="<?php echo $permalink;?>"><?php echo $post_title; ?></a></h3>
                <ul class="corp-contact-icons corp-contact-icons-row">
                  <?php if(!empty($text_telefoon_formatted)) { ?>
                    <li>
                      <a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a> 
                    </li>
              <div class="wrapper-vacatures-rechter-kolom-contactpersoon">                 
                <h3 class="h4 team-title"><a href="<?php echo $permalink;?>"><?php echo $post_title; ?></a></h3><!-- /.h4.team-title -->
                <ul class="corp-contact-icons corp-contact-icons-row">
                  <?php if (!empty($text_telefoon)) { ?>
                    <li title="<?php echo $text_telefoon;?>"><a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a> <span><?php echo $text_telefoon;?></span></li>
                  <?php } ?>
                  <?php if (!empty($text_mobiel)) { ?>
                    <li title="<?php echo $text_mobiel;?>"><a href="tel:<?php echo $text_mobiel_formatted;?>" target="_blank"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></a> <span><?php echo $text_mobiel;?></span></li>
                  <?php } ?>                      
                  <?php if (!empty($text_email)) { ?>
                    <li title="<?php echo $text_email;?>"><a href="mailto:<?php echo $text_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg></a> <span><?php echo $text_email;?></span></li>
                  <?php } ?>                      
                </ul><!-- /.corp-contact-icons.corp-contact-icons-row -->                
              </div><!-- /.wrapper-vacatures-rechter-kolom-contactpersoon -->                                
            <?php } ?>                                                                                            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container.entry-content -->
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- #content -->
<?php get_footer();