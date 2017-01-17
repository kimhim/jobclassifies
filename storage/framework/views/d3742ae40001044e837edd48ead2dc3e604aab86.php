<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>My CV</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>" />
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-12">
								<h2 class="resume-main-title text-center">CURRICULUMN VITAE</h2>
							</div>
						</div>
						<div class="col-md-12">
							<h3 class="resume-title">PERSIONAL INFORMATION</h3>
							<img src="<?php echo e(asset('/images/avatars/'.$user->avatar)); ?>"
								class="img-responsive img-thumbnail"
								style="width: 113px; height: 150px; position: absolute; right: 0; top: 0;" />
							<ul type="none" class="personal-info">
								<li>- Full name : <?php echo e($user->name); ?></li>
								<li>- Sex : <?php echo e($user->sex); ?></li>
								<li>- Date of birth : <?php echo e($user->dob); ?></li>
								<li>- Phone : <?php echo e($user->phone); ?></li>
								<li>- Email : <?php echo e($user->email); ?></li>
								<li>- Address : <?php echo e($user->address); ?></li>
							</ul>
	
							<h3 class="resume-title">
								EDUCATION
							</h3>
							<ul type="none" class="personal-info">
								<?php foreach($education as $list): ?>
								<li>- <?php echo e($list->school); ?> (<?php echo e($list->start_year); ?>-<?php echo e($list->finish_year); ?>)
								</li>
								<li>&nbsp;&nbsp;<?php echo e($list->major); ?><br />
								<br /></li>
								<?php endforeach; ?>
							</ul>
	
							<h3 class="resume-title">
								WORK EXPERIENCE
							</h3>
							<ul type="none" class="personal-info">
							<?php if(count($work_experience)): ?>
								<?php foreach($work_experience as $list): ?>
								<li>- <?php echo e($list->company_name); ?>

								(
									<?php echo e(date("M-Y",strtotime($list->start_date))); ?> -
									<?php if($list->finish_date!='Present'): ?>
										<?php echo e(date("M-Y",strtotime($list->finish_date))); ?>

									<?php else: ?>
										<?php echo e($list->finish_date); ?> 
									<?php endif; ?>
								)
								</li>
								<li>&nbsp;&nbsp;<?php echo e($list->position); ?><br />
								<br /></li>
								<?php endforeach; ?>
							<?php else: ?>
								<li><p>No work experience added yet.</p></li>
							<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>