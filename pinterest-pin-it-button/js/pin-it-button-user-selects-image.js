//Added function for firing off Pinterest's pinmarklet.js for "user selects image" button type
function execPinmarklet() {
	var e=document.createElement('script');
	e.setAttribute('type','text/javascript');
	e.setAttribute('charset','UTF-8');
	e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r=' + Math.random()*99999999);
	document.body.appendChild(e);
}

//Add click event for user-selects-image/no-frame version
jQuery(document).ready(function($) {
    $("a.pin-it-button-user-selects-image").click(function(event) {
        event.preventDefault();
        execPinmarklet();
    });
});
