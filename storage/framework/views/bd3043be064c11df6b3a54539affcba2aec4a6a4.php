 
<?php $__env->startSection('title'); ?>
Jobs list
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
	span.alert{
		padding:5px;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
		if (Session::has ( 'success' )) {
			$class = 'alert-success';
			$message_title = 'Successful!';
		} else {
			$class = 'alert-danger';
			$message_title = 'Successful!';
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
		<div class="panel panel-primary">
			<div class="panel-heading">
				<i class="fa fa-list"></i>
				Jobs List
				&nbsp;<span class="badge"><?php echo e(count($job_list)); ?></span>
				<?php if(Auth::user()->status==0): ?>
					<span class="alert alert-warning"><strong>Alert!</strong> Account is disabled. Please check your email and verify or contact to adminstrator to enable your account before you can post your jobs.</span>
				<?php endif; ?>
				<a href="<?php echo e(route('job.post')); ?>" class="text-right btn btn-primary btn-xs pull-right" <?php echo (Auth::user()->status==0)?'disabled':''; ?> > <span class="glyphicon glyphicon-plus"></span> Post Job</a>
				
			</div>
			<div class="panel-body">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Job Title</th>
									<th>Job Poster</th>
									<th>Job Category</th>
									<th width="20%">Job Description</th>
									<th>Job Closing Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
	
							<tbody>
								<?php if(count($job_list)): ?>
									<?php foreach($job_list as $list): ?>
										<tr>
											<?php 
											$array_job_categories = array(1=>'Social Work',2=>'Web Developement',3=>'Database Monitoring',5=>'Accountance',6=>'Marketing',7=>'Teacher');
											?>
											<td><?php echo e($list->job_title); ?></td>
											<td><a href="<?php echo e(route('job.detail',$list->id)); ?>"><?php echo e($list->company_name); ?></a></td>
											<td><span class="btn btn-success btn-xs"><?php echo e($array_job_categories[$list->job_categories]); ?></span></td>
											<td><?php echo e($list->job_description); ?></td>
											<td><?php echo e($list->job_closing_date); ?></td>
											<?php 
					    					$class_status = 'disabled';
					    					$class_icon = 'glyphicon-remove-sign';
					    					$title_status = 'Click here to enable this user.';
					    					if($list->job_status==1){
					    						$class_status = 'enabled';
					    						$class_icon = 'glyphicon-ok-sign';
					    						$title_status = 'Click here to disable this user.';
					    					}
					    					?>
					    					<td><a href="<?php echo e(route('job.update_status',[$list->id,$list->job_status])); ?>" title="<?php echo e(@$title_status); ?>" alt="<?php echo e($title_status); ?>" ><span class="glyphicon <?php echo e($class_icon); ?> btn <?php echo e($class_status); ?>"></span></a></td>
											<td>
												<a href="<?php echo e(route('job.edit',$list->id)); ?>" class="link" title="Click here to edit this record."  alt="Click here to edit this record." ><i class="fa fa-edit"></i></a>&nbsp;
												<a class="link" href="<?php echo e(route('job.delete',$list->id)); ?>" onclick="return confirm('Are you sure you want to delete this item?');" title="Click here to delete this record." alt="Click here to delete this record." ><i class="fa fa-trash-o"></i></a></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td class="text-center" colspan="8"><p>No Job added yet.</p></td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if(count($job_list)): ?>
			<div class="panel-footer">
				<div id="pagination" class="col-md-8 col-md-offset-2 text-center">
					<?php echo e($job_list->links()); ?>

				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<style>
 	span.disabled{
 		color:#d9534f;
 	} 
 	span.enabled{color:#337ab7;}                  
 </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>