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
$text_telefoon_formatted = str_replace(array(' ', '(', ')'), "", $text_telefoon);
$text_mobiel = get_post_meta(get_the_ID(), _CMB . 'text_mobiel', true);
$text_mobiel_formatted = str_replace(array(' ', '(', ')'), "", $text_mobiel);
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
        <div class="row single-mensen-above-line">
          <div class="col-lg-6 col-xxl-7">
          <header class="entry-header">
              <?php the_post(); ?>
              <!-- TITLE -->
              <?php the_title('<h1>', '</h1>'); ?>
              <p class="d-none"><a href="<?php echo $expertise_url;?>"><?php echo $expertise_name;?></a></p>
              <!-- ..entry-header -->
            </header>
            <!-- CONTENT -->
            <?php the_content(); ?>          
          </div>
          <div class="col-lg-6 col-xxl-5">
            <div class="featured-image-mensen-wrapper">
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
            </div><!-- /.featured-image-mensen-wrapper -->
          </div><!-- /.col -->          
        </div><!-- /.row .single-mensen-above-line -->
        <div class="row single-mensen-below-line">
          <div class="col-lg-6 col-xxl-7">
            <?php $extra_content = get_post_meta(get_the_ID(), _CMB . 'extra_content', true);?>
            <?php if(!empty($extra_content)){?>
            <!-- CONTENT PAGE EXTRA CONTENT ONDER STIPPELLIJN -->
            <div class="contact-page-extra">
              <?php echo wpautop($extra_content);?>
            </div><!-- /.contact-page-extra-->            
            <?php } ?>
            <ul class="corp-contact-icons">
            <?php if (!empty($text_email)) { ?><li title="<?php echo $text_email;?>"><a href="mailto:<?php echo $text_email;?>" target="_blank"><svg class="icon icon-email"><use xlink:href="#icon-email"></use></svg></a> <?php echo $text_email;?></li><?php } ?>
            <?php if (!empty($text_telefoon)) { ?><li title="<?php echo $text_telefoon;?>"><a href="tel:<?php echo $text_telefoon_formatted;?>" target="_blank"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg></a> <?php echo $text_telefoon;?></li><?php } ?>
            <?php if (!empty($text_mobiel)) { ?><li title="<?php echo $text_mobiel;?>"><a href="tel:<?php echo $text_mobiel_formatted;?>" target="_blank"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></a> <?php echo $text_mobiel;?></li><?php } ?>
          </ul>               
          </div><!-- /.col -->
        </div><!-- ./row -->
      </div><!-- /.container.entry-content -->
      <div class="corp-gray-bleed-bg bleed-left">
        <div class="container">
          <ul class="corp-contact-icons">
            <?php if (!empty($text_url_linkedin)) { ?><li><a href="<?php echo $text_url_linkedin;?>" target="_blank"><svg class="icon icon-linkedin"><use xlink:href="#icon-linkedin"></use></svg></a> <?php echo esc_html_e('Linkedin', 'corp' ); ?></li><?php } ?>
            <?php if (!empty($file_vcard)) { ?><li><a href="<?php echo $file_vcard;?>"><svg class="icon icon-vcard"><use xlink:href="#icon-vcard"></use></svg></a> <?php echo esc_html_e('Download vCard', 'corp' ); ?></li><?php } ?>            
          </ul>
        </div><!-- /.container -->
      </div><!-- /.corp-gray-bleed-bg --> 
    </main><!-- /main -->
  </div><!-- /.primary -->
</div><!-- #content -->
<?php get_footer();
