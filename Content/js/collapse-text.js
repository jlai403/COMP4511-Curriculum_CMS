(function($) {
	$.fn.addReadMore = function() {
		var element = $(this);
		
		if (element.height() < 16) return;
		
		element.addClass("collapsed");
		var readMore = $("<span class='show-more'>read more ...</span>");
		readMore.insertAfter(element);
	}
	
	$.fn.expandText = function() {
		var actionElement = $(this);
		actionElement.removeClass("show-more");
		actionElement.addClass("show-less");
		actionElement.text("show less ...");
		
		var textToExpand = actionElement.prev();
		textToExpand.removeClass("collapsed");
	}
	
	$.fn.collapseText = function() {
		var actionElement = $(this);
		actionElement.removeClass("show-less");
		actionElement.addClass("show-more");
		actionElement.text("read more ...");
		
		var textToCollapse = actionElement.prev();
		textToCollapse.addClass("collapsed");
	}
}(jQuery));