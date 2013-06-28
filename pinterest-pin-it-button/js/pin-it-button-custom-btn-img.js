//JS to create count bubble for custom image button
//Modified from original Pinterest iframe pinit.html

jQuery(document).ready(function($) {
	var baseApiUrl = "//api.pinterest.com/v1/urls/count.json?callback=?";
	
	//Loop through pin it button table that contains css/image and count bubble
	$(".pib-count-table").each(function (index) {
		var parentContainer = $(this);
		var pinItLink = parentContainer.find(".pin-it-button-no-iframe");		
	    var countLayout = 'horizontal';
        var alwaysShowCount = false;
		
		// Parse args
		var vars = {}
		var url = pinItLink.attr("href");
		var pairs = url.slice(url.indexOf('?') + 1).split('&');
		for (var i = 0; i < pairs.length; i++) {
			var parts = pairs[i].split('=');
			vars[parts[0]] = parts[1];
		}
		
		countLayout = pinItLink.attr("count-layout") || countLayout;
		alwaysShowCount = pinItLink.attr("always-show-count") || alwaysShowCount;
        
		// Request count from API
		if (countLayout != 'none' || alwaysShowCount) {
			var targetUrl = vars['url'] || vars['media'];
			
			//Decode URL and convert + to space
			//http://stackoverflow.com/questions/901115/get-query-string-values-in-javascript
			targetUrl = decodeURIComponent(targetUrl.replace(/\+/g, " "));
			
			$.getJSON(baseApiUrl, { url: targetUrl }, function (data) {
				//Don't show count bubble if count is zero
				if ((data.count < 1) && !alwaysShowCount) {
					return;
				}
				
				//Transform count (from Pinterest JS)
				var count = data.count;
                if (count > 999 && count <= 999999)
                    count = Math.floor(count / 1000) + "K+";
                else if (count > 999999 && count <= 999999999)
                    count = Math.floor(count / 1000000) + "M+";
                else if (count > 999999999)
                    count = "++";
				
				//If this far display the bubble and count
				parentContainer.find(".pib-count-cell").show();
				parentContainer.find(".pib-count-bubble").html(count);
			});			
		}		
	});
});
