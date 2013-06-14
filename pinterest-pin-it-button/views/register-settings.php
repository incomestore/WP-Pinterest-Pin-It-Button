<?php
	/**
	* Register Settings
	*
	* @package PIB     
	* @subpackage
	* @copyright   Copyright (c) 2013, 
	* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	* @since       1.0
    */

    // Exit if accessed directly
    if ( !defined( 'ABSPATH' ) ) exit;

function pib_register_settings() {
	$pib_settings = array(
	    /* General Settings */
	    'general' => array(
		   'button_style' => array(
			  'id' => 'button_style',
			  'name' => __('Button behavior', 'pib'),
			  'desc' => '',
			  'type' => 'radio',
			  'std' => 'no',
			  'options' => array(
				 'user_selects_image' => __('User selects image from popup', 'pib'),
				 'image_selected' => __('Image is pre-selected (defaults to first image in post)', 'pib')
			  )
		   ),
		   'count_layout' => array(
			  'id' => 'count_layout',
			  'name' => __('Pin count', 'pib'),
			  'desc' => '',
			  'type' => 'select',
			  'options' => array(
				 'none' => __('No Count', 'pib'),
				 'horizontal' => __('Horizontal', 'pib'),
				 'vertical' => __('Vertical', 'pib')
			  )
		   )
	    ),
	    /* Post Visibility Settings */
	    'post_visibility' => array(
		   'post_page_types' => array(
			  'id' => 'post_page_types',
			  'name' => __('Post/Page Types', 'pib'),
			  'desc' => '',
			  'type' => 'multicheck',
			  'options' => array(
				 'display_home_page' => __('Blog Home Page (or Latest Posts Page)', 'pib'),
				 'display_front_page' => __('Front Page (different from Home Page only if set in Settings > Reading)', 'pib'),
				 'display_posts' => __('Indivdual Posts', 'pib'),
				 'display_pages' => __('WordPress static "Pages"', 'pib'),
				 'display_archives' => __('Archives (includes Category, Tag, Author, and date-based pages', 'pib')
			  )
		   ),
		   'post_page_placement' => array(
			  'id' => 'post_page_placement',
			  'name' => __('Post/Page Placement', 'pib'),
			  'desc' => '',
			  'type' => 'multicheck',
			  'options' => array(
				 'display_above_content' => __('Above Content', 'pib'),
				 'display_below_content' => __('Below Content', 'pib'),
				 'display_on_post_excerpts' => __('On Post Excerpts', 'pib')
			  )
		   )
	    ),
	    /* Styles Settings */
	    'styles' => array(
		   'custom_css' => array(
			  'id' => 'custom_css',
			  'name' => __('Custom CSS', 'pib'),
			  'desc' => '',
			  'type' => 'textarea'
		   ),
		   'remove_div' => array(
			  'id' => 'remove_div',
			  'name' => __('Remove div container', 'pib'),
			  'desc' => __('Remove div tag surrounding regular button ( &#060;div class="pin-it-btn-wrapper"&#62;&#60;/div&#62; ). Already removed if other social sharing buttons enabled.', 'pib'),
			  'type' => 'checkbox'
		   )
	    )
	);
	
	/* If the options do not exist then create them for each section */
	if ( false == get_option( 'pib_settings_general' ) ) {
		add_option( 'pib_settings_general' );
	}
	
	if ( false == get_option('pib_settings_post_visibility') ) {
		add_option( 'pib_settings_post_visibility' );
	}
	
	if ( false == get_option('pib_settings_styles') ) {
		add_option( 'pib_settings_styles' );
	}
	
	/* Add the General Settings section */
	add_settings_section(
		'pib_settings_general',
		__( 'General Settings', 'pib' ),
		'__return_false',
		'pib_settings_general'
	);
	
	foreach ( $pib_settings['general'] as $option ) {
		add_settings_field(
			'pib_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'pib_' . $option['type'] . '_callback' ) ? 'pib_' . $option['type'] . '_callback' : 'pib_missing_callback',
			'pib_settings_general',
			'pib_settings_general',
			array(
				'id' => $option['id'],
				'desc' => $option['desc'],
				'name' => $option['name'],
				'section' => 'general',
				'size' => isset( $option['size'] ) ? $option['size'] : null,
				'options' => isset( $option['options'] ) ? $option['options'] : '',
				'std' => isset( $option['std'] ) ? $option['std'] : ''
			)
		);
	}
	
	/* Add the Post Visibility Settings section */
	add_settings_section(
		'pib_settings_post_visibility',
		__( 'Post Visibility Settings', 'pib' ),
		'__return_false',
		'pib_settings_post_visibility'
	);
	
	foreach ( $pib_settings['post_visibility'] as $option ) {
		add_settings_field(
			'pib_settings_post_visibility[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'pib_' . $option['type'] . '_callback' ) ? 'pib_' . $option['type'] . '_callback' : 'pib_missing_callback',
			'pib_settings_post_visibility',
			'pib_settings_post_visibility',
			array(
				'id' => $option['id'],
				'desc' => $option['desc'],
				'name' => $option['name'],
				'section' => 'post_visibility',
				'size' => isset( $option['size'] ) ? $option['size'] : null,
				'options' => isset( $option['options'] ) ? $option['options'] : '',
				'std' => isset( $option['std'] ) ? $option['std'] : ''
			)
		);
	}
	
	/* Add the Styles Settings section */
	add_settings_section(
		'pib_settings_styles',
		__( 'Styles', 'pib' ),
		'__return_false',
		'pib_settings_styles'
	);
	
	foreach ( $pib_settings['styles'] as $option ) {
		add_settings_field(
			'pib_settings_styles[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'pib_' . $option['type'] . '_callback' ) ? 'pib_' . $option['type'] . '_callback' : 'pib_missing_callback',
			'pib_settings_styles',
			'pib_settings_styles',
			array(
				'id' => $option['id'],
				'desc' => $option['desc'],
				'name' => $option['name'],
				'section' => 'styles',
				'size' => isset( $option['size'] ) ? $option['size'] : null,
				'options' => isset( $option['options'] ) ? $option['options'] : '',
				'std' => isset( $option['std'] ) ? $option['std'] : ''
			)
		);
	}
	
	/* Register all settings or we will get an error when trying to save */
	register_setting( 'pib_settings_general',		'pib_settings_general',			'pib_settings_sanitize' );
	register_setting( 'pib_settings_post_visibility', 'pib_settings_post_visibility',    'pib_settings_sanitize' );
	register_setting( 'pib_settings_styles',		'pib_settings_styles',			'pib_settings_sanitize' );
	
}
add_action('admin_init', 'pib_register_settings');

