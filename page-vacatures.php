<?php
/**
* Template Name: Vacatures pagina
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
            <!-- Content -->
            <?php the_content(); ?>
          </div><!-- #col -->
          <div class="col-6 parallax-col" data-scroll-speed="1">
            <!-- VACATURES -->
            <?php
            $post_type = 'vacature';
            $post_args = array(
              'post_type' => $post_type,
              'post_status' => 'publish',
              'posts_per_page' => -1,
              'order' => 'ASC',
              'orderby' => 'menu_order'
            );
            if (!is_admin()) {
              if (function_exists('pll_is_translated_post_type') && false !== pll_is_translated_post_type($post_type)) {
                $current_post_id = (isset($_GET['post'])) ? $_GET['post'] : '';
                if (!empty($current_post_id) && function_exists('pll_get_post_language')) {
                  $current_post_language = pll_get_post_language($current_post_id);
                  if (false !== $current_post_language) {
                    $post_args['lang'] = $current_post_language;
                  }
                }
              }
            }
            $post_array = get_posts($post_args);
            ?>            
            <?php if (is_array($post_array) && count($post_array) > 0){ ?>
              <div class="row">
                <?php
                foreach ($post_array as $post):
                  setup_postdata($post);
                  $url = get_the_permalink();
                  ?>
                  <div class="col">
                    <div class="card h-100">
                      <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo $url;?>"><?php the_title(); ?></a></h5>
                        <?php the_content(); ?>
                      </div>
                    </div><!-- .card -->
                  </div><!-- .col -->
                <?php endforeach;?>
                <?php wp_reset_postdata(); ?>
              </div>
              <?php } ?>
              <!-- #VACATURES --> 
              <!-- RIGHT COLUMN EXTRA CONTENT. -->
              <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'right_column', true))) { ?>
                <div class="wrapper-vacatures-rechter-kolom-extra">                           
                  <?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'right_column', true));?>
                </div>
              <?php } ?>
              <!-- #RIGHT COLUMN EXTRA CONTENT. -->
              <!-- RIGHT COLUMN CONTACT PERSON. -->                         
              <?php
              $mensenID = intval(get_post_meta(get_the_ID(), _CMB . 'vacature_contact', true));
              if(!empty($mensenID) && is_int($mensenID)){
                $postMensen = get_post($mensenID);
                $post_title = $postMensen->post_title;
                $text_email = get_post_meta($mensenID, _CMB . 'text_email', true);
                $text_telefoon = get_post_meta($mensenID, _CMB . 'text_telefoon', true);
                $text_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $text_telefoon);                
                $text_mobiel = get_post_meta($mensenID, _CMB . 'text_mobiel', true);
                $text_mobiel_formatted = str_replace(array(' ', '(', ')'), "", $text_mobiel);                   
                $permalink = get_the_permalink($mensenID); 
              } 
              if(!empty($post_title) && !empty($text_email) && !empty($permalink)){?>
                <div class="wrapper-vacatures-rechter-kolom-contactpersoon"> 
                  <h5><a href="<?php echo $permalink;?>"><?php echo $post_title; ?></a></h5>                          
                  <ul class="contactperson-icons">
                    <?php if(!empty($text_telefoon_formatted)) { ?>
                      <li>
                        <a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a> 
                      </li>
                    <?php } ?>
                    <?php if(!empty($text_mobiel_formatted)) { ?>
                      <li>
                        <a href="tel:<?php echo $text_mobiel_formatted;?>" target="_blank"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></a> 
                      </li>
                    <?php } ?>                      
                    <?php if(!empty($text_email)) { ?>                        
                      <li>
                        <a href="mailto:<?php echo $text_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg></a>      
                      </li>
                    <?php } ?>                     
                  </ul>                  
                </div>                                
              <?php } ?>             
              <!-- #RIGHT COLUMN CONTACT PERSON. -->                       
            </div><!-- #col -->
          </div><!-- #row -->
        </div><!-- #container -->               
      </main><!-- #main -->      
    </div><!-- #primary -->
  </div><!-- #content -->
  <?php
  get_footer();
