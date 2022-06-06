<?php
/**
 * Template Name: Homepage
 * front-page.php
 * @package WordPress
 * @subpackage grasland
 */
?>
<?php get_header();?>


<!--div class="container-fluid mt-5 site-content">
  <div class="row">
    <div class="col bg-secondary"></div>
    <div class="col col-container col-12 bg-info">
      <div class="row">
        <div class="col-2">logo</div>
        <div class="col-6 text-center">
          menu
        </div>
        <div class="col-2"><div style="position:absolute;right:calc(var(--bs-gutter-x) * .5);">EN/NL</div></div>
      </div>
    </div>
    <div class="col bg-secondary text-end"></div>
  </div>
</div-->


<div id="content" class="site-content container-md py-5 mt-5">
  <div id="primary" class="content-area">
    <div class="row">
      <div class="col">
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
            <?php
            // FEATURED
            $featured_post_type_selected = get_post_meta(get_the_ID(),  _CMB .'featured_select', true);//  '', post, deals
            if('' !== $featured_post_type_selected){
              $featured_post_id = get_post_meta(get_the_ID(), _CMB .'select_' . $featured_post_type, true);
              if('' !== $featured_post_id){
                $featured_post   = get_post( intval($featured_post_id) );
                setup_postdata($featured_post);
                $featured_title =  $featured_post->post_title;
                $featured_content =  apply_filters( 'the_content', $featured_post->post_content );
                print '<h4>Featured:</h4>';
                print '<h5>'.$featured_title. '</h5>';
                print '<div>'.$featured_content. '</div>';
                wp_reset_postdata();
              }
            }
            ?>
            <!-- .entry-content -->
          </div>
        </main><!-- #main -->
      </div><!-- col -->
    </div><!-- row -->
  </div><!-- #primary -->
</div><!-- #content -->
<!-- container tests -->





<div class="container-fluid mt-5 px-0">
  <div class="container-left-md" style="background-color:rgba(0,0,0,0.85);color:#fff;height:100px;border:dotted #fff 2px;">
    <div class="row">
      <div class="col">
        container left
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-5 px-0">
  <div class="container-left-md" style="height:100px;border-top:dotted #000 2px;">
<div style="padding:1rem;"><h2>Container left</h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
  </div>
</div>

<div class="container-fluid mt-5 px-0">
  <div class="container-right-md" style="background-color:rgba(0,0,0,0.25);color:#fff;height:100px;border:dotted #fff 2px;">
container right
  </div>
</div>

<div class="container-fluid mt-5 px-0">
  <div class="container-right-md" style="height:100px;border-top:dotted #000 2px;">
    <div class="row">
      <div class="col-md"><h2>Container right</h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
      <div class="col-md"><h2>Vestibulum ante ipsum </h2><p>Nullam a lacinia felis. Morbi vitae varius ligula, sed gravida ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis interdum congue dui, eu pretium eros ullamcorper vel. </p></div>
    </div>
  </div>
</div>
<?php
get_footer();
