<?php
/**
* single-vacature.php
* @package WordPress
* @subpackage corp
*/
?>
<?php get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col-lg-6 parallax-col" data-scroll-speed="12">
            <header class="entry-header">
              <?php the_post(); ?>
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- .entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?>         
          </div><!-- #col- -->
          <div class="col-6 parallax-col" data-scroll-speed="1">          
            <!-- RIGHT COLUMN EXTRA CONTENT. -->
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'right_column_intro_title', true))) { ?>
              <div class="wrapper-contact-intro-cf7">                           
                <?php //echo wpautop(get_post_meta(get_the_ID(), _CMB . 'right_column', true));?>
              </div>
            <?php } ?>
            <!-- #RIGHT COLUMN EXTRA CONTENT. -->
            <div class="wrapper-contact-cf7-featured-image" style="padding:25px;background-color:#fff;"> 
            <!-- CONTACT FORM 7. -->             
            <?php if ( shortcode_exists( 'contact-form-7' ) ) {?>
              <div class="wrapper-expertise-rechter-kolom-extra">  
                  <?php $cf7_shortcode = '[contact-form-7 id="1585" title="vacature-formulier-nl"]';?>
                  <?php echo apply_shortcodes($cf7_shortcode);?>
              </div> 
            <?php } ?>
            <!-- #CONTACT FORM 7. -->
            <!-- FEATURED BACKGROUND IMAGE. -->             
            <?php
            $html = '<!-- FEATURED IMAGE BACKGROUND. -->';
            $featured_image_alt = get_the_title();
            $featured_thumbail_id = get_post_thumbnail_id(get_the_ID());
            if(!empty($featured_thumbail_id) && $featured_thumbail_id > 0){
            $featured_image_source = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full")[0];
            if(!empty($featured_image_source) && '' !== $featured_image_source){
            $html .='
            <figure class="featured-image-background">
            <picture>
            <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
            </picture>
            <noscript>
            <picture>
            <img src="'.$featured_image_source.'" alt="'.$featured_image_alt.'">
            </picture>
            </noscript>
            </figure>
            <!-- #FEATURED IMAGE BACKGROUND. -->
            ';
            }
            }
            echo $html;            
            ?>
            <!-- #FEATURED BACKGROUND IMAGE. -->              
            </div><!-- #wrapper-contact-cf7-featured-image -->                                                        
          </div><!-- #col -->
        </div><!-- #row -->
      </div><!-- #container -->       
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();
