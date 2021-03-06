<!DOCTYPE html>
<html lang="en">
    <head>
        @include('wibs.auth.partials.header')
    </head>

    <body class="nav-md">
        <div class="container body">

            <div class="main_container">
                <!-- PAGE -->
                @include('wibs.auth.partials.sidebar')
                @include('wibs.auth.partials.top-nav')

                <div class="right_col" role="main">
                    @yield('content')
                </div>
            </div>
            
        </div>
        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>
        @include('wibs.master.vars')
        @include('wibs.auth.partials.js_footer')
        
    </body>
</html>


