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

// JAVASCRIPT

function menu_report_hadis() {

	$('.right_col').load(laroute.route('msc_report_hadis', []), function()
    {
    	init__report_hadis()
    });
}

// JAVASCRIPT

function menu__report__kesantrian() {

	$('.right_col').load(laroute.route('msc_default', []), function()
    {
    	init__default()
    });
}

// JAVASCRIPT

function menu__report__akademik() {

	$('.right_col').load(laroute.route('msc_default', []), function()
    {
    	init__default()
    });
}