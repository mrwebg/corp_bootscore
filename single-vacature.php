<?php
/**
* single-vacature.php
* @package WordPress
* @subpackage corp
*/
?>
<?php get_header();
<div id="content" class="site-content container py-5 mt-5">
  <div id="primary" class="content-area">
    <div class="row">
      <div class="col-md-8 col-xxl-9">
        <main id="main" class="site-main">
          <?php if (have_posts()):?>
            <?php while (have_posts()) :?>
              <?php the_post(); ?>
              <header class="entry-header">
                <h1>title: <?php echo $title;?></h1>
              </header><!-- .entry-header -->
              <div class="entry-content">
                <?php the_content(); ?>

                        </div><!-- .entry-content -->
            <?php endwhile;?>
          <?php endif; ?>                        
        </main><!-- #main -->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();
