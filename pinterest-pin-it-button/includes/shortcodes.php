<?php

/**
 * Define plugin shortcodes.
 *
 * @package    PIB
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

function pib_pinit_shortcode( $attr ) {
	global $pib_options;
	global $post;
    $postID = $post->ID;
    
    /*
        For URL, image URL and Description, use in order:
        1) attribute value
        2) custom fields for post
        3) inherit from post: permalink, first image, post title
    */
    
    extract( shortcode_atts( array(
					'count'       => 'none',
					'url'         => '',
					'image_url'   => '',
					'description' => '',
					'align'       => 'none',
					'remove_div'  => false,
					'button_type' => 'any',
					'size'        => '',
					'color'       => ''
				), $attr ) );

    if ( empty( $url ) ) {
        $url = get_post_meta( $postID, 'pib_url_of_webpage', true);

        if ( empty( $url ) ) {
            $url = get_permalink( $postID );
        }
    }
    
    if ( empty( $image_url ) ) {
        $image_url = get_post_meta( $postID, 'pib_url_of_img', true);

        if ( empty( $image_url ) ) {
            //Get url of img and compare width and height
            $output    = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
			
			if ( ! ( 0 == $output || false == $output ) ) {
				$image_url = $matches [1] [0];
			} else {
				$image_url = '';
			}
        }
    }
    
    if ( empty( $description ) ) {
        $description = get_post_meta( $postID, 'pib_description', true);

        if ( empty( $description ) ) {
            $description = get_the_title( $postID );
        }
    }
    
	// set button_type to a correct parameter to be passed
	$button_type = ( $button_type == 'one' ? 'image_selected' : 'user_selects_image' );
	
	$base_btn = pib_button_base( $button_type, $url, $image_url, $description, $count );
    
    //Don't wrap with div or set float class if "remove div" is checked
	if ( $remove_div ) {
		return $base_btn;
	}
	else {
		//Surround with div tag
		$align_class = '';
		
		if ( 'left' == $align ) {
			$align_class = 'pib-align-left';
		}
		elseif ( 'right' == $align ) {
			$align_class = 'pib-align-right';
		}
		elseif ( 'center' == $align ) {
			$align_class = 'pib-align-center';
		}
	
		return '<div class="pin-it-btn-wrapper-shortcode ' . $align_class . '">' . $base_btn . '</div>';
	}
}

add_shortcode( 'pinit', 'pib_pinit_shortcode' );
