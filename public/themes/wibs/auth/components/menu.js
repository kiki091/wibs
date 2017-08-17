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
