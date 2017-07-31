// JAVASCRIPT

function menu_student_monitoring() {

	$('.right_col').load(laroute.route('msc_student_monitoring', []), function()
    {
    	init_student_monitoring()
    });
}

// JAVASCRIPT

function menu__report__tahfidz() {

	$('.right_col').load(laroute.route('msc_quran_recitation', []), function()
    {
    	init__report__tahfidz()
    });
}