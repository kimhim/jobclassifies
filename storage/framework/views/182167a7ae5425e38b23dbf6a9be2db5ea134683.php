<?php $__env->startSection('title'); ?>
Welcome to Cambodian Job Page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
		if (Session::get( 'success' )==true) {
			$class = 'alert-success';
			$message_title = 'Successful!';
		} else {
			$class = 'alert-danger';
			$message_title = 'Notice!';
		}
		?>
			<?php if(Session::has('message')): ?>
	          	<div id="login-alert" class="alert <?php echo e($class); ?> col-sm-12"
				style="margin-bottom: 10px; padding: 5px;">
				<button type="button" class="close"
					style="color: #d9534f; opacity: 1;" data-dismiss="alert"
					aria-hidden="true">
					<i class="fa fa-times-circle"></i>
				</button>
				<span class="glyphicon glyphicon-ok"></span> <strong><?php echo e($message_title); ?></strong>
				<hr class="message-inner-separator">
				<p class="text-center"><?php echo e(Session::get('message')); ?></p>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">Jobs Available</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="30%">Job Title</th>
											<th width="20%">Company</th>
											<th width="30%">Description</th>
											<th width="10%">Closing Date</th>
										</tr>
									</thead>
									<tbody>
										<?php if(count($jobs_list)): ?>
											<?php foreach($jobs_list as $jobs): ?>
												<tr>
													<?php 
													$job_priority = array(0=>'Normal',1=>'Urgent');
													$label = '';
													if($jobs->job_priority==1){
														$label = 'label-danger';
													}
													?>
													<td><a href="<?php echo e(route('job.detail',$jobs->id)); ?>"><?php echo e($jobs->job_title); ?></a>&nbsp;<span class="label <?php echo e($label); ?> pull-right"><?php echo e($job_priority[$jobs->job_priority]); ?></span></td>
													<td><a href="<?php echo e(route('company.view',$jobs->user_id)); ?>" ><?php echo e($jobs->name); ?></a></td>
													<td><?php echo e($jobs->job_description); ?></td>
													<td><?php echo e($jobs->job_closing_date); ?></td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<?php if(count($jobs_list)): ?>
					<div id="pagination" class="col-md-8 col-md-offset-2 text-center">
						<?php echo e($jobs_list->links()); ?>

					</div>
					<?php else: ?> 
						<p><center style="color:red;">No Job posted yet.</center></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- ==========Latest Jobs====== -->
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Latest Jobs</div>
				<div class="panel-body">
					<div clas="col-md-12">
						<table class="table table-bordered table-hover">
							<?php if(count($lastest_job)): ?>
								<?php foreach($lastest_job as $latest_jobs): ?>
									<tr>
										<?php 
										$job_priority = array(0=>'Normal',1=>'Urgent');
										$label = '';
										if($latest_jobs->job_priority==1){
											$label = 'label-danger';
										}
										?>
										<td><a href="<?php echo e(route('job.detail',$jobs->id)); ?>"><?php echo e($latest_jobs->job_title); ?></a>&nbsp;<span class="label <?php echo e($label); ?> pull-right"><?php echo e($job_priority[$latest_jobs->job_priority]); ?></span></td>
									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<p style="color:red;">No Job posted yet.</p>
							<?php endif; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	table.table tr td,table.table tr th{
		text-align: left;
	}
	span.label-danger{
		text-decoration: blink;
	}						
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>