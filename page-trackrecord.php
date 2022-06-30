<?php
/**
* Template Name: Trackrecord pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<!-- TRACK RECORDS (cpt deals) -->
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
<div id="content" class="site-content container py-5 mt-5">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <header class="entry-header">
        <?php the_post(); ?>
        <?php the_title('<h1>', '</h1>'); ?>
      </header>
      <div class="entry-content">
        <!-- Content -->
        <?php the_content(); ?>
        <?php if (is_array($post_array) && count($post_array) > 0): ?>
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            foreach ($post_array as $post):
              $expertise = get_the_terms(get_the_ID(), "expertise");
              $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : "";
              $expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0;
              setup_postdata($post); ?>
              <div class="col">
                <div class="card h-100">
                  <div class="card-body">
                    <h2 class="h5 card-title"><?php the_title(); ?></h5>
                      <h3 class="h6 card-subtitle mb-2 text-muted">card category</h6>
                        <p class="card-text"><?php the_content(); ?></p>
                      </div>
                    </div><!-- .card -->
                  </div><!-- .col -->
                  <?php
                endforeach;
                wp_reset_postdata();
                ?>
              </div><!-- .row -->
            <?php endif;?>
          </div><!-- .entry-content -->
        </main><!-- #main -->
      </div><!-- #primary -->
    </div><!-- #content -->
    <?php
    get_footer();