/*
 * Radio button callback function
 */

function pib_radio_callback( $args ) {
	global $pib_options;

	foreach ( $args['options'] as $key => $option ) {
		$checked = false;

		if ( isset( $pib_options[ $args['id'] ] ) && $pib_options[ $args['id'] ] == $key )
			$checked = true;
		elseif( isset( $args['std'] ) && $args['std'] == $key && ! isset( $pib_options[ $args['id'] ] ) )
			$checked = true;

		echo '<input name="pib_settings_' . $args['section'] . '[' . $args['id'] . ']"" id="pib_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked(true, $checked, false) . '/>&nbsp;';
		echo '<label for="pib_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	}

	echo '<p class="description">' . $args['desc'] . '</p>';
}
/*
 * Single checkbox callback function
 */

function pib_checkbox_callback( $args ) {
	global $pib_options;

	$checked = isset($pib_options[$args['id']]) ? checked(1, $pib_options[$args['id']], false) : '';
	$html = '<input type="checkbox" id="pib_settings_' . $args['section'] . '[' . $args['id'] . ']" name="pib_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>';
	$html .= '<label for="pib_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/*
 * Multiple checkboxes callback function
 */

function pib_multicheck_callback( $args ) {
	global $pib_options;

	foreach( $args['options'] as $key => $option ):
		if( isset( $pib_options[$args['id']][$key] ) ) { $enabled = $option; } else { $enabled = NULL; }
		echo '<input name="pib_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']"" id="pib_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked($option, $enabled, false) . '/>&nbsp;';
		echo '<label for="pib_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	endforeach;
	echo '<p class="description">' . $args['desc'] . '</p>';
}

/*
 * Select box callback function
 */

function pib_select_callback($args) {
	global $pib_options;

	$html = '<select id="pib_settings_' . $args['section'] . '[' . $args['id'] . ']" name="pib_settings_' . $args['section'] . '[' . $args['id'] . ']"/>';

	foreach ( $args['options'] as $option => $name ) :
		$selected = isset( $pib_options[ $args['id'] ] ) ? selected( $option, $pib_options[$args['id']], false ) : '';
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
	endforeach;

	$html .= '</select>';
	$html .= '<label for="pib_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/*
 * Textarea callback function
 */

function pib_textarea_callback( $args ) {
	global $pib_options;

	if ( isset( $pib_options[ $args['id'] ] ) )
		$value = $pib_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<textarea class="" cols="120" rows="10" id="pib_settings_' . $args['section'] . '[' . $args['id'] . ']" name="pib_settings_' . $args['section'] . '[' . $args['id'] . ']">' . esc_textarea( $value ) . '</textarea>';
	$html .= '<label for="pib_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/*
 * Function we can use to sanitize the input data and return it when saving options
 */

function pib_settings_sanitize( $input ) {
	add_settings_error( 'pib-notices', '', __('Settings Updated', 'pib'), 'updated' );
	return $input;
}
/*
 *  Default callback function if correct one does not exist
 */

function pib_missing_callback() {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'pib' ), $args['id'] );
}

/*
 * Function used to return an array of all of the plugin settings
 */
function pib_get_settings() {
	$general_settings =			is_array( get_option( 'pib_settings_general' ) ) ? get_option( 'pib_settings_general' )  : array();
	$post_visibility_settings =	is_array( get_option( 'pib_settings_post_visibility' ) ) ? get_option( 'pib_settings_post_visibility' )  : array();
	$style_settings =			is_array( get_option( 'pib_settings_styles' ) ) ? get_option( 'pib_settings_styles' )  : array();
	
	echo 'Testing: ' . $general_settings['button_style'] . '<br />';
	
	return array_merge( $general_settings, $post_visibility_settings, $style_settings );
}
