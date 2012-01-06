$(function() {

/**
 * @param iframe DOMElement
 * @param msg object
 * @todo get confirmation receipts
 */
function sendEmbedMessage(iframe, msg) {
	var target = iframe.contentWindow,
		key = 'mediawiki.embedscript:',
		rawMsg = key + JSON.stringify(msg);
	target.postMessage(rawMsg, '*');
}

$('.mw-embedscript').each(function() {
	var script = this,
		$script = $(script),
		data = $script.data('embed'); // this seems to magically de-JSON us. Is this safe?

	var $iframe = $('<iframe>'),
		iframe = $iframe[0];
	
	$iframe
		.attr('src', 'http://embed-sandbox.wmflabs.org/')
		.attr('width', data.width || 640)
		.attr('height', data.height || 480)
		.one('load', function() {
			sendEmbedMessage(iframe, {
				event: 'init',
				data: data
			});
		})
		.appendTo($script);
});

});
