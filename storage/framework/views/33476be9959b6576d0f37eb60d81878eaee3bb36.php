 
<?php $__env->startSection('title'); ?>
	Posting new job
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Post New Job</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('job.save')); ?>">
							<?php echo e(csrf_field()); ?>

							<div class="form-group<?php echo e($errors->has('job_title') ? ' has-error' : ''); ?>">
								<label for="name" class="col-md-3 control-label">Job Title&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<input id="job_title" type="text" class="form-control" name="job_title"
										value="<?php echo e(old('job_title')); ?>" placeholder="Job title"> 
										<?php if($errors->has('job_title')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_title')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group<?php echo e($errors->has('job_description') ? ' has-error' : ''); ?>">
								<label for="job_description" class="col-md-3 control-label">Job Description&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<textarea name="job_description" id="job_description" class="form-control" rows="5" cols="70" placeholder="Job Description"></textarea>
										<?php if($errors->has('job_description')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_description')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
	
	
							<div class="form-group<?php echo e($errors->has('job_requirement') ? ' has-error' : ''); ?>">
								<label for="job_requirement" class="col-md-3 control-label">Job Requirement&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<textarea name="job_requirement" id="job_requirement" class="form-control" rows="5" cols="70" placeholder="Job Requirement"></textarea>
										<?php if($errors->has('job_requirement')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_requirement')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group<?php echo e($errors->has('job_categories') ? ' has-error' : ''); ?>">
								<label for="job_categories" class="col-md-3 control-label">Job Categories&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<?php 
										$array_job_categories = array(1=>'Social Work',2=>'Web Developement',3=>'Database Monitoring',5=>'Accountance',6=>'Marketing',7=>'Teacher');
										?>
									<select name="job_categories" class="form-control" id="job_categories">
										<option value="">-Select Category-</option>
										<?php foreach($array_job_categories as $key=>$category): ?>
											<option value="<?php echo e($key); ?>" <?php echo ($key==old('job_categories'))?'selected':'';?>><?php echo e($category); ?></option>
										<?php endforeach; ?>
									</select>
										<?php if($errors->has('job_categories')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_categories')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group<?php echo e($errors->has('job_closing_date') ? ' has-error' : ''); ?>">
								<label for="job_closing_date" class="col-md-3 control-label">Job Closing Date&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<input id="job_closing_date" type="text" class="form-control" name="job_closing_date"
										value="<?php echo e(old('job_closing_date')); ?>" > 
										<?php if($errors->has('job_closing_date')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_closing_date')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
							
							<div class="form-group<?php echo e($errors->has('job_priority') ? ' has-error' : ''); ?>">
								<label for="job_priority" class="col-md-3 control-label">Job Priority&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<?php 
										$job_priority = array(3=>'Normal',1=>'Urgent',2=>'Medium');
									?>
									<select name="job_priority" class="form-control" id="job_categories">
										<option value="">-Select Priority-</option>
										<?php foreach($job_priority as $key=>$priority): ?>
										<option value="<?php echo e($key); ?>" <?php echo ($key==old('job_priority'))?'selected':'';?>><?php echo e($priority); ?></option>
										<?php endforeach; ?>
									</select>
										<?php if($errors->has('job_priority')): ?> 
											<span class="help-block"> <strong><?php echo e($errors->first('job_priority')); ?></strong>
											</span>
										<?php endif; ?>
								</div>
							</div>
	
	
							<div class="form-group">
								<div class="col-md-3 col-md-offset-4">
									<a class="btn btn-danger btn-sm" href="<?php echo e(route('job.list')); ?>">Back</a>
									<button type="submit" class="btn btn-primary btn-sm pull-right"
										id="btn-post-job" name="btn-post-job">
										<i class="fa fa-btn fa-check"></i> Post
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel-footer text-center">(<span class="required">*</span>) Fields are mandatory!</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#job_closing_date").datepicker({
		format: "yyyy-mm-dd",
		//daysOfWeekDisabled: [0,6],
		//todayBtn: true,
		//clearBtn: true,
		orientation: "bottom auto",
		//daysOfWeekHighlighted: "0,6",
		//calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
		//datesDisabled: ['2016/10/29', '2016/11/11'],
		toggleActive: true
	});
	$("#job_closing_date").datepicker('setDate',new Date());
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>