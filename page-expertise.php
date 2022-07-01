<?php
/**
* Template Name: Expertise pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col-lg-6 parallax-col" data-scroll-speed="12">
            <header class="entry-header">
              <?php the_post(); ?>
              <!-- Title -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- .entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?>
            <!-- TEAM. -->
            <?php
            // GET EXPERTISE TERM ID & TERM NAME
            $expertise = get_the_terms(get_the_ID(), "expertise");
            $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : "";
            $expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0;
            // ARGS FOR CURRENT TEAM BELONGINGING TO CURRENT EXPERTISE TERM ID.
            $post_type = 'mensen';
            $post_args = array(
              'post_type' => $post_type,
              'post_status' => 'publish',
              'numberposts' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => 'expertise',
                  'field' => 'term_id',
                  'terms' => $expertise_id, /// Where term_id of Term 1 is "1".
                  'include_children' => false
                )
              ),
              'meta_key' => '_cmb_text_achternaam',
              'orderby' => array('meta_value' => 'ASC'),
            );
            $post_array = get_posts($post_args);
            ?>            
            <?php if (is_array($post_array) && count($post_array) > 0): ?>
              <div class="wrapper-expertise-team">
                <?php
                foreach ($post_array as $post):
                  setup_postdata($post);
                  $title = ucfirst(get_the_title());
                  $text_email = get_post_meta(get_the_ID(), _CMB . 'text_email', true);
                  $text_telefoon = get_post_meta(get_the_ID(), _CMB . 'text_telefoon', true);
                  $text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
                  ?>
                  <p>
                    <?php if (!empty($title)) { ?><?php echo $title;?></br><?php } ?>
                    <?php if (!empty($text_email)) { ?><?php echo $text_email;?></br><?php } ?>
                    <?php if (!empty($text_telefoon)) { ?><?php echo $text_telefoon;?></br><?php } ?>
                    <?php if (!empty($text_mobiel)) { ?><?php echo $text_mobiel;?></br><?php } ?>
                  </p>
                <?php endforeach;?>
                <?php wp_reset_postdata(); ?>
              </div>
            <?php endif; ?>
            <!-- #TEAM. -->
            <!-- LEFT COLUMN EXTRA CONTENT. -->          
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'left_column', true))) { ?>              
              <div class="wrapper-expertise-linker-kolom-extra">
                <?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'left_column', true));?>           
              </div>              
            <?php } ?>
            <!-- #LEFT COLUMN EXTRA CONTENT. -->             
          </div><!-- /.col- -->
          <div class="col-6 parallax-col" data-scroll-speed="1">
            <!-- RIGHT COLUMN EXTRA CONTENT. -->
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'right_column', true))) { ?>
              <div class="wrapper-expertise-rechter-kolom-extra">                           
                <?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'right_column', true));?>
              </div>
            <?php } ?>
            <!-- #RIGHT COLUMN EXTRA CONTENT. -->                        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.entry-content -->
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
  <?php
  get_footer();
