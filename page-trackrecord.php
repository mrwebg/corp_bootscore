<?php
/**
* Template Name: Trackrecord pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col-12 col-lg-6">
            <header class="entry-header">
                <?php the_post(); ?>
                <!-- TITLE -->
                <?php the_title('<h1>', '</h1>'); ?>
                <!-- /.entry-header -->
              </header>
              <!-- CONTENT -->
              <?php the_content(); ?>
          </div><!-- /.col --> 
        </div><!-- /.row -->  
        <div class="corp-track-records-wrapper">
          <!-- TRACK RECORDS  -->
            <?php
            $post_type = 'deals';
            $post_args = array(
              'post_type' => $post_type,
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'suppress_filters' => true,
            );
            $post_array = get_posts($post_args);
            ?>
            <?php if (is_array($post_array) && count($post_array) > 0) { ?>
              <div class="row">
                <?php foreach ($post_array as $post) { ?>
                  <?php $expertise = get_the_terms(get_the_ID(), "expertise"); ?>
                  <?php $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : ""; ?>
                  <?php $expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0; ?>
                  <?php setup_postdata($post); ?>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                      <div class="corp-track-record">
                          <h2 class="h5 corp-track-record-title"><?php the_title(); ?></h5><!-- /.corp-track-record-title -->
                          <div class="corp-track-record-title-border"></div>
                          <p class="corp-track-record-subtitle">card category</p><!-- /.corp-track-record-subtitle -->
                          <?php the_content(); ?>
                      </div><!-- /.corp-track-record -->
                    </div><!-- /.col -->
                  <?php } ?>
                <?php wp_reset_postdata(); ?>
              </div><!-- /.row -->
            <?php } ?>
          <!-- /TRACK RECORDS  -->               
        </div><!-- /.corp-track-records-wrapper --> 
      </div><!-- /.container -->
      <?php get_template_part('includes/footer', 'quote', array('postID' => get_the_ID())); ?>                    
    </main><!-- main -->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php get_footer();
