<?php

/**
 * Represents the view for the widget component of the plugin.
 *
 * @package    PIB
 * @subpackage Includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) )
	exit;

class PIB_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array( 'classname' => 'pib-clearfix', 'description' => __( 'Add a Pinterest "Pin It" button to your sidebar with this widget.', 'pib' ) );
		$control_ops = array( 'width' => 400 );  //doesn't use height
		parent::__construct( 'pib_button', 'Pinterest "Pin It" Button', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
        global $pib_options;
		extract( $args );
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		
        
        $pib_url_of_webpage_widget = $instance['pib_url_of_webpage_widget'];
        
        //Set URL to home page if button style is "user selects image"
        if ( empty( $pib_url_of_webpage_widget ) && ( $pib_options['button_style'] == 'user_selects_image' ) ) {
            $pib_url_of_webpage_widget = get_home_url();
        }
        
		$pib_url_of_img_widget  = $instance['pib_url_of_img_widget'];		
		$pib_description_widget = $instance['pib_description_widget'];
		$count_layout           = empty( $instance['count_layout'] ) ? 'none' : $instance['count_layout'];
		$align                  = empty( $instance['button_align'] ) ? 'none' : $instance['button_align'];
		$pib_remove_div         = (bool) $instance['remove_div'];
        
		$base_btn = pib_button_base( $pib_url_of_webpage_widget, $pib_url_of_img_widget, $pib_description_widget, $count_layout );
		
		echo $before_widget;
        
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
        }
		
		if ( $pib_remove_div ) {
			echo $base_btn;
		}
		else {
			
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
			
			// Surround with div tag
			echo '<div class="pin-it-btn-wrapper-widget ' . $align_class . '">' . $base_btn . '</div>';
		}
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title']                     = strip_tags($new_instance['title']);
		$instance['pib_url_of_webpage_widget'] = strip_tags( $new_instance['pib_url_of_webpage_widget'] );
		$instance['pib_url_of_img_widget']     = strip_tags( $new_instance['pib_url_of_img_widget'] );
		$instance['pib_description_widget']    = strip_tags( $new_instance['pib_description_widget'] );		
		$instance['count_layout']              = $new_instance['count_layout'];
		$instance['button_align']              = $new_instance['align'];
        $instance['remove_div']                = ( $new_instance['remove_div'] ? 1 : 0 );
		$instance['button_type']               = $new_instance['button_type'];
        
		return $instance;
	}

	function form( $instance ) {
        global $pib_options;
		
		$default = array(
			'title'                     => '',
			'count_layout'              => 'none',
			'button_type'               => 'user_selects_image',
			'pib_url_of_webpage_widget' => '',
			'pib_url_of_img_widget'     => '',
			'pib_description_widget'    => '',
			'button_align'              => 'none',
			'remove_div'                => 0
		);
        
		$instance = wp_parse_args( (array) $instance, $default );
		
		$title                     = strip_tags($instance['title']);
		$pib_url_of_webpage_widget = strip_tags( $instance['pib_url_of_webpage_widget'] );
		$pib_url_of_img_widget     = strip_tags( $instance['pib_url_of_img_widget'] );
		$pib_description_widget    = strip_tags( $instance['pib_description_widget'] );
		$pib_button_type_widget    = $instance['button_type'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional)', 'pib' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count_layout' ); ?>"><?php _e( 'Pin Count:', 'pib' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'count_layout' ); ?>" id="<?php echo $this->get_field_id( 'count_layout' ); ?>">
				<option value="none" <?php selected( $instance['count_layout'], 'none' ); ?>><?php _e( 'Not Shown', 'pib' ); ?></option>
				<option value="horizontal" <?php selected( $instance['count_layout'], 'horizontal' ); ?>><?php _e( 'Beside the Button', 'pib' ); ?></option>
				<option value="vertical" <?php selected( $instance['count_layout'], 'vertical' ); ?>><?php _e( 'Above the Button', 'pib' ); ?></option>
			</select>
		</p>
		<p>
			Button Type
		</p>
		<p>
			<input type="radio" name="<?php echo $this->get_field_name( 'button_type' ); ?>" value="user_selects_image" id="<?php echo $this->get_field_id( 'user_selects_image' ); ?>" <?php checked( $pib_button_type_widget, 'user_selects_image' ); ?> />
			<label for="<?php echo $this->get_field_id( 'user_selects_image' ); ?>"><?php _e( 'User selects image from popup (any image)', 'pib' ); ?></label>
		</p>
		<p>	
			<input type="radio" name="<?php echo $this->get_field_name( 'button_type' ); ?>" value="image_pre_selected" id="<?php echo $this->get_field_id( 'image_pre_selected' ); ?>" <?php checked( $pib_button_type_widget, 'image_pre_selected' ); ?> />
			<label for="<?php echo $this->get_field_id( 'image_pre_selected' ); ?>"><?php _e( 'Image is pre-selected (one image -- defaults to first image in post)', 'pib' ); ?></label>
		</p>
		<div class="pib-widget-text-fields">
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_url_of_webpage_widget' ); ?>"><?php _e( 'URL of the web page to be pinned', 'pib' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_url_of_webpage_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_url_of_webpage_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_url_of_webpage_widget ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_url_of_img_widget' ); ?>"><?php _e( 'URL of the image to be pinned', 'pib' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_url_of_img_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_url_of_img_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_url_of_img_widget ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_description_widget' ); ?>"><?php _e( 'Description of the pin (optional)', 'pib' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_description_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_description_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_description_widget ); ?>" />
			</p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php _e( 'Alignment', 'pib' ); ?>:</label>
			<select name="<?php echo $this->get_field_name( 'align' ); ?>" id="<?php echo $this->get_field_id( 'align' ); ?>">
				<option value="none" <?php selected( $instance['button_align'], 'none' ); ?>><?php _e( 'None', 'pib' ); ?></option>
				<option value="left" <?php selected( $instance['button_align'], 'left' ); ?>><?php _e( 'Left', 'pib' ); ?></option>
				<option value="right" <?php selected( $instance['button_align'], 'right' ); ?>><?php _e( 'Right', 'pib' ); ?></option>
				<option value="center" <?php selected( $instance['button_align'], 'center' ); ?>><?php _e( 'Center', 'pib' ); ?></option>
			</select>
		</p>
		<p>
			<input class="checkbox" <?php checked($instance['remove_div'], true) ?> id="<?php echo $this->get_field_id( 'remove_div' ); ?>"
				   name="<?php echo $this->get_field_name( 'remove_div' ); ?>" type="checkbox"/>
			<label for="<?php echo $this->get_field_id( 'remove_div' ); ?>">
				<?php _e( 'Remove div tag surrounding this widget button. Also removes alignment setting.', 'pib' ); ?>
			</label>
		</p>
        <?php
	}
}

function register_pib_widgets() {
	register_widget( 'PIB_Widget' );
}
add_action( 'widgets_init', 'register_pib_widgets' );
