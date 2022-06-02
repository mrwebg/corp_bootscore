<?php
/**
* Template Name: Expertise pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp
*/
get_header();?>
<!-- EXPERTISE pagina's (cpt page) -->
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
// if (!is_admin()) {
//   if (function_exists('pll_is_translated_post_type') && false !== pll_is_translated_post_type($post_type)) {
//     $current_post_id = (isset($_GET['post'])) ? $_GET['post'] : '';
//     if (!empty($current_post_id) && function_exists('pll_get_post_language')) {
//       $current_post_language = pll_get_post_language($current_post_id);
//       if (false !== $current_post_language) {
//         $post_args['lang'] = $current_post_language;
//       }
//     }
//   }
// }
$post_array = get_posts($post_args);
?>
<div id="content" class="site-content container py-5 mt-5">
  <div id="primary" class="content-area">
    <div class="row">
      <div class="">
        <main id="main" class="site-main">
          <header class="entry-header">
            <?php the_post(); ?>
            <!-- Title -->
            <?php the_title('<h1>', '</h1>'); ?>
            <!-- .entry-header -->
          </header>
          <div class="entry-content">
            <!-- Content -->
            <?php the_content(); ?>
            <div class="row">
              <?php if (is_array($post_array) && count($post_array) > 0): ?>
                <div class="col">
                  <h2>Team <?php echo ucfirst($expertise_name);?></h2>
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
                          </div><!-- .col -->
                        <?php endif; ?>
                        <!-- .entry-content -->
                      </div><!-- .row -->
                    </main><!-- #main -->
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- #primary -->
            </div><!-- #content -->
            <?php
            get_footer();