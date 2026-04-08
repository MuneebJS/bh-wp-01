<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function techbiz_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'techbiz_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function techbiz_register_metabox() {

	$prefix = '_techbiz_';

	$prefixpage = '_techbizpage_';

	$techbiz_service_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'service_page_control',
		'title'         => esc_html__( 'Service Page Controller', 'techbiz' ),
		'object_types'  => array( 'techbiz_service' ), // Post type
		'closed'        => true
	) );
	$techbiz_service_meta->add_field( array(
		'name' => esc_html__( 'Write Flaticon Class', 'techbiz' ),
	   	'desc' => esc_html__( 'Write Flaticon Class For The Icon', 'techbiz' ),
	   	'id'   => $prefix . 'flat_icon_class',
		'type' => 'text',
    ) );

	$techbiz_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'techbiz' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );
	$techbiz_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Video', 'techbiz' ),
		'desc' => esc_html__( 'Use This Field When Post Format Video', 'techbiz' ),
		'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );
	$techbiz_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'techbiz' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'techbiz' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$techbiz_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'techbiz' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'techbiz' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );

	$techbiz_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'techbiz' ),
		'object_types'  => array( 'page' ), // Post type
        'closed'        => true
    ) );

    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'techbiz' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'techbiz' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','techbiz'),
            '2'     => esc_html__('Hide','techbiz'),
        )
    ) );


    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'techbiz' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__( 'Global Settings', 'techbiz' ),
            'page'     => esc_html__( 'Page Settings', 'techbiz' ),
        )
	) );

	$techbiz_page_meta->add_field( array(
	    'name'    => esc_html__( 'Breadcumb Image', 'techbiz' ),
	    'desc'    => esc_html__( 'Upload an image or enter an URL.', 'techbiz' ),
	    'id'      => $prefix . 'breadcumb_image',
	    'type'    => 'file',
	    // Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	    'text'    => array(
	        'add_upload_file_text' => __( 'Add File', 'techbiz' ) // Change upload button text. Default: "Add or Upload File"
	    ),
	    'preview_size' => 'large', // Image size to use when previewing in the admin.
	) );

    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'techbiz' ),
		'desc' => esc_html__( 'check to display Page Title.', 'techbiz' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   	=> esc_html__( 'Show','techbiz'),
            '2'     => esc_html__( 'Hide','techbiz'),
        )
	) );

    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'techbiz' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','techbiz'),
            'custom'  => esc_html__('Custom Title','techbiz'),
        ),
        'default'   => 'default'
    ) );

    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'techbiz' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $techbiz_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'techbiz' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'techbiz' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => techbiz_set_checkbox_default_for_new_post( true ),
    ) );

    $techbiz_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'techbiz' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page' ), // Post type
        'closed'        => true
	) );

	$techbiz_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'techbiz' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'techbiz' ),
            '2' => esc_html__( 'Container Fluid', 'techbiz' ),
            '3' => esc_html__( 'Fullwidth', 'techbiz' ),
        ),
	) );

	$techbiz_product_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'product_meta_section',
		'title'         => esc_html__( 'Swap Image', 'techbiz' ),
		'object_types'  => array( 'product' ), // Post type
		'closed'        => true,
		'context'		=> 'side',
		'priority'		=> 'default'
	) );

	$techbiz_product_meta->add_field( array(
		'name' 		=> esc_html__( 'Product Swap Image', 'techbiz' ),
		'desc' 		=> esc_html__( 'Set Product Swap Image', 'techbiz' ),
		'id'   		=> $prefix.'product_swap_image',
		'type'    	=> 'file',
		// Optional:
		'options' 	=> array(
			'url' 		=> false, // Hide the text input for the url
		),
		'text'    	=> array(
			'add_upload_file_text' => __( 'Add Swap Image', 'techbiz' ) // Change upload button text. Default: "Add or Upload File"
		),
	) );
}

add_action( 'cmb2_admin_init', 'techbiz_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function techbiz_register_taxonomy_metabox() {

    $prefix = '_techbiz_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$techbiz_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'techbiz' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$techbiz_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'techbiz' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	$techbiz_term_meta->add_field( array(
		'name' => esc_html__( 'Category Image', 'techbiz' ),
		'desc' => esc_html__( 'Set Category Image', 'techbiz' ),
		'id'   => $prefix.'term_avatar',
        'type' => 'file',
        'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','techbiz') // Change upload button text. Default: "Add or Upload File"
		),
	) );
}