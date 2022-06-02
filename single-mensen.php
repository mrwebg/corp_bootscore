<?php
/**
* single-mensen.php
* @package WordPress
* @subpackage corp
*/
?>
<?php get_header();
// Get page varibles.
$title = ucfirst(get_the_title());
$url = get_the_permalink();
$text_email = get_post_meta(get_the_ID(), _CMB . 'text_email', true);
$text_telefoon = get_post_meta(get_the_ID(), _CMB . 'text_telefoon', true);
$text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
$file_vcard = get_post_meta(get_the_ID(), _CMB . 'file_vcard', true);
$text_url_linkedin = get_post_meta(get_the_ID(), _CMB . 'text_url_linkedin', true);
$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "thumbnail")[0];
$portrait = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "team-portrait")[0];
$expertise = get_the_terms(get_the_ID(), "expertise");
$expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : "";
// JSON-LD.
?>
<script type="application/ld+json">{
  "@context": "http://www.schema.org",
  "@type": "person"
  <?php if (!empty($title)) { ?>,"name":"<?php echo $title;?>"<?php } ?>
  <?php if (!empty($url)) { ?>,"url":"<?php echo $url;?>"<?php } ?>
  <?php if (!empty($text_url_linkedin)) { ?>,"sameAs":["<?php echo $text_url_linkedin;?>"]<?php } ?>
  <?php if (!empty($portrait)) { ?>,"image":"<?php echo $portrait;?>"<?php } ?>
  <?php if (!empty($text_email)) { ?>,"email":"<?php echo $text_email;?>"<?php } ?>
  <?php if (!empty($text_mobiel)) { ?>,"telephone":"<?php $find = [" ", "(0)"];$replace = ["", ""]; echo str_replace($find, $replace, $text_mobiel);?>"<?php } ?>
}
</script>
<!-- start body layout and content -->
<div id="content" class="site-content container py-5 mt-5">
  <div id="primary" class="content-area">
    <div class="row">
      <div class="col-md-8 col-xxl-9">
        <main id="main" class="site-main">
          <?php if (have_posts()):?>
            <?php while (have_posts()) :?>
              <?php the_post(); ?>
              <header class="entry-header">
                <h1>title: <?php echo $title;?></h1>
              </header><!-- .entry-header -->
              <div class="entry-content">
                <?php the_content(); ?>
                <ul>
                  <?php if (!empty($text_email)) { ?><li>text_email: <?php echo $text_email;?></li><?php } ?>
                    <?php if (!empty($text_telefoon)) { ?><li>text_telefoon: <?php echo $text_telefoon;?></li><?php } ?>
                      <?php if (!empty($text_mobiel)) { ?><li>text_mobiel: <?php echo $text_mobiel;?></li><?php } ?>
                        <?php if (!empty($file_vcard)) { ?><li>file_vcard: <?php echo $file_vcard;?></li><?php } ?>
                          <?php if (!empty($text_url_linkedin)) { ?><li>text_url_linkedin: <?php echo $text_url_linkedin;?></li><?php } ?>
                            <?php if (!empty($thumbnail)) { ?><li>thumbnail: <?php echo $thumbnail;?></li><?php } ?>
                              <?php if (!empty($portrait)) { ?><li>portrait: <?php echo $portrait;?></li><?php } ?>
                              <?php if (!empty($expertise_name))  { ?><li>expertise: <?php echo $expertise_name;?></li><?php } ?>
                              </ul>
                            <?php endwhile;?>
                          <?php endif; ?>
                        </div><!-- .entry-content -->
                      </main><!-- #main -->
                    </div><!-- col -->
                  </div><!-- row -->
                </div><!-- #primary -->
              </div><!-- #content -->
              <?php get_footer();
