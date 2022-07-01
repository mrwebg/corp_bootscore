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
    <div class="container">
      <div class="row">
        <div class="col">
          <?php if (have_posts()):?>
            <?php while (have_posts()) :?>
              <?php the_post(); ?>
              <header class="entry-header">
                <!-- Title -->
                <?php the_title('<h1>', '</h1>'); ?>
              </header><!-- .entry-header -->
              <div class="entry-content">
                <?php the_content(); ?>
                <?php if ( shortcode_exists( 'contact-form-7' ) ) {
                  $cf7_shortcode = '[contact-form-7 id="1585" title="vacature-formulier-nl" vacature_id="'.get_the_ID() .'" vacature_name="'.get_the_title().'"]';
                  echo apply_shortcodes($cf7_shortcode); 
                }?>
              </div><!-- .entry-content-->
            <?php endwhile;?>
          <?php endif; ?>                        
        </div><!-- col -->
      </div><!-- row -->
    </div><!-- container -->    
    </main><!-- #main -->  
  </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();
