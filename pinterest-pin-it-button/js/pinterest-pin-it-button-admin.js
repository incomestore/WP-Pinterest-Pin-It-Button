//See http://digwp.com/2011/09/using-instead-of-jquery-in-wordpress/

jQuery(document).ready(function($) {

	//Enable collapse/expand toggle of admin boxes (like WP dashboard)
    
	$(".pib-hndle").toggle(function() {
		$(this).next(".inside").slideToggle("fast");
	}, function () {
		$(this).next(".inside").slideToggle("fast");
	});

	$(".pib-handlediv").toggle(function() {
		$(this).next(".pib-hndle").next(".inside").slideToggle("fast");
	}, function() {
		$(this).next(".pib-hndle").next(".inside").slideToggle("fast");
	});
    
    /*** Custom Button Image ***/
    
    disableCustomButtonImage();
    
    $("#use_custom_img_btn").change(function(event) {
        disableCustomButtonImage();
    });

    //Disable custom button image label and row elements depending on enabled checkbox
    function disableCustomButtonImage() {
        var customButtonEnabled = $("#use_custom_img_btn").is(":checked");
        
        $("#custom_img_btn_select_row, #custom_btn_img, #custom_btn_img_select_link").toggleClass("disabled", !customButtonEnabled);
    }    
	
    //Process custom button image selection from thickbox popup (Pro)
    //Making table cell clickable instead of inside link tag
    $("#custom_img_btn_selector .custom-btn-img-cell").click(function(event) {
        event.preventDefault();
        
        var img_url = $(this).data("img-url");
        
        //Close thickbox popup right after click
        tb_remove();

        //Update settings screen current image under modal box
        //Just fill in hidden field on parent form. No need to post via ajax.
        $("img#custom_btn_img").prop("src", img_url);
        $("input#custom_btn_img_url").val(img_url);
	});
    
    //Close custom button image examples thickbox popup (Lite)
    $("#custom_img_btn_examples_container .upgrade-text a.close").click(function(event) {
        tb_remove();
    });
    
    /*** Other Social Sharing Buttons / Share Bar ***/
    
    disableShareBarSelection();
    
    $("#use_other_sharing_buttons").change(function(event) {
        disableShareBarSelection();
    });

    //Disable share bar label and drop-downs depending on enabled checkbox
    function disableShareBarSelection() {
        var sharingEnabled = $("#use_other_sharing_buttons").is(":checked");
        
        //Adding disable attribute causes drop-down values to save as blank, so just add visual disable class
        //$("#share_btn_1, #share_btn_2, #share_btn_3, #share_btn_4").prop("disabled", !sharingEnabled);
        $("#share_btn_label, #share_btn_1, #share_btn_2, #share_btn_3, #share_btn_4").toggleClass("disabled", !sharingEnabled);
    }
    
});
