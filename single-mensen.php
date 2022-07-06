<?php
/**
* Template Name: Single Page Mensen
* Template Post Type: mensen
* @package WordPress
* @subpackage corp_bootscore
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
$portrait = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "team-portrait")[0];
$expertise = get_the_terms(get_the_ID(), "expertise");
$expertise_name = (is_array($expertise) && count($expertise)>0)? $expertise[0]->name : "";
$expertise_id = (is_array($expertise) && count($expertise)>0)? $expertise[0]->term_id : 0;              
$expertise_url = mrweb_expertise_page_url($expertise_id); 
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
<?php get_header();?>
<div id="content" class="site-content">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">    
        <div class="row">
          <div class="col">
          <header class="entry-header">
              <?php the_post(); ?>
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <small class="text-muted"><a href="<?php echo $expertise_url;?>"><?php echo $expertise_name;?></a></small>
              <!-- ..entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?> 
          </div>
          <div class="col">
            <?php if (!empty($portrait)) { ?>
              <figure class="featured-image-mensen">
                <picture>
                  <img src="<?php echo $portrait;?>" alt="<?php echo get_the_title();?>">
                </picture>
                <noscript>
                  <picture>
                    <img src="<?php echo $portrait;?>" alt="<?php echo get_the_title();?>">
                  </picture>
                </noscript>
              </figure><!-- /.featured-image-mensen-->
            <?php } ?>
          </div>          
        </div>
        <div class="row">
          <div class="col">
            <ul>
              <?php if (!empty($text_email)) { ?><li>text_email: <?php echo $text_email;?></li><?php } ?>
              <?php if (!empty($text_telefoon)) { ?><li>text_telefoon: <?php echo $text_telefoon;?></li><?php } ?>
              <?php if (!empty($text_mobiel)) { ?><li>text_mobiel: <?php echo $text_mobiel;?></li><?php } ?>
              <?php if (!empty($file_vcard)) { ?><li>file_vcard: <?php echo $file_vcard;?></li><?php } ?>
              <?php if (!empty($text_url_linkedin)) { ?><li>text_url_linkedin: <?php echo $text_url_linkedin;?></li><?php } ?>
            </ul>            
          </div>        
        </div>        
      </div><!-- /.container.entry-content -->
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- #content -->
<?php get_footer();
