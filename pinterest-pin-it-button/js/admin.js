(function ($) {
	"use strict";
	$(function () {
		//Administration-specific JavaScript
		
		// Show/Hide the input boxes for the widget
		function toggleWidgetArea() {
			if( $( "#widget-pib_button-2-image_pre_selected" ).attr( "checked" ) == 'checked' ) {
				$( ".pib-widget-text-fields" ).show();
			}

			$( "input[name='widget-pib_button[2][button_type]']" ).change( function() {
				$( ".pib-widget-text-fields" ).toggle();
			});
		}
		
		$(document).ajaxComplete( function() {
			// We need to do this since the widget saves using AJAX
			toggleWidgetArea();
		});
		
		$(document).ready( function() {
			// Call our widget area code
			toggleWidgetArea();
		});
	});
}(jQuery));