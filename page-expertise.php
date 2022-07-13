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
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <!-- /.entry-header -->
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
                <h2>Team <?php echo $expertise_name;?></h2>
                <?php
                foreach ($post_array as $post):
                  setup_postdata($post);
                  $title = ucfirst(get_the_title());
                  $url = get_the_permalink(get_the_ID());
                  $text_email = get_post_meta(get_the_ID(), _CMB . 'text_email', true);
                  $text_telefoon = get_post_meta(get_the_ID(), _CMB . 'text_telefoon', true);
                  $text_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $text_telefoon);              
                  $text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
                  $text_mobiel_formatted = str_replace(array(' ', '(', ')'), "", $text_mobiel);
                  ?>
                  <h3 class="h4 team-title"><a href="<?php echo $url;?>"><?php echo $title; ?></a></h3><!-- /.h4.team-title -->                      
                      <ul class="corp-contact-icons corp-contact-icons-row">
                        <?php if (!empty($text_telefoon)) { ?>
                          <li title="<?php echo $text_telefoon;?>"><a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a></li>
                        <?php } ?>
                        <?php if (!empty($text_mobiel)) { ?>
                          <li title="<?php echo $text_mobiel;?>"><a href="tel:<?php echo $text_mobiel_formatted;?>" target="_blank"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></a></li>
                        <?php } ?>                      
                        <?php if (!empty($text_email)) { ?>
                          <li title="<?php echo $text_email;?>"><a href="mailto:<?php echo $text_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg></a></li>
                        <?php } ?>                      
                      </ul><!-- /.corp-contact-icons.corp-contact-icons-row -->
                <?php endforeach;?>
                <?php wp_reset_postdata(); ?>
              </div><!-- /.wrapper-expertise-team -->  
            <?php endif; ?>
            <!-- /TEAM. -->
            <!-- LEFT COLUMN EXTRA CONTENT. -->          
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'left_column', true))) { ?>              
              <div class="wrapper-expertise-linker-kolom-extra">
                <?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'left_column', true));?>           
              </div><!-- /.wrapper-expertise-linker-kolom-extra -->              
            <?php } ?>
            <!-- /LEFT COLUMN EXTRA CONTENT. -->             
          </div><!-- /.col- -->
          <div class="col-6 parallax-col" data-scroll-speed="1">
            <!-- RIGHT COLUMN EXTRA CONTENT. -->
            <?php if (!empty(get_post_meta(get_the_ID(), _CMB . 'right_column', true))) { ?>
              <div class="wrapper-expertise-rechter-kolom-extra">                           
                <?php echo wpautop(get_post_meta(get_the_ID(), _CMB . 'right_column', true));?>
              </div><!-- /.wrapper-expertise-rechter-kolom-extra -->   
            <?php } ?>
            <!-- /RIGHT COLUMN EXTRA CONTENT. -->                        
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container -->
      <?php get_template_part('includes/footer', 'quote', array('postID' => get_the_ID())); ?>           
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- /.content -->
<?php get_footer();
