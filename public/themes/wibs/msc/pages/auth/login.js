$(document).ready(function() {

	$('#submit__msc__login__button').on('click',function(event) {
		
		showLoading(true)
		
		setTimeout(function(){
	        hideLoading()
	    }, 3000);
		
	});
})