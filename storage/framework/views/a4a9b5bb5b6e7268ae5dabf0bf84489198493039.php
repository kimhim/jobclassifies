<?php $__env->startSection('title'); ?> Job Detail <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php 
		if(Session::get('success')){
			$class='alert-success';
			$message_title = 'Successful!';
		}else{
			$class='alert-danger';
			$message_title = 'Fail!';
		}
		?>
			<?php if(Session::has('message')): ?>
	          	<div id="login-alert"
					class="alert <?php echo e($class); ?> col-sm-12" style="margin-bottom:10px;padding:5px;">
				     <button type="button" class="close" style="color:#d9534f;opacity:1;" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
	               <span class="glyphicon glyphicon-ok"></span> <strong><?php echo e($message_title); ?></strong>
	                <hr class="message-inner-separator">
	                <p class="text-center"><?php echo e(Session::get('message')); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Job Detail</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td><strong>Company Name : </strong></td>
								<td><a href="<?php echo e(route('company.view',$detail_job[0]->user_id)); ?>" ><?php echo e($detail_job[0]->name); ?></a></td>
							</tr>
							<tr>
								<td><strong>Job Position : </strong></td>
								<td><?php echo e($detail_job[0]->job_title); ?></td>
							</tr>
							<tr>
								<td><strong>Job Category : </strong></td>
								<td>
								<?php 
									$array_job_categories = array(1=>'Social Work',2=>'Web Developement',3=>'Database Monitoring',5=>'Accountance',6=>'Marketing',7=>'Teacher');
								?>
									<span class="label label-warning"><?php echo e($array_job_categories[$detail_job[0]->job_categories]); ?></span>
								</td>
							</tr>
							
							<tr>
								<td><strong>Job Priority : </strong></td>
								<td>
								<?php 
									$job_priority = array(3=>'Normal',1=>'Urgent',2=>'Medium');
								?>
									<span class="label label-danger"><?php echo e($job_priority[$detail_job[0]->job_priority]); ?></span>
								</td>
							</tr>
							
							<tr>
								<td><strong>Job Closing Date : </strong></td>
								<td><?php echo e($detail_job[0]->job_closing_date); ?></td>
							</tr>
							
							<tr>
								<td><strong>Job Description : </strong></td>
								<td><?php echo e($detail_job[0]->job_description); ?></td>
							</tr>
							
							<tr>
								<td><strong>Job Requirement : </strong></td>
								<td><?php echo e($detail_job[0]->job_requirement); ?></td>
							</tr>
						</table>
						
						<h3>How to apply?</h3>
						<p>
							Interested candidate, if you want to apply to <strong class="company_name"><?php echo e($detail_job[0]->name); ?></strong>
							, Please click on <b>Apply Now!</b> on the yellow button on the right.
						</p>
						<p>
						<?php if(Auth::check() && Auth::user()->user_role ==3 && Auth::user()->status==0): ?>
						<p class="alert alert-danger"><strong>Attention!</strong> Please activate your account by clicking on a link we sent you or contact to administrator of the system to enable your account first.</p>
						<?php endif; ?>
						<?php if(Auth::check() && Auth::user()->user_role ==3): ?>
							<a href="<?php echo e(route('job.apply',$detail_job[0]->id)); ?>" <?php echo Auth::user()->status==0?"disabled":"" ?> class="btn btn-warning pull-right">Apply Now!</a>
						<?php endif; ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	div.table-responsive table tr td{
		text-align: left;
	}			
	strong.company_name{
		text-transform: uppercase;
	}					
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>