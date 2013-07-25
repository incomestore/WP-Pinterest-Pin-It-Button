(function ($) {
	"use strict";
	$(function () {
		//Administration-specific JavaScript
		
		// Show/Hide the input boxes for the widget
		function toggleWidgetArea() {
			
			$( "input.pib-widget-pre-selected" ).each( function() {
				if( $( this ).prop( "checked" ) ) {
					$( this ).parent().next( ".pib-widget-text-fields" ).show();
				}
			});
			
			
			$( "input.pib-widget-toggle" ).change( function() {
				$( this ).parent().parent().find( ".pib-widget-text-fields" ).toggle();
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