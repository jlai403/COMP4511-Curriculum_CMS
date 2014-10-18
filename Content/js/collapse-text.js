(function($) {
	$.fn.addReadMore = function() {
		var element = $(this);
		
		if (element.height() < 16) return;
		
		element.addClass("collapsible");
		element.css("height","30");
		var readMore = $("<span class='show-more'>read more ...</span>");
		readMore.insertAfter(element);
	}
	
	$.fn.expandText = function() {
		var actionElement = $(this);
		actionElement.removeClass("show-more");
		actionElement.addClass("show-less");
		actionElement.text("show less ...");
		
		var textToExpand = actionElement.prev();
		var height = textToExpand.height();
		var heightToExpand = textToExpand.css("height","auto").height();
		textToExpand.css("height",height).height();
		textToExpand.animate({height: heightToExpand}).removeClass("collapsible");
	}
	
	$.fn.collapseText = function() {
		var actionElement = $(this);
		actionElement.removeClass("show-less");
		actionElement.addClass("show-more");
		actionElement.text("read more ...");
		
		var textToCollapse = actionElement.prev();
		textToCollapse.animate({height:"30"}).addClass("collapsible");
	}
}(jQuery));