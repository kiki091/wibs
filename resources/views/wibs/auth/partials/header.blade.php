<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="PT. Asia Resource System">
<meta name="author" content="Wibs" />
<meta name="publisher" content="www.wibs.sch.id" />
<meta name="copyright" content="www.wibs.sch.id" />
<meta name="host" content="www.wibs.sch.id" />
<meta name="geo.position" content="-6.196985,106.84060099999999" />    
<meta name="geo.region" content="ID-JB" />
<meta name="geo.country" content="ID"/>
<meta name="geo.placename" content="Bogor, Indonesia" />
<meta name="ICBM" content="0.18597,117.47865" />    
<meta name="DC.title" content="Wibs" />

<meta Http-Equiv="Cache-Control" Content="no-cache">
<meta Http-Equiv="Pragma" Content="no-cache">
<meta Http-Equiv="Expires" Content="0">
<!-- OG CONTENT -->
<meta property="og:url" content="http://www.wibs.sch.id/" />
<meta property="og:title" content="Wibs" />
<meta property="og:description" content="Wibs" />
<meta property="og:image" content="{{ asset(LOGO_IMAGES_DIRECTORY.'logo.png') }}" />
<meta property="og:type"  content="article" />
<title>@yield('pageheadtitle' , 'AUTH | WIBS')</title>

<meta id="_token" name="_token" value="{{ csrf_token() }}">

<!-- Plugins -->
<link href="{{ asset('themes/wibs/auth/build/css/style.css') }}" rel="stylesheet">
<!-- Javascrip -->
<script src="{{ asset('themes/wibs/auth/build/js/plugins.js') }}"></script>