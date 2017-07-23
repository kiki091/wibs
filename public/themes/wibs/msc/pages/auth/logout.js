function logout() {

	showLoading()

	$.get(laroute.route('msc_logout', []), function()
    {
    	hideLoading()
        $(location).prop('href', laroute.route('msc_login', []));
    });

}