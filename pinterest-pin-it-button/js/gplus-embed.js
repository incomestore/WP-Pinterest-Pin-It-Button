//Embed JS that gets rendered in footer once if using official Google +1 JS buttons
//https://developers.google.com/+/plugins/+1button/

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
