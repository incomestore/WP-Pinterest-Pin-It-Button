<?php

/**
 * Represents the view for the public-facing component of the plugin.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;


/**
 * Add Custom CSS.
 *
 * @since 2.0.0
 */
function pib_add_custom_css() {
	global $pib_options;
	
	if( false !== pib_render_button() ) {
		// Only add the custom CSS if it actually exists.
		if ( ! empty( $pib_options['custom_css'] ) ) {
			$custom_css = trim( $pib_options['custom_css'] );

			echo "\n" .
				'<style type="text/css">' . "\n" .
				$custom_css . "\n" . // Render custom CSS.
				'</style>' . "\n";
		}
	}
}
add_action( 'wp_head', 'pib_add_custom_css' );


/**
 * Function for rendering "Pin It" button base html.
 * HTML comes from Pinterest Widget Builder 7/10/2013.
 * http://business.pinterest.com/widget-builder/#do_pin_it_button
 * Sample HTML from widget builder:
 * <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="above">
 *		<img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
 * </a>
 *
 * @since 2.0.0
 */
function pib_button_base( $button_type, $post_url, $image_url, $description, $count_layout, $size, $color, $shape, $show_zero_count = null ) {
	global $pib_options;
	global $post;
	$postID = $post->ID;
	
	// Use updated backup button image URL from Pinterest.
	$btn_img_url = '//assets.pinterest.com/images/pidgets/pin_it_button.png';

	// Add "Pin It" title attribute.
	// Also add our own data attribute to track pin it button images.
	$inner_btn_html = '<img src="' . $btn_img_url . '" title="Pin It" data-pib-button="true" />';

	// Set data attribute for button style.
	if ( $button_type == 'image_selected' )
		$data_pin_do = 'buttonPin'; // image pre-selected
	else
		$data_pin_do = 'buttonBookmark'; // user selects image (default)

	// Set data attribute for count bubble style.
	if ( $count_layout == 'horizontal' )
		$data_pin_config = 'beside';
	elseif ( $count_layout == 'vertical' )
		$data_pin_config = 'above';
	else
		$data_pin_config = 'none';
	
	// Set post url to current post if still blank.
	if ( empty( $post_url ) )
		$post_url = get_permalink( $postID );

	// Set image url to first image if still blank.
	if ( empty( $image_url ) ) {
	   // Get url of img and compare width and height.
	   $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

	   // Make sure the was an image match and if not set the image url to be blank
	   if ( !( 0 == $output || false == $output ) )
		   $image_url = $matches [1] [0];
	   else
		   $image_url = '';
	}

	// Set description to post title if still blank.
	if ( empty( $description ) )
		$description = get_the_title( $postID );

	// Link href always needs all the parameters in it for the count bubble to work.
	// Pinterest points out to use protocol-agnostic URL for popup.
	$link_href = '//www.pinterest.com/pin/create/button/' .
		'?url='         . rawurlencode( $post_url ) .
		'&media='       . rawurlencode( $image_url ) .
		'&description=' . rawurlencode( wp_strip_all_tags( $description ) );
	
	// New options that were added to the widget builder on Pinterest
	// the size is different depending on the shape of the button, so first we determine the shape and then set the size
	if( $size == 'large' && $shape == 'circular' ) {
		$data_pin_size = 'data-pin-height="32" ';
	} else {
		$data_pin_size  = ( $size == 'large' ? 'data-pin-height="28" ' : ' ' );
	}
	
	$data_pin_color = ( ! empty( $color ) ? 'data-pin-color="' . $color . '" ' : ' ' );
	$data_pin_shape = ( $shape == 'circular' ? 'data-pin-shape="round" ' : ' ' );
	
	// Use new data-pin-zero option to show count bubbles even on pages that have 0 pins
	// check if show_zero_count parameter is set and turn on the zero count if it is true
	if( $show_zero_count !== null ) {
		$display_zero = ( ( $show_zero_count == 'true' ) ? 'data-pin-zero="true" ' : ' ' );
	} else {
		// Check main settings option and set accordingly
		$display_zero = ( ! empty( $pib_options['show_zero_count'] ) ? 'data-pin-zero="true" ' : ' ' );
	}

	// Full link html with data attributes.
	// Add rel="nobox" to prevent lightbox popup.
	$link_html = '<a href="' . $link_href . '" ' .
		'data-pin-do="' . $data_pin_do . '" ' .
		'data-pin-config="' . $data_pin_config . '" ' .
		$data_pin_size .
		$data_pin_color .
		$display_zero .
		$data_pin_shape .
		'rel="nobox">' .
		$inner_btn_html . '</a>';

	return $link_html;
}

