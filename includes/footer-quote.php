<!--QUOTE: template-part footer-quote -->
<?php
if( $args['postID'] ){
  $postID = $args['postID'];
  $selected_quote_id = get_post_meta($postID,  _CMB .'select_quote', true);
  if('' !== $selected_quote_id && $selected_quote_id > 0 ){
  $selected_quote   = get_post( intval($selected_quote_id) );
  setup_postdata($selected_quote);
  $quote_bron = get_post_meta($selected_quote_id, _CMB . 'text_bron', true);
  $quote_url = get_post_meta($selected_quote_id, _CMB . 'url_bron', true);
  ?>
  <div class="corp-footer-quote-wrapper">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-lg-6">
          <figure style="margin:0;">
            <blockquote class="blockquote">
                <p><?php echo ucfirst($selected_quote->post_title); ?></p>
            </blockquote>
            <?php if('' !== $quote_bron) { ?>
              <figcaption class="blockquote-footer">
              <?php if('' !== $quote_url) { ?>
                <a href="<?php echo get_post_meta($selected_quote_id, _CMB . 'url_bron', true);?>" target="_blank"><cite title="<?php echo get_post_meta($selected_quote_id, _CMB .'text_bron', true); ?>"><?php echo strtoupper(get_post_meta($selected_quote_id, _CMB .'text_bron', true)); ?></cite></a>
              <?php } else {  ?>
                <cite title="<?php echo get_post_meta($selected_quote_id, _CMB .'text_bron', true); ?>"><?php echo strtoupper(get_post_meta($selected_quote_id, _CMB .'text_bron', true)); ?></cite>
              <?php } ?>
              </figcaption>
            <?php } ?>
          </figure>
        </div>
      </div>
    </div>
  </div>
  <?php wp_reset_postdata(); } ?>
  <!-- #QUOTE. -->  
<?php }
