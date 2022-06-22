<?php
/**
 * Template Name: CONTACT
 * page-contact.php
 * @package WordPress
 * @subpackage grasland
 */
get_header();
?>
<?php
if (have_posts())
    while (have_posts()) : the_post();
        ?>
        <main>
            <div class="wrap">
                <div class="grid-container pad-bottom-double">
                    <div class="prefix-10 grid-80 suffix-10 tablet-grid-100 mobile-grid-100 pad-top-double pad-bottom">
                        <h1 class="h1"><span style="border-bottom:dotted 1px #525252;"><?php print ucfirst(get_the_title()); ?><span class="fcr">.</span></span></h1>
                    </div>
                    <div class="prefix-10 grid-20 tablet-grid-50 mobile-grid-100 pad-top-double a-400">
                        <?php the_content(); ?>
                    </div>
                    <div class="grid-60 suffix-10 tablet-grid-100 mobile-grid-100 pad-top-double">
                        <?php
                        if (function_exists('ret_gtwc_key_value') && !empty(ret_gtwc_key_value("1_iframe_source")) && !empty(ret_gtwc_key_value("1_big_map_source")) && function_exists('gtwc_return_osm_embed') && !empty(gtwc_return_osm_embed(ret_gtwc_key_value("1_iframe_source"))) && function_exists('gtwc_return_osm_map_link') && !empty(gtwc_return_osm_map_link(ret_gtwc_key_value("1_big_map_source")))) {
                            print gtwc_return_osm_embed(ret_gtwc_key_value("1_iframe_source"));
                            print gtwc_return_osm_map_link(ret_gtwc_key_value("1_big_map_source"));
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php get_template_part('library/partials/page', 'divider-quote'); ?>     
        </main>
    <?php endwhile; ?>
<?php
get_footer();
