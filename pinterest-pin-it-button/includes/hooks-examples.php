<?php

/*************************
 * FILTER HOOKS
 ************************/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Modifies the HTML output of the shortcode button
 * 
 * @since 2.0.3
 */
function test_pib_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
//add_filter( 'pib_shortcode_html', 'test_pib_shortcode_html' );


/**
 * Used to modify the widget HTML
 * 
 * @since 2.0.3
 */
function test_pib_widget_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
//add_filter( 'pib_widget_html', 'test_pib_widget_html' );


/**
 * Used to modify the regular button HTML
 * 
 * @since 2.0.3
 */
function test_pib_button_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
//add_filter( 'pib_button_html', 'test_pib_button_html' );


/**
 * Outputs additional HTML before the PIB shortcode
 * 
 * @since 2.0.3
 */
function test_pib_shortcode_before( $before_html ) {
	return $before_html . '<p>Before</p>';
}
//add_filter( 'pib_shortcode_before', 'test_pib_shortcode_before' );


/**
 * Outputs additional HTML after the PIB shortcode
 * 
 * @since 2.0.3
 */
function test_pib_shortcode_after() {
	return $after_html . '<p>After</p>';
}
//add_filter( 'pib_shortcode_after', 'test_pib_shortcode_after' );


/**
 * Outputs additional HTML before the default button
 * 
 * @since 2.0.3
 */
function test_pib_button_before( $before_html ) {
	return '<p>Button Before</p>';
}
add_filter( 'pib_button_before', 'test_pib_button_before' );


/**
 * Outputs additional HTML after the default button
 * 
 * @since 2.0.3
 */
function test_pib_button_after( $after_html ) {
	return '<p>Button After</p>';
}
add_filter( 'pib_button_after', 'test_pib_button_after' );


/*************************
 * ACTION HOOKS
 ************************/

/**
 * Outputs additional HTML after the default button
 * 
 * @since 2.0.3
 */
function test_pib_widget_before() {
	echo '<p>Widget Before</p>';
}
add_action( 'pib_widget_before', 'test_pib_widget_before' );


/**
 * Outputs additional HTML after the default button
 * 
 * @since 2.0.3
 */
function test_pib_widget_after() {
	echo '<p>Widget After</p>';
}
add_action( 'pib_widget_after', 'test_pib_widget_after' );
