<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 */

get_header();
?>

<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">      
        <?php $count = 0; ?>
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) :?> 
            <?php the_post(); ?>
            <?php $count++; ?>        
            <?php if (1 === $count)  :?>
              <div class="row blog-row-1">
                <div class="col">
                  <div class="card-body">
                    <!-- Title -->
                    <h2 class="blog-post-title">
                      <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a>
                    </h2>
                    <!-- Excerpt & Read more -->
                    <div class="card-text mt-auto">
                      <?php the_excerpt(); ?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more »', 'corp'); ?></a>
                    </div>
                  </div><!-- /.card-body -->                  
                </div><!-- /.col -->  
              </div><!-- /.row.blog-row-1 -->                               
            <?php else: ?>
              <?php if (2 === $count) : ?>               
                <div class="row blog-row-2"><!-- .row OPEN row for 6 items-->
              <?php endif; ?>              
              <div class="col col-md-6">
                <div class="card-body">
                  <!-- Title -->
                  <h2 class="blog-post-title">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h2>
                  <!-- Excerpt & Read more -->
                  <div class="card-text mt-auto">
                    <?php the_excerpt(); ?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more »', 'corp'); ?></a>
                  </div>
                </div><!-- /.card-body --> 
              </div><!-- /.col -->  
            <?php endif; ?>
            <?php if (get_option( 'posts_per_page' ) === $count) : ?>
              </div><!-- /.row.blog-row-2 CLOSE row for 6 items-->    
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>

        <div class="row">
          <div class="col">
            <!-- Pagination -->
            <div>
              <?php bootscore_pagination(); ?>
            </div> 
          </div><!-- /.col -->  
        </div><!-- /.row -->                         
      </div> <!-- /.container -->           
    </main><!-- /#main -->
  </div><!-- /#primary -->
</div><!-- /#content -->
<?php get_footer();