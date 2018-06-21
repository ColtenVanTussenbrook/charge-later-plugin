jQuery(document).ready( function($) {
  $('#stripe-payment-form input').blur(function() {
    $.ajax({
  		url: ajaxcall.ajax_url,
  		success: function( data ) {
  			alert( 'Your home page has ' + $(data).find('div').length + ' div elements.');
  		}
  	})
  })


});