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
          <div class="col-6">
            <header class="entry-header">
                <?php the_post(); ?>
                <!-- TITLE -->
                <?php the_title('<h1>', '</h1>'); ?>
                <!-- #entry-header -->
              </header>
              <!-- CONTENT -->
              <?php the_content(); ?>
          </div><!-- #col --> 
        </div><!-- #row -->  
        <div class="row">
          <div class="col">
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
              <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php foreach ($post_array as $post) { ?>
                  <?php $expertise = get_the_terms(get_the_ID(), "expertise"); ?>
                  <?php $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : ""; ?>
                  <?php $expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0; ?>
                  <?php setup_postdata($post); ?>
                    <div class="col">
                      <div class="card h-100">
                        <div class="card-body">
                          <h2 class="h5 card-title"><?php the_title(); ?></h5><!-- #card-title -->
                          <h3 class="h6 card-subtitle mb-2 text-muted">card category</h3><!-- #card-subtitle -->
                          <p class="card-text"><?php the_content(); ?></p><!-- #card-text -->
                        </div><!-- #card-body -->
                      </div><!-- #card -->
                    </div><!-- #col -->
                  <?php } ?>
                <?php wp_reset_postdata(); ?>
              </div><!-- #row -->
            <?php } ?>            
          </div><!-- #col -->  
        </div><!-- #row -->     
      </div><!-- #container -->
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
      <!-- #QUOTE. -->                      
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php get_footer();
