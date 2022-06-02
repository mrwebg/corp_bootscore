<?php
/**
* Template Name: Vacatures pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp
*/
get_header();?>
<!-- cpt vacature
-->
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
            <?php if (is_array($post_array) && count($post_array) > 0): ?>
              <div class="row row-cols-1 row-cols-md-4 g-4">
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
