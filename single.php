<?php
/*
	 * Template Post Type: post
	 */

get_header();  ?>

<div id="content" class="site-content SINGLEMRWEB">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <div class="container entry-content">  
      <div class="row">
          <div class="col-6">
            <header class="entry-header">
              <?php the_post(); ?>
              <h1><?php echo get_the_title(); ?></h1>
            </header>
            <!-- thumbnail -->
            <?php bootscore_post_thumbnail(); ?>
          </div><!-- /.col -->  
          <div class="col-6">
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
            <!-- RIGHT COLUMN CONTACT PERSON INTRO. -->
            <h2 class="h5 cf7_contactpersoon_titel corp-heading-border-bottom border-offset-right"><?php echo esc_html_e('Neem direct contact op met:', 'corp' ); ?></h2><!-- /.cf7_contactpersoon_titel -->                                             
            <?php
            $mensenID = intval(get_post_meta(get_the_ID(), _CMB . 'bericht_contact', true));
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
              <div class="wrapper-bericht-rechter-kolom-contactpersoon">                 
                <h3 class="h4 contactpersoon-title"><a href="<?php echo $permalink;?>"><?php echo $post_title; ?></a></h3><!-- /.h4.team-title -->
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
              </div><!-- /.wrapper-bericht-rechter-kolom-contactpersoon -->                                
            <?php } ?>     
          </div><!-- /.col -->            
        </div><!-- /.row -->
        
        <div class="row">
          <div class="col">        
          <footer class="entry-footer clear-both">
              <div class="mb-4">
                <?php bootscore_tags(); ?>
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <?php previous_post_link('%link'); ?>
                  </li>
                  <li class="page-item">
                    <?php next_post_link('%link'); ?>
                  </li>
                </ul>
              </nav>
            </footer>
          </div><!-- /.col -->            
        </div><!-- /.row -->

      </div> <!-- /.container -->           
    </main><!-- /#main -->
  </div><!-- /#primary -->
</div><!-- /#content -->
<?php get_footer();