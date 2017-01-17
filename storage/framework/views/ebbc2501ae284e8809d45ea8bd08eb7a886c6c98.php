<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $__env->yieldContent('title'); ?></title>
<?php echo Html::style('css/bootstrap.min.css'); ?>

<?php echo Html::style('css/jquery-ui.css'); ?> 
<?php echo HTML::style('css/bootstrap-toggle.css'); ?>

<?php echo HTML::style('css/bootstrap-datepicker.min.css'); ?>

<?php echo HTML::style('css/font-awesome.min.css'); ?>

<?php echo HTML::style('css/custom-style.css'); ?>

<?php echo HTML::script('js/jquery.js'); ?>

<?php echo HTML::script('js/bootstrap.min.js'); ?>

<?php echo HTML::script('js/jquery-ui.min.js'); ?>

<?php echo HTML::script('js/bootstrap-toggle.js'); ?>

<?php echo HTML::script('js/bootstrap-datepicker.min.js'); ?>

<?php echo HTML::script('js/jquery-custom.js'); ?>

<?php echo HTML::script('js/javascript-custom.js'); ?>

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
				<a class="navbar-brand" href="<?php echo e(url('/')); ?>">Cambodian Job</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					<li><a href="<?php echo e(url('/')); ?>">Home</a></li>
					<?php if(Auth::check() && Auth::user()->user_role==2): ?>
						<li><a href="<?php echo e(route('job.list')); ?>" >My Jobs</a></li>
					<?php endif; ?>
					<?php if(!Auth::guest() && Auth::user()->user_role==1): ?>
						<li><a href="<?php echo e(route('user.list')); ?>">User Management</a></li>
						<li><a href="<?php echo e(route('job.list')); ?>">Job</a></li>
					<?php endif; ?>
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					<?php if(Auth::guest()): ?>
						<li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
						<li><a href="<?php echo e(route('user.register')); ?>">Register</a></li> 
					<?php else: ?>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" role="button" aria-expanded="false"> 
						<?php echo e(Auth::user()->name); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<!--If user is emploer-->
							<?php if(!Auth::guest() && Auth::user()->user_role==2): ?>
								<li><a href="<?php echo e(route('user.profile')); ?>"><i
										class="fa fa-btn fa-user"></i>View Company's Profile</a></li>
								<li><a href="<?php echo e(route('user.edit_profile')); ?>"><i
									class="fa fa-btn fa-edit"></i> Update Company's Profile</a></li>
								<li><a href="<?php echo e(route('user.change_password')); ?>"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							<?php endif; ?> 
							<?php if(!Auth::guest() && Auth::user()->user_role==3): ?>
							<!-- If user is employee -->
								<li><a href="<?php echo e(route('user.profile')); ?>"><i
										class="fa fa-btn fa-user"></i> My Profile & CV</a></li>
								<li><a href="<?php echo e(route('user.edit_profile')); ?>"><i
										class="fa fa-btn fa-edit"></i> Update Profile</a></li>
								<li><a href="<?php echo e(route('user.change_password')); ?>"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							<?php endif; ?>
							<?php if(!Auth::guest() && Auth::user()->user_role==1): ?>
								<li><a href="<?php echo e(route('user.profile')); ?>"><i
									class="fa fa-btn fa-user"></i> My Profile</a></li>
								<li><a href="<?php echo e(route('user.edit_profile')); ?>"><i
										class="fa fa-btn fa-edit"></i> Update Profile</a></li>
								<li><a href="<?php echo e(route('user.change_password')); ?>"><i
									class="fa fa-btn fa-edit"></i> Change Password</a></li>
							<?php endif; ?>
							<li><a href="<?php echo e(url('/logout')); ?>"><i
									class="fa fa-btn fa-sign-out"></i> Logout</a></li>
						</ul></li>
						<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>
	<?php echo $__env->yieldContent('content'); ?>
</body>
</html>
