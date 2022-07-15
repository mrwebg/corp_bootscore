<?php
/*
	 * Template Post Type: post
	 */

get_header();  ?>

<div id="content" class="site-content SINGLEMRWEB">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">  
      <div class="row">
          <div class="col-6">
            <header class="entry-header">
              <?php the_post(); ?>
              <h1><?php echo get_the_title(); ?></h1>
            </header>
            <!-- thumbnail -->
            <?php bootscore_post_thumbnail(); ?>
          </div><!-- /.col -->  
          <div class="col-6">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
            Contact optional
          </div><!-- /.col -->            
        </div><!-- /.row -->
        
        <div class="row">
          <div class="col">        
          <footer class="entry-footer clear-both">
              <div class="mb-4">
                <?php bootscore_tags(); ?>
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <?php previous_post_link('%link'); ?>
                  </li>
                  <li class="page-item">
                    <?php next_post_link('%link'); ?>
                  </li>
                </ul>
              </nav>
            </footer>
          </div><!-- /.col -->            
        </div><!-- /.row -->

      </div> <!-- /.container -->           
    </main><!-- /#main -->
  </div><!-- /#primary -->
</div><!-- /#content -->
<?php get_footer();