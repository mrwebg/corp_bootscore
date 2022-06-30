<?php
/**
* Template Name: Team pagina
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
* @package corp_bootscore
*/
get_header();?>
<!-- TRACK RECORDS (cpt mensen) -->
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
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container">
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
              <?php foreach ($post_array as $post): ?>
                <?php
                setup_postdata($post);
                $url = get_the_permalink();
                $text_email = get_post_meta(get_the_ID(), _CMB . 'text_email', true);
                $text_telefoon = get_post_meta(get_the_ID(), _CMB . 'text_telefoon', true);
                $text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
                $file_vcard = get_post_meta(get_the_ID(), _CMB . 'file_vcard', true);
                $text_url_linkedin = get_post_meta(get_the_ID(), _CMB . 'text_url_linkedin', true);
                $file_portret = get_post_meta(get_the_ID(), _CMB . 'file_portret', true);
                $expertise = get_the_terms(get_the_ID(), "expertise");
                $expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : "";
                ?>
                <div class="col">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title"><a href="<?php echo $url;?>"><?php the_title(); ?></a></h5>
                      <?php if (!empty($expertise_name))  { ?>  <h6 class="card-subtitle mb-2 text-muted"><?php echo $expertise_name;?></h6><?php } ?>
                      <ul>
                        <?php if (!empty($text_email)) { ?><li>text_email: <?php echo $text_email;?></li><?php } ?>
                        <?php if (!empty($text_telefoon)) { ?><li>text_telefoon: <?php echo $text_telefoon;?></li><?php } ?>
                        <?php if (!empty($text_mobiel)) { ?><li>text_mobiel: <?php echo $text_mobiel;?></li><?php } ?>
                        <?php if (!empty($file_vcard)) { ?><li>file_vcard: <?php echo $file_vcard;?></li><?php } ?>
                      </ul>
                    </div>
                  </div><!-- .card -->
                </div><!-- .col -->
              <?php endforeach;?>
              <?php wp_reset_postdata(); ?>
            <?php endif; ?>
          </div><!-- /.row -->          
        </div><!-- .entry-content -->
      </div>
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
