<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
{!! Html::style('css/bootstrap.min.css')!!}
{!! Html::style('css/jquery-ui.css') !!} 
{!!HTML::style('css/bootstrap-toggle.css')!!}
{!!HTML::style('css/bootstrap-datepicker.min.css')!!}
{!!HTML::style('css/font-awesome.min.css') !!}
{!!HTML::style('css/custom-style.css')!!}
{!!HTML::script('js/jquery.js')!!}
{!!HTML::script('js/bootstrap.min.js')!!}
{!!HTML::script('js/jquery-ui.min.js')!!}
{!!HTML::script('js/bootstrap-toggle.js')!!}
{!!HTML::script('js/bootstrap-datepicker.min.js')!!}
{!!HTML::script('js/jquery-custom.js')!!}
{!!HTML::script('js/javascript-custom.js')!!}
</head>
<body id="app-layout">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">

				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>

				<!-- Branding Image -->
				<a class="navbar-brand" href="{{ url('/') }}">Cambodian Job</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
					@if(Auth::check() && Auth::user()->user_role==2)
						<li><a href="{{route('job.list')}}" >My Jobs</a></li>
					@endif
					@if(!Auth::guest() && Auth::user()->user_role==1)
						<li><a href="{{ route('user.list') }}">User Management</a></li>
						<li><a href="{{ route('job.list') }}">Job</a></li>
					@endif
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@if(Auth::guest())
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ route('user.register') }}">Register</a></li> 
					@else
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-expanded="false"> 
						{{Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<!--If user is emploer-->
							@if(!Auth::guest() && Auth::user()->user_role==2)
								<li><a href="{{ route('user.profile')}}"><i
										class="fa fa-btn fa-user"></i>View Company's Profile</a></li>
								<li><a href="{{ route('user.edit_profile') }}"><i
									class="fa fa-btn fa-edit"></i> Update Company's Profile</a></li>
								<li><a href="{{ route('user.change_password') }}"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							@endif 
							@if(!Auth::guest() && Auth::user()->user_role==3)
							<!-- If user is employee -->
								<li><a href="{{ route('user.profile')}}"><i
										class="fa fa-btn fa-user"></i> My Profile & CV</a></li>
								<li><a href="{{ route('user.edit_profile') }}"><i
										class="fa fa-btn fa-edit"></i> Update Profile</a></li>
								<li><a href="{{ route('user.change_password') }}"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							@endif
							@if(!Auth::guest() && Auth::user()->user_role==1)
								<li><a href="{{ route('user.profile')}}"><i
									class="fa fa-btn fa-user"></i> My Profile</a></li>
								<li><a href="{{ route('user.edit_profile') }}"><i
										class="fa fa-btn fa-edit"></i> Update Profile</a></li>
								<li><a href="{{ route('user.change_password') }}"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							@endif
							<li><a href="{{ url('/logout') }}"><i
									class="fa fa-btn fa-sign-out"></i> Logout</a></li>
						</ul></li>
						@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')
</body>
</html>
