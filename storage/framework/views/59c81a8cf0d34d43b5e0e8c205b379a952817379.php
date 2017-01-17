<form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('education.update',$data->id)); ?>">
	<?php echo e(csrf_field()); ?>

	<div class="form-group<?php echo e($errors->has('school') ? ' has-error' : ''); ?>">
		<label for="school" class="col-md-2 control-label">University</label>
	
		<div class="col-md-10">
			<input id="school" type="text" class="form-control" name="school"
				value="<?php echo e($data->school); ?>" required> <?php if($errors->has('school')): ?> <span
				class="help-block"> <strong><?php echo e($errors->first('school')); ?></strong>
			</span> <?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group<?php echo e($errors->has('start_year') ? ' has-error' : ''); ?>">
			<label for="start_year" class="col-md-5 control-label">From Year</label>
	
			<div class="col-md-7">
				<?php 
					$year = date("Y");
					$start_year = '1990';
				?>
				<select id="start_year" class="form-control" required name="start_year">
					<?php 
						for($year;$year>=$start_year;$year--){
							?>
							<option value="<?php echo e($year); ?>" <?php echo $data->start_year == $year?'selected':''?>><?php echo e($year); ?></option>
							<?php 
						}
					?>
				</select>
				<?php if($errors->has('start_year')): ?> 
					<span class="help-block">
						<strong><?php echo e($errors->first('start_year')); ?></strong>
					</span> 
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-6 form-group<?php echo e($errors->has('finish_year') ? ' has-error' : ''); ?>">
			<label for="finish_year" class="col-md-4 control-label">To Year</label>
	
			<div class="col-md-8">
				<select id="finish_year"  required class="form-control" name="finish_year"> 
					<?php 
						$year = date("Y");
						$start_year = '1990';
						for($year;$year>=$start_year;$year--){
							?>
							<option value="<?php echo e($year); ?>" <?php echo $data->finish_year == $year?'selected':''?>><?php echo e($year); ?></option>
							<?php 
						}
					?>
					</select>
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
			<label for="major" class="col-md-2 control-label">Marjoring</label>
	
			<div class="col-md-10">
				<input id="major" type="text" class="form-control" name="major" required value="<?php echo e($data->major); ?>"> 
				<?php if($errors->has('major')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('major')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
		</div>
		
	
		<div class="form-group">
			<div class="col-md-8 col-md-offset-2">
				<button type="submit" class="btn btn-primary" name="btn-update">
					<i class="fa fa-btn fa-save"></i> Update
				</button>
			</div>
		</div>
	</form>