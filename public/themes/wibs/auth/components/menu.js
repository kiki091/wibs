// JAVASCRIPT MENU GROUP MANAGER

function menuGroup()
{
    $('.right_col').load(laroute.route('CmsMenuGroupManager', []), function()
    {
    	initMenuGroup()
    });
}

// JAVASCRIPT MENU NAVIGATION MANAGER

function menuNavigation()
{
    $('.right_col').load(laroute.route('CmsMenuNavigation', []), function()
    {
    	initMenuNavigation()
    });
}

// JAVASCRIPT SUB MENU NAVIGATION MANAGER

function menuSubNavigation()
{
    $('.right_col').load(laroute.route('CmsSubMenuNavigation', []), function()
    {
    	initSubMenuNavigation()
    });
}

// JAVASCRIPT USER ACCOUNT MANAGER

function menuUserAccount()
{
    $('.right_col').load(laroute.route('CmsUserAccount', []), function()
    {
    	initUserAccount()
    });
}
// JAVASCRIPT CMS SANTRI

function santri()
{
    $('.right_col').load(laroute.route('cms_santri', []), function()
    {
        init_menu_santri()
    });
}

// JAVASCRIPT CMS WALI SANTRI

function wali_santri()
{
    $('.right_col').load(laroute.route('cms_wali_santri', []), function()
    {
        init_menu_wali_santri()
    });
}

// JAVASCRIPT CMS report tahfidz

function report_tahfidz()
{
    $('.right_col').load(laroute.route('cms_report_quran', []), function()
    {
        init_menu_report_quran()
    });
}

// JAVASCRIPT CMS report kesehatan

function report_kesehatan()
{
    $('.right_col').load(laroute.route('cms_report_kesehatan', []), function()
    {
        init_menu_report_kesehatan()
    });
}

// JAVASCRIPT CMS report kesehatan

function report_hadis()
{
    $('.right_col').load(laroute.route('cms_report_hadis', []), function()
    {
        init_menu_report_hadis()
    });
}
