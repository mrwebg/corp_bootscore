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
          </div><!-- /.col- -->
          <div class="col-6">
                      
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container.entry-content -->
      <?php get_template_part('includes/footer', 'quote', array('postID' => get_the_ID())); ?>           
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php get_footer();
