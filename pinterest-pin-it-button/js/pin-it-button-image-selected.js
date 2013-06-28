//Add click event for image-selected/no-iframe version
jQuery(document).ready(function($) {
    $("a.pin-it-button-image-selected").click(function(event) {
        event.preventDefault();
        var modal = window.open($(this).attr('href'),'pibModal','width=665,height=300');
        if (window.focus) { modal.focus(); }
    });
});
