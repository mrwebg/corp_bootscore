<?php
/**
* Template Name: Homepage
* front-page.php
* @package WordPress
* @subpackage grasland
*/
?>
<?php get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container">
        <div class="row">
          <div class="col">
            <header class="entry-header text-white mb-4">
              <?php the_post(); ?>
              <!-- Title -->
              <?php the_title('<h1 class="display-1">', '</h1>'); ?>              
              <h2 class="display-2 blog-description"><?php bloginfo('description'); ?></h2><!-- /.blog-description -->
            </header><!-- /.entry-header -->
          </div>
        </div>
      </div><!-- /.container -->
      <!-- FEATURED. -->
      <?php
      $featured_post_type_selected = get_post_meta(get_the_ID(),  _CMB .'featured_select', true);
      if('' !== $featured_post_type_selected){
        $featured_post_id = get_post_meta(get_the_ID(), _CMB .'select_' . $featured_post_type_selected, true);
        if('' !== $featured_post_id && $featured_post_id > 0 ){
          $featured_post   = get_post( intval($featured_post_id) );
          setup_postdata($featured_post);?>
          <div class="container-fluid corp-home-featured-wrapper mb-5">
            <div class="row justify-content-end">
              <div class="col-lg-7 col-xl-6 col-xxxl-5">
                <div class="card card-body corp-featured-post-<?php echo $featured_post_type_selected; ?>">
                  <h3 class=""><a href="<?php echo get_the_permalink($featured_post_id);?>"><?php echo $featured_post->post_title;?></a></h3>
                  <div class="content"><?php echo apply_filters( 'the_content', $featured_post->post_content ); ?></div>
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid .corp-home-featured-wrapper -->
          <?php
          wp_reset_postdata();
        }
      }
      ?>
      <!-- /FEATURED. -->
      <!-- TEASERS. -->
      <div class="container-fluid corp-home-teasers-wrapper mb-4">
        <div class="container text-white">
          <div class="row bg-transparent">
            <div class="col-md">
              <h3 class="h4"><?php echo get_post_meta(get_the_ID(),  _CMB .'positioning_title', true); ?></h3>
              <div><?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'positioning_content', true));?></div>
            </div>
            <div class="col-md">
              <h3 class="h4"><?php echo get_post_meta(get_the_ID(),  _CMB .'trackrecord_title', true); ?></h3>
              <div><?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'trackrecord_content', true));?></div>
            </div>
          </div>
        </div>
      </div><!-- /.corp-home-teasers-wrapper -->
      <!-- /TEASERS. -->
      <?php get_template_part('includes/footer', 'quote', array('postID' => get_the_ID())); ?>
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php
get_footer();
