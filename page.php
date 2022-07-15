<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package corp_bootscore
 */

get_header();
?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">  
        <div class="row">
          <div class="col-6 parallax-col" data-scroll-speed="12">
            <header class="entry-header">
              <?php the_post(); ?>
              <h1><?php echo get_the_title(); ?></h1>
            </header>
          </div><!-- /.col -->  
          <div class="col-6 parallax-col" data-scroll-speed="1">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>                                           
          </div><!-- /.col -->            
        </div><!-- /.row -->        
      </div> <!-- /.container -->           
    </main><!-- /#main -->
  </div><!-- /#primary -->
</div><!-- /#content -->
<?php get_footer();