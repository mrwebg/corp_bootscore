<?php
/**
* Template Name: Team pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col">
            <header class="entry-header">
            <?php the_post(); ?>
              <!-- Title -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- /.entry-header -->
            </header>
            <!-- Content -->
            <?php the_content(); ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <?php
          $post_type = 'mensen';
          $post_args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key' => '_cmb_text_achternaam',
            'orderby' => array('meta_value' => 'ASC'),
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
          <?php if (is_array($post_array) && count($post_array) > 0): ?>
            <?php foreach ($post_array as $post): ?>
              <?php
              setup_postdata($post);
              $url = get_the_permalink();
              $text_email = get_post_meta(get_the_ID(), _CMB . 'text_email', true);
              $text_telefoon = get_post_meta(get_the_ID(), _CMB . 'text_telefoon', true);
              $text_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $text_telefoon);              
              $text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
              $text_mobiel_formatted = str_replace(array(' ', '(', ')'), "", $text_mobiel);
              $expertise = get_the_terms(get_the_ID(), "expertise");
              $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : ""; 
              $expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0;              
              $expertise_page_url = mrweb_expertise_page_url($expertise_id);
              print_f($expertise_page_url);             
              $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "thumbnail")[0];
              $portrait = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "team-portrait")[0];
              ?>
              <div class="col-3">
                <div class="card h-100">
                  <div class="card-body">
                    <figure class="team-portrait-medium">
                      <picture><img src="<?php echo $portrait;?>" alt="<?php echo get_the_title();?>"></picture>
                      <noscript><picture><img src="<?php echo $portrait;?>" alt="<?php echo get_the_title();?>"></picture></noscript>
                    </figure><!-- /.team-thumbnail -->
                    <h2 class="h3 card-title"><a href="<?php echo $url;?>"><?php the_title(); ?></a></h2><!-- /.card-title -->
                    <?php if (!empty($expertise_name)){ ?><h3 class="h6 card-subtitle mb-2 text-muted"><?php echo $expertise_name;?></h3><?php } ?>
                    <ul class="card-list-team-icons">
                      <?php if (!empty($text_telefoon)) { ?>
                        <li title="<?php echo $text_telefoon;?>"><a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a></li>
                      <?php } ?>
                      <?php if (!empty($text_mobiel)) { ?>
                        <li title="<?php echo $text_mobiel;?>"><a href="tel:<?php echo $text_mobiel_formatted;?>" target="_blank"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></a></li>
                      <?php } ?>                      
                      <?php if (!empty($text_email)) { ?>
                        <li title="<?php echo $text_email;?>"><a href="mailto:<?php echo $text_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg></a></li>
                      <?php } ?>                      
                    </ul><!-- /.card-list-team-icons -->
                  </div><!-- /.card-body -->
                </div><!-- /.card -->
              </div><!-- /.col -->
            <?php endforeach;?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>          
        </div><!-- /.row -->
      </div><!-- /.container -->
    </main><!-- /main-->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php
get_footer();
