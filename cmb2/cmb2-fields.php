<?php
add_action('cmb2_admin_init', 'mrweb_register_cmb2_metaboxes');
add_action('cmb2_init', 'mrweb_register_cmb2_metaboxes');
/**
* Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
*/
function mrweb_register_cmb2_metaboxes() {
  $prefix = '_cmb_';
  // Add optional quote module to page or mensen.
  $cmb_quotestr = new_cmb2_box(array(
    'id' => $prefix . 'quotestr',
    'title' => 'Quote [optioneel]',
    'object_types' => array('page', 'mensen'), // Post type
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => false, // Show field names on the left
    'cmb_styles' => true, // false to disable the CMB stylesheet
    'closed' => true,
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ));
  $cmb_quotestr->add_field(array(
    'name' => 'Quote',
    'id' => $prefix . 'select_quote',
    'type' => 'select',
    'show_option_none' => true,
    'options' => mrweb_return_posts('quotes'),
    'show_in_rest' => true,
  ));
  $cmb_homepage = new_cmb2_box(array(
    'id' => $prefix . 'featured',
    'title' => 'FEATURED [bericht of deal]',
    'object_types' => array('page'), // Post type
    'show_on_cb' => 'mrweb_show_on_front_page',
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true, // Show field names on the left
    'cmb_styles' => true, // false to disable the CMB stylesheet
    'closed' => true,
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ));
  // conditional select field (deals OR post).
  $cmb_homepage->add_field(array(
    'name' => 'Bericht of track record',
    'id' => $prefix . 'featured_select',
    'type' => 'radio',
    'show_option_none' => true,
    'default' => '',
    'options' => array(
      'post' => 'Bericht',
      'deals' => 'Track record'
    ),
  ));
  $cmb_homepage->add_field(array(
    'name' => 'Bericht',
    'id' => $prefix . 'select_post',
    'type' => 'select',
    'show_option_none' => true,
    'options' => mrweb_return_posts('post'),
    'attributes' => array(
      'data-conditional-id' => $prefix . 'featured_select',
      'data-conditional-value' => 'post',
    ),
  ));
  $cmb_homepage->add_field(array(
    'name' => 'Track record',
    'desc' => 'Kies een track record',
    'id' => $prefix . 'select_deals',
    'type' => 'select',
    'show_option_none' => true,
    'options' => mrweb_return_posts('deals'),
    'attributes' => array(
      'data-conditional-id' => $prefix . 'featured_select',
      'data-conditional-value' => 'deals',
    ),
  ));
  $cmb_homepage2 = new_cmb2_box(array(
    'id' => $prefix . 'positionering',
    'title' => 'POSITIONERING [teaser]',
    'object_types' => array('page'), // Post type
    'show_on_cb' => 'mrweb_show_on_front_page',
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true, // Show field names on the left
    'cmb_styles' => true, // false to disable the CMB stylesheet
    'closed' => true,
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ));
  $cmb_homepage2->add_field(array(
    'name' => 'titel',
    'id' => $prefix . 'positioning_title',
    'type' => 'text',
  ));
  $cmb_homepage2->add_field(array(
      'name' => 'content',
      'id' => $prefix . 'positioning_content',
      'type' => 'wysiwyg',
    ));
    $cmb_homepage3 = new_cmb2_box(array(
      'id' => $prefix . 'trackrecord',
      'title' => 'TRACKRECORD [teaser]',
      'object_types' => array('page'), // Post type
      'show_on_cb' => 'mrweb_show_on_front_page',
      'context' => 'normal',
      'priority' => 'high',
      'show_names' => true, // Show field names on the left
      'cmb_styles' => true, // false to disable the CMB stylesheet
      'closed' => true,
      'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
    ));
    $cmb_homepage3->add_field(array(
      'name' => 'titel',
      'id' => $prefix . 'trackrecord_title',
      'type' => 'text',
    ));
    $cmb_homepage3->add_field(array(
        'name' => 'content',
        'id' => $prefix . 'trackrecord_content',
        'type' => 'wysiwyg',
      ));
  // MENSEN.
  $cmb_mensen = new_cmb2_box(array(
    'id' => $prefix . 'mensen',
    'title' => 'NAW GEGEVENS',
    'object_types' => array('mensen'), // Post type
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true, // Show field names on the left
    'cmb_styles' => true, // false to disable the CMB stylesheet
    'closed' => true,
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ));
  $cmb_mensen->add_field(array(
    'name' => 'Voornaam',
    'id' => $prefix . 'text_voornaam',
    'type' => 'text',
    'show_in_rest' => true,
  ));
  $cmb_mensen->add_field(array(
    'name' => 'Tussenvoegsel',
    'id' => $prefix . 'text_tussenvoegsel',
    'type' => 'text',
    'show_in_rest' => true,
  ));
  $cmb_mensen->add_field(array(
    'name' => 'Achternaam',
    'id' => $prefix . 'text_achternaam',
    'type' => 'text',
  ));
  $cmb_mensen->add_field(array(
    'name' => 'E-mail',
    'id' => $prefix . 'text_email',
    'type' => 'text_email',
  ));
  $cmb_mensen->add_field(array(
    'name' => 'Telefoon',
    'id' => $prefix . 'text_telefoon',
    'type' => 'text',
  ));
  $cmb_mensen->add_field(array(
    'name' => 'Mobiel',
    'id' => $prefix . 'text_mobiel',
    'type' => 'text',
  ));
  $cmb_mensen->add_field(array(
    'name' => 'V-card',
    'id' => $prefix . 'file_vcard',
    'type' => 'file',
  ));
  $cmb_mensen->add_field(array(
    'name' => 'LinkedIn URL',
    'id' => $prefix . 'text_url_linkedin',
    'type' => 'text_url',
  ));
  // QUOTES.
  $cmb_quotes = new_cmb2_box(array(
    'id' => $prefix . 'quotes',
    'title' => '&nbsp;',
    'object_types' => array('quotes'),
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true,
    'cmb_styles' => true,
    'closed' => false,
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ));
  $cmb_quotes->add_field(array(
    'name' => 'Bron',
    'id' => $prefix . 'text_bron',
    'type' => 'text',
  ));
  $cmb_quotes->add_field(array(
    'name' => 'Bron URL',
    'id' => $prefix . 'url_bron',
    'type' => 'text_url',
  ));
  // PAGE EXPERTISE.
  $cmb_rc = new_cmb2_box( array(
    'id'           => 'right_column_content',
    'title'        => 'EXTRA CONTENT',
    'object_types' => array( 'page' ), // post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'page-expertise.php' ),
    'context'      => 'normal', //  'normal', 'advanced', or 'side'
    'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
    'show_names'   => true, // Show field names on the left
    'closed'       => false,
  ));
  $cmb_rc->add_field(array(
    'name' => 'linker kolom content',
    'id' => $prefix . 'left_column',
    'type' => 'wysiwyg',
    'default' => 'Optioneel: voeg extra content toe',
  ));
  $cmb_rc->add_field(array(
    'name' => 'rechter kolom content',
    'id' => $prefix . 'right_column',
    'type' => 'wysiwyg',
    'default' => 'Optioneel: voeg extra content toe',
  ));  
  // PAGE VACATURES. (overzicht)
  $cmb_pv = new_cmb2_box( array(
    'id'           => 'pv_extra_content',
    'title'        => 'EXTRA CONTENT',
    'object_types' => array( 'page' ), // post type
    'show_on'      => array( 'key' => 'page-template', 'value' => 'page-vacatures.php' ),
    'context'      => 'normal', //  'normal', 'advanced', or 'side'
    'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
    'show_names'   => true, // Show field names on the left
    'closed'       => false,
  ));
  $cmb_pv->add_field(array(
    'name' => 'rechter kolom content',
    'id' => $prefix . 'right_column',
    'type' => 'wysiwyg',
    'default' => 'Optioneel: voeg extra content toe',
  )); 
  $cmb_pv->add_field(array(
    'name' => 'contact_persoon',
    'id' => $prefix . 'vacature_contact',
    'type' => 'select',
    'show_option_none' => true,
    'options' => mrweb_return_posts('mensen'),
    'show_in_rest' => true,
  ));         
  // PAGE VACATURE. (cpt vacature)
  $cmb_sv = new_cmb2_box( array(
    'id'           => 'sv_extra_content',
    'title'        => 'EXTRA CONTENT',
    'object_types' => array( 'vacature' ), // post type
    'context'      => 'normal', //  'normal', 'advanced', or 'side'
    'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
    'show_names'   => true, // Show field names on the left
    'closed'       => false,
  ));
  $cmb_sv->add_field(array(
    'name' => 'formulier intro titel',
    'id' => $prefix . 'cf7_intro_title',
    'type' => 'text',
    'default' => 'Interesse? Neem contact met ons op.',
  ));
  $cmb_sv->add_field(array(
    'name' => 'formulier intro text',
    'id' => $prefix . 'cf7_intro_body',
    'type' => 'text',
    'default' => 'Stuur door middel van onderstaand formulier je gegevens dan nemen wij spoedig contact met je op.',
  ));
  $cmb_sv->add_field(array(
    'name' => 'formulier contact persoon titel',
    'id' => $prefix . 'cf7_contactpersoon_titel',
    'type' => 'text',
    'default' => 'Of neem direct contact op met:',
  ));     
  $cmb_sv->add_field(array(
    'name' => 'contact_persoon',
    'id' => $prefix . 'vacature_contact',
    'type' => 'select',
    'show_option_none' => true,
    'options' => mrweb_return_posts('mensen'),
    'default' => '179',
    'show_in_rest' => true,
  ));          
}
/* ADD CORP THEME OPTIONS PAGE */
add_action( 'cmb2_admin_init', 'mrweb_register_theme_options_metabox' );
function mrweb_register_theme_options_metabox() {
  $cmb_options = new_cmb2_box( array(
    'id'           => 'corp-options',
    'title'        => esc_html__( 'Bedrijfsgegevens', 'cmb2' ),
    'object_types' => array( 'options-page' ),
    'option_key'      => 'bedrijfsgegevens', // The option key and admin menu page slug.
    'parent_slug'     => 'options-general.php', // Make options page a submenu item of the themes menu.
    'show_in_rest' => WP_REST_Server::READABLE, // or WP_REST_Server::ALLMETHODS/WP_REST_Server::EDITABLE,
  ) );
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Bedrijfsnaam', 'cmb2' ),
    'id'      => 'adres_naam',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Straat', 'cmb2' ),
    'id'      => 'adres_straat',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Huisnummer', 'cmb2' ),
    'id'      => 'adres_huisnummer',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Postcode', 'cmb2' ),
    'id'      => 'adres_postcode',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Woonplaats', 'cmb2' ),
    'id'      => 'adres_woonplaats',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Telefoon', 'cmb2' ),
    'id'      => 'adres_telefoon',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Fax', 'cmb2' ),
    'id'      => 'adres_fax',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Email', 'cmb2' ),
    'id'      => 'adres_email',
    'type'    => 'text_email',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Financieel', 'cmb2' ),
    'id'      => 'finance_title',
    'type'    => 'title',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Kvk', 'cmb2' ),
    'id'      => 'finance_kvk',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Btw', 'cmb2' ),
    'id'      => 'finance_btw',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Iban', 'cmb2' ),
    'id'      => 'finance_iban',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Bic', 'cmb2' ),
    'id'      => 'finance_bic',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Social Media', 'cmb2' ),
    'id'      => 'social_title',
    'type'    => 'title',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'LinkedIn', 'cmb2' ),
    'id'      => 'social_linkedin',
    'type'    => 'text_url',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Maps', 'cmb2' ),
    'id'      => 'maps_title',
    'type'    => 'title',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Link', 'cmb2' ),
    'id'      => 'maps_url',
    'type'    => 'text_url',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'Google', 'cmb2' ),
    'id'      => 'google_title',
    'type'    => 'title',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'uacode', 'cmb2' ),
    'id'      => 'google_uacode',
    'type'    => 'text',
  ));
  $cmb_options->add_field( array(
    'name'    => esc_html__( 'search console', 'cmb2' ),
    'id'      => 'google_searchconsole',
    'type'    => 'text',
  ));
}