/**
 * Button HTML to render for pages, posts, and excerpts.
 *
 * @since 2.0.0
 * 
 */
function pib_button_html( $image_url = '', $button_type = '' ) {
	global $pib_options;
	global $post;
	$postID = $post->ID;

	// Return nothing if sharing disabled on current post.
	if ( get_post_meta( $postID, 'pib_sharing_disabled', 1 ) )
		return '';

	// Set post url, image url and description from current post meta.
	// It'll leave them blank if there isn't any meta.
	$post_url = get_post_meta( $postID, 'pib_url_of_webpage', true );
	$description = get_post_meta( $postID, 'pib_description', true );

	if( get_post_meta( $postID, 'pib_url_of_img', true ) )
		$image_url = get_post_meta( $postID, 'pib_url_of_img', true );

	$count_layout = $pib_options['count_layout'];
	
	$size = ( ! empty( $pib_options['data_pin_size'] ) ? $pib_options['data_pin_size'] : '' );
	$color = ( ! empty( $pib_options['data_pin_color'] ) ? $pib_options['data_pin_color'] : '' );
	$shape = ( ! empty( $pib_options['data_pin_shape'] ) ? $pib_options['data_pin_shape'] : '' );
	
	if( empty( $button_type  ) ) {
		$button_type = $pib_options['button_type'];
	}

	$base_btn = pib_button_base( $button_type, $post_url, $image_url, $description, $count_layout, $size, $color, $shape );

	// Don't wrap with div if using other sharing buttons or "remove div" is checked.
	if ( ! empty( $pib_options['remove_div'] ) )
		$html = $base_btn;
	else
		$html = '<div class="pin-it-btn-wrapper">' . $base_btn . '</div>'; // Surround with div tag
	
	
	$before_html = '';
	$after_html  = '';
	
	$before_html = apply_filters( 'pib_button_before', $before_html );
	$html        = apply_filters( 'pib_button_html', $html );
	$after_html  = apply_filters( 'pib_button_after', $after_html );
	
	
	return $before_html . $html . $after_html;
}

/**
 * Render button HTML on pages with regular content.
 *
 * @since 2.0.0
 * 
 */
function pib_render_content( $content ) {
	global $pib_options;
	global $post;
	
	if( ! is_main_query() )
		return $content;
	
	//Determine if button displayed on current page from main admin settings
	if ( 'button' == pib_render_button() ) {
	   if ( ! empty( $pib_options['post_page_placement']['display_above_content'] ) ) {
		  $content = pib_button_html() . $content;
	   }
	   if ( ! empty( $pib_options['post_page_placement']['display_below_content'] ) ) {
		  $content .= pib_button_html();
	   }
	}

	return $content;
}
add_filter( 'the_content', 'pib_render_content', 100 );

/**
 * Render button HTML on pages with excerpts if option checked.
 *
 * @since 2.0.0
 * 
 */
function pib_render_content_excerpt( $content ) {
	global $pib_options;
	global $post;
	
	if( ! is_main_query() )
		return $content;
	
	if ( ! empty( $pib_options['post_page_placement']['display_on_post_excerpts'] ) ) {
	   if (
		  ( is_home() && ( ! empty( $pib_options['post_page_types']['display_home_page'] ) ) ) ||
		  ( is_front_page() && ( ! empty( $pib_options['post_page_types']['display_front_page'] ) ) )
		 ) {
		  if ( ! empty( $pib_options['post_page_placement']['display_above_content'] ) ) {
			 $content = pib_button_html() . $content;
		  }
		  if ( ! empty( $pib_options['post_page_placement']['display_below_content'] ) ) {
			 $content .= pib_button_html();
		  }
	   }

	}

	return $content;
}
add_filter( 'the_excerpt', 'pib_render_content_excerpt', 100 );



