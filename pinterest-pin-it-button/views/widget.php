<?php

/**
 * Represents the view for the widget component of the plugin.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package    PIB
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

class PIB_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array( 'classname' => 'pib-clearfix', 'description' => __( 'Add a Pinterest "Pin It" button to your sidebar with this widget.', 'pib' ) );
		$control_ops = array( 'width' => 400 );  //doesn't use height
		parent::__construct( 'pib_button', 'Pinterest "Pin It" Button', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
        global $pib_options;
		extract($args);
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );		
        
        $pib_url_of_webpage_widget = $instance['pib_url_of_webpage_widget'];
        
        //Set URL to home page if button style is "user selects image"
        if ( empty( $pib_url_of_webpage_widget ) && ( $pib_options['button_style'] == 'user_selects_image' ) ) {
            $pib_url_of_webpage_widget = get_home_url();
        }
        
		$pib_url_of_img_widget = $instance['pib_url_of_img_widget'];		
		$pib_description_widget = $instance['pib_description_widget'];
		$count_layout = empty( $instance['count_layout'] ) ? 'none' : $instance['count_layout'];
		$float = empty( $instance['float'] ) ? 'none' : $instance['float'];
		$pib_remove_div = (bool)$instance['remove_div'];
        
		$base_btn = pib_button_base( $pib_url_of_webpage_widget, $pib_url_of_img_widget, $pib_description_widget, $count_layout );
		
		echo $before_widget;
        
		if ( $title ) {
			echo $before_title . $title . $after_title;
        }
		
		if ( $pib_remove_div ) {
			echo $base_btn;
		}
		else {
			//Surround with div tag
			$float_class = '';
			
			if ( $float == 'left' ) {
				$float_class = 'pib-float-left';
			}
			elseif ( $float == 'right' ) {
				$float_class = 'pib-float-right';
			}
		
			echo '<div class="pin-it-btn-wrapper-widget ' . $float_class . '">' . $base_btn . '</div>';
		}
		
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array)$new_instance, array( 'count_layout' => 'none', 'title' => '', 
			'pib_count_button_radio' => 'user_selects_image', 'float' => 'none' ) );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['pib_url_of_webpage_widget'] = strip_tags( $new_instance['pib_url_of_webpage_widget'] );
		$instance['pib_url_of_img_widget'] = strip_tags( $new_instance['pib_url_of_img_widget'] );
		$instance['pib_description_widget'] = strip_tags( $new_instance['pib_description_widget'] );		
		$instance['count_layout'] = $new_instance['count_layout'];
		$instance['float'] = $new_instance['float'];
        $instance['remove_div'] = ( $new_instance['remove_div'] ? 1 : 0 );
        
		return $instance;
	}

	function form( $instance ) {
        global $pib_options;
        
		$instance = wp_parse_args( (array) $instance, array( 'count_layout' => 'none', 'title' => '', 
			'pib_count_button_radio' => 'user_selects_image', 'float' => 'none' ) );
		$title = strip_tags($instance['title']);
		$pib_url_of_webpage_widget = strip_tags( $instance['pib_url_of_webpage_widget'] );
		$pib_url_of_img_widget = strip_tags( $instance['pib_url_of_img_widget'] );
		$pib_description_widget = strip_tags( $instance['pib_description_widget'] );
		$pib_button_style_widget = ( $pib_options['button_style'] == 'user_selects_image' ) ? __( 'User selects image', 'pib' ) : __( 'Image pre-selected', 'pib' );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'pib' ); ?></label>
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
		<div class="pib-widget-text-fields">
            <p>
                <?php _e( 'Button style is inherited from setting saved in', 'pib' ); ?>
                    <a href="<?php echo admin_url( 'admin.php?page=pinterest-pin-it-button' ); ?>"><?php _e( '"Pin It" Button Settings', 'pib' ); ?></a>.
            </p>
            <p>
				<?php _e( 'Current style', 'pib' ) ?>: <strong><?php echo $pib_button_style_widget; ?></strong>
            </p>
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_url_of_webpage_widget' ); ?>"><?php _e( 'URL of the web page to be pinned', 'pib' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_url_of_webpage_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_url_of_webpage_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_url_of_webpage_widget ); ?>" />
                <span class="description"><?php _e( 'Required for "image pre-selected". Defaults to home page for "user selects image".', 'pib' ); ?></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_url_of_img_widget' ); ?>"><?php _e( 'URL of the image to be pinned', 'pib' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_url_of_img_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_url_of_img_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_url_of_img_widget ); ?>" />
                <span class="description"><?php _e( 'Required for "image pre-selected". Not used for "user selects image".', 'pib' ); ?></span>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'pib_description_widget' ); ?>"><?php _e( 'Description of the pin (optional)', 'pib' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'pib_description_widget' ); ?>" name="<?php echo $this->get_field_name( 'pib_description_widget' ); ?>"
					   type="text" value="<?php echo esc_attr( $pib_description_widget ); ?>" />
			</p>
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'float' ); ?>"><?php _e( 'Alignment', 'pib' ); ?>:</label>
			<select name="<?php echo $this->get_field_name( 'float' ); ?>" id="<?php echo $this->get_field_id( 'float' ); ?>">
				<option value="none" <?php selected( $instance['float'], 'none' ); ?>><?php _e( 'None', 'pib' ); ?></option>
				<option value="left" <?php selected( $instance['float'], 'left' ); ?>><?php _e( 'Left', 'pib' ); ?></option>
				<option value="right" <?php selected( $instance['float'], 'right' ); ?>><?php _e( 'Right', 'pib' ); ?></option>
				<option value="center" <?php selected( $instance['float'], 'center' ); ?>><?php _e( 'Center', 'pib' ); ?></option>
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