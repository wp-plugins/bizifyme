// thickbox settings (increased width for #TB_window from 720 to 1110)
var tb_position;
(function($) {
	tb_position = function() {
		var tbWindow = $('#TB_window'), width = $(window).width(), H = $(window).height(), W = ( 1110 < width ) ? 1100 : width, adminbar_height = 0;

		if ( $('body.admin-bar').length )
			adminbar_height = 28;

		if ( tbWindow.size() ) {
			tbWindow.width( W - 50 ).height( H - 45 - adminbar_height );
			$('#TB_iframeContent').width( W - 50 ).height( H - 75 - adminbar_height );
			tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
			if ( typeof document.body.style.maxWidth != 'undefined' )
				tbWindow.css({'top': 20 + adminbar_height + 'px','margin-top':'0'});
		};

		return $('a.thickbox').each( function() {
			var href = $(this).attr('href');
			if ( ! href ) return;
			href = href.replace(/&width=[0-9]+/g, '');
			href = href.replace(/&height=[0-9]+/g, '');
			$(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 - adminbar_height ) );
		});
	};

	$(window).resize(function(){ tb_position(); });

	// store caret position in IE
	$(document).ready(function($){
		$('a.thickbox').click(function(){
			var ed;

			if ( typeof(tinymce) != 'undefined' && tinymce.isIE && ( ed = tinymce.get(wpActiveEditor) ) && !ed.isHidden() ) {
				ed.focus();
				ed.windowManager.insertimagebookmark = ed.selection.getBookmark();
			}
		});
	});

})(jQuery);