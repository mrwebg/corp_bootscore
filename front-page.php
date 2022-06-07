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
      <div class="container py-5">
        <div class="row">
          <div class="col bg-transparent">
            <header class="entry-header py-3">
              <?php the_post(); ?>
              <!-- Title -->
              <?php the_title('<h1 class="display-1 text-white py-3">', '</h1>'); ?>
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
      $featured_post_type_selected = get_post_meta(get_the_ID(),  _CMB .'featured_select', true);//  '', post, deals
      if('' !== $featured_post_type_selected){
        $featured_post_id = get_post_meta(get_the_ID(), _CMB .'select_' . $featured_post_type_selected, true);
        if('' !== $featured_post_id && $featured_post_id > 0 ){
          $featured_post   = get_post( intval($featured_post_id) );
          setup_postdata($featured_post);?>
          <div class="container-fluid my-5">
            <div class="row">
              <div class="col-lg-6 col-xxl-4 ms-auto px-5 py-4 my-3 bg-light">
                <div class="h6">Featured: (<?php echo $featured_post_type_selected; ?>)</div>
                <div class="h5"><a href="<?php echo get_the_permalink($featured_post_id);?>"><?php echo $featured_post->post_title;?></a></div>
                <div><?php echo apply_filters( 'the_content', $featured_post->post_content ); ?></div>
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
      <div class="container-fluid mt-5">
        <div class="container-left-md text-white" style="border-top:dotted #fff 2px;">
          <div class="row bg-transparent">
            <div class="col-md pt-3 pb-5 px-3">
              <h3 style="min-height:70px;"><?php echo get_post_meta(get_the_ID(),  _CMB .'positioning_title', true); ?></h3>
              <div class="small"><?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'positioning_content', true));?></div>
            </div>
            <div class="col-md pt-3 pb-5 px-3">
              <h3 style="min-height:70px;"><?php echo get_post_meta(get_the_ID(),  _CMB .'trackrecord_title', true); ?></h3>
              <div class="small"><?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'trackrecord_content', true));?></div>
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
        <div class="container-fluid mb-5">
          <div class="container-right-md bg-dark text-white bg-opacity-75">
            <div class="row justify-content-md-center my-5">
              <div class="col"></div>
              <div class="col-md-auto py-3 text-center">
                <img src="https://corp.nl/_WPCA22/wp-content/uploads/2022/06/chambers-150-100.png">
              </div>
              <div class="col px-1 d-flex align-items-center">
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
        </div><!-- container-fluid mt-5 px-0 -->
        <?php
        wp_reset_postdata();
      }
      ?>
      <!-- END QUOTE. -->
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->


<!--div class="container-fluid mt-5 px-0">
  <div class="container-right-md" style="height:100px;border-top:dotted #000 2px;">
    <div class="row" style="background-color:rgba(125,90, 255, .5)">
      <div class="col-md"><h2>Container right</h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
      <div class="col-md"><h2>Vestibulum ante ipsum </h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
      <div class="col-md"><h2>Vestibulum ante ipsum </h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
    </div>
  </div>
</div-->
<!--div class="container-fluid mt-5 px-0">
  <div class="container-left-md" style="background-color:rgba(0,0,0,0.85);color:#fff;height:100px;border:dotted #fff 2px;">
    <div class="row">
      <div class="col">
        container left
      </div>
    </div>
  </div>
</div-->

<!--div class="container-fluid mt-5 px-0">
  <div class="container-left-md" style="height:100px;border-top:dotted #000 2px;">
    <div style="padding:1rem;"><h2>Container left</h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
  </div>
</div-->




<?php
get_footer();
