<!DOCTYPE html>
<html lang="en">
	@section('pageheadtitle')
		User Account
	@endsection
	@include('wibs.msc.partials.header')
	<body class="login">

		<div>
      		<a class="hiddenanchor" id="signup"></a>
      		<a class="hiddenanchor" id="signin"></a>

<!-- 
  _    ___   ___ ___ _  _  __      _____ ____  _   ___ ___  
 | |  / _ \ / __|_ _| \| | \ \    / /_ _|_  / /_\ | _ \   \ 
 | |_| (_) | (_ || || .` |  \ \/\/ / | | / / / _ \|   / |) |
 |____\___/ \___|___|_|\_|   \_/\_/ |___/___/_/ \_\_|_\___/ 
                                                            
-->
      		<div class="login_wrapper">
          		<div class="animate form login_form">
              		<section class="login_content">
                  		<form role="form" method="POST" id="msc_form_login" action="{{ route('msc_authenticate')  }}">
                        		<h1>Login Form</h1>
                            <p>Please enter your username and password to login</p>

                        		<div class="form-group">
                          			<input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" id="email" />
                                <span class="form--error--message--left" id="form--error--message--email"></span>
                        		</div>
                        				
                        		<div class="form-group">
                          			<input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                                <span class="form--error--message--left" id="form--error--message--password"></span>
                        		</div>

                            @if (count($errors) > 0)
                                  @foreach ($errors->all() as $error)
                                      <p style="float: left; width: 50%" class="form--error--message--left">{{ $error }}</p>
                                  @endforeach
                            @endif

                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            			               <button id="submit__msc__login__button" class="full-width btn btn-primary submit" type="submit">
                                    Log in
                                 </button>
        			              </div>

        			              <div class="clearfix"></div>

                      </form>
              		</section>
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
    	@include('wibs.msc.partials.js_footer')
    	<script src="{{ asset('themes/wibs/msc/pages/auth/login.js') }}"></script>
	</body>
</html>