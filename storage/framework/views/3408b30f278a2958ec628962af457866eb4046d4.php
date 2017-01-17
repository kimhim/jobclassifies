<form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('work-experience.update',$data->id)); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="form-group<?php echo e($errors->has('school') ? ' has-error' : ''); ?>">
		<label for="company_name" class="col-md-2 control-label">Company</label>

		<div class="col-md-10">
			<input id="company_name" type="text" class="form-control" name="company_name"
				value="<?php echo e($data->company_name); ?>" required> <?php if($errors->has('company_name')): ?> <span
				class="help-block"> <strong><?php echo e($errors->first('company_name')); ?></strong>
			</span> <?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group<?php echo e($errors->has('start_year') ? ' has-error' : ''); ?>">
			<label for="start_year" class="col-md-5 control-label">From</label>

			<div class="col-md-7">
				<input type="text" class="from-date form-control" name="start_date" value="<?php echo e($data->start_date); ?>" required />
				<?php if($errors->has('start_year')): ?> 
					<span class="help-block">
						<strong><?php echo e($errors->first('start_year')); ?></strong>
					</span> 
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-6 form-group<?php echo e($errors->has('finish_year') ? ' has-error' : ''); ?>">
			<label for="finish_year" class="col-md-4 control-label">To</label>

			<div class="col-md-8">
				<input type="text" class="to-date form-control" name="finish_date" value="<?php echo e($data->finish_date); ?>" required/>
					<?php if($errors->has('finish_year')): ?> 
					<span class="help-block">
						<strong>
							<?php echo e($errors->first('finish_year')); ?>

						</strong>
					</span> 
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div class="form-group<?php echo e($errors->has('major') ? ' has-error' : ''); ?>">
		<label for="position" class="col-md-2 control-label">Positions</label>

		<div class="col-md-10">
			<input id="position" type="text" class="form-control" name="position" required value="<?php echo e($data->position); ?>"> 
			<?php if($errors->has('position')): ?> 
				<span class="help-block">
					<strong><?php echo e($errors->first('position')); ?></strong>
				</span>
			<?php endif; ?>
		</div>
	</div>
	

	<div class="form-group">
		<div class="col-md-8 col-md-offset-2">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-btn fa-save"></i> Save
			</button>
		</div>
	</div>
</form>

<script>
$(".from-date,.to-date").datepicker({
	format: "M-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    autoclose:true
});
</script>