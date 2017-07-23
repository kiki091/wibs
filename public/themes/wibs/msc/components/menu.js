// JAVASCRIPT MENU GROUP MANAGER

function menu_student_monitoring() {

	$('.right_col').load(laroute.route('msc_student_monitoring', []), function()
    {
    	init_student_monitoring()
    });
}