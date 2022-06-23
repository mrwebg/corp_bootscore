<?php
/**
* Template Name: Homepage
* front-page.php
* @package WordPress
* @subpackage grasland
*/
?>
<?php get_header();?>
<div id="content" class="site-content mt-5 py-5" style="background-color:rgba(0,0,0,0.5);">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <!-- TITLE & DESCRIPTION. -->
      <div class="container">
        <div class="row">
          <div class="col">
            <header class="entry-header">
              <?php the_post(); ?>
              <!-- Title -->
              <?php the_title('<h1 class="display-1 text-white">', '</h1>'); ?>
              <!-- .entry-header -->
              <h2 class="blog-description text-white"><?php bloginfo('description'); ?></h2>
              <!-- .blog-description -->
            </header>
          </div>
        </div>
      </div>
      <!-- END TITLE & DESCRIPTION. -->
      <!-- FEATURED. -->
      <?php
      $featured_post_type_selected = get_post_meta(get_the_ID(),  _CMB .'featured_select', true);
      if('' !== $featured_post_type_selected){
        $featured_post_id = get_post_meta(get_the_ID(), _CMB .'select_' . $featured_post_type_selected, true);
        if('' !== $featured_post_id && $featured_post_id > 0 ){
          $featured_post   = get_post( intval($featured_post_id) );
          setup_postdata($featured_post);?>
          <div class="container-fluid corp-home-featured-wrapper">
            <div class="row justify-content-end">
              <div class="col-lg-6 col-xxl-4">
                <div class="card card-body corp-featured-post-<?php echo $featured_post_type_selected; ?>">
                  <h3 class=""><a href="<?php echo get_the_permalink($featured_post_id);?>"><?php echo $featured_post->post_title;?></a></h3>
                  <div class="content"><?php echo apply_filters( 'the_content', $featured_post->post_content ); ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php
          wp_reset_postdata();
        }
      }
      ?>
      <!-- END FEATURED. -->
      <!-- TEASERS. -->
      <div class="container-fluid corp-home-teasers-wrapper">
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
      </div>
      <!-- END TEASERS. -->
      <!-- QUOTE. -->
      <?php
      $selected_quote_id = get_post_meta(get_the_ID(),  _CMB .'select_quote', true);
      if('' !== $selected_quote_id && $selected_quote_id > 0 ){
        $selected_quote   = get_post( intval($selected_quote_id) );
        setup_postdata($selected_quote);
        $quote_bron = get_post_meta($selected_quote_id, _CMB . 'text_bron', true);
        $quote_url = get_post_meta($selected_quote_id, _CMB . 'url_bron', true);
        ?>
        <div class="corp-footer-quote-wrapper">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-lg-6">
                <img class="" src="https://corp.nl/_WPCA22/wp-content/uploads/2022/06/Chambers-award.png">
                <figure style="margin:0;">
                  <blockquote class="blockquote">
                    <p><?php echo ucfirst($selected_quote->post_title); ?></p>
                  </blockquote>
                  <?php
                  if('' !== $quote_bron && '' !== $quote_url){?>
                  <figcaption class="blockquote-footer">
                    <a href="<?php echo get_post_meta($selected_quote_id, _CMB . 'url_bron', true);?>" target="_blank"><cite title="<?php echo get_post_meta($selected_quote_id, _CMB .'text_bron', true); ?>"><?php echo strtoupper(get_post_meta($selected_quote_id, _CMB .'text_bron', true)); ?></cite></a>
                  </figcaption>
                  <?php
                }
                ?>
                </figure>
              </div>
            </div>
          </div>
        </div>
        <?php
        wp_reset_postdata();
      }
      ?>
      <!-- END QUOTE. -->
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
