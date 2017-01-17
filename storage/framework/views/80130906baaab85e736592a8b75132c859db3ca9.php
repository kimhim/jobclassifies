 <?php $__env->startSection('title'); ?> User Profile <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Company Detail</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2 pull-right">
							<img src="<?php echo e(asset('images/avatars/'.$company_profile->avatar)); ?>"
								alt="" title="" class="img-responsive img-thumbnail"
								style="height: 150px;" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<strong>Company Name : </strong>
						</div>
						<div class="col-md-4">
							<strong><?php echo e($company_profile->name); ?></strong>
						</div>
					</div>
					<br />
						<div class="row">
						<div class="col-md-4">
							<strong>Email: </strong>
						</div>
						<div class="col-md-3">
							<?php echo e($company_profile->email); ?>

						</div>
					</div>
					<br />
						<div class="row">
						<div class="col-md-4">
							<strong>Role: </strong>
						</div>
						<div class="col-md-3">
							<span class="label label-warning"><?php echo e($company_profile->title); ?></span>
						</div>
					</div>
					<br />
					<br />
					<div class="row">
						<div class="col-md-6">
							<strong>Company Description : </strong>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12"><?php echo e($company_profile->description); ?></div>
					</div>

					<br />
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="label-default">Compnay's Jobs</th>
										</tr>
									</thead>
									
									<tbody>
										<?php foreach($job_of_compnay as $list): ?>
											<tr>
												<td><a href="<?php echo e(route('job.detail',$list->id)); ?>"><?php echo e($list->job_title); ?> </a>(Dateline <?php echo e($list->job_closing_date); ?>)</td>
											</tr>
										<?php endforeach; ?>
										<?php if(count($job_of_compnay)): ?>
											<?php echo e($job_of_compnay->links()); ?>

										<?php endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
div.table-responsive table tr td {
	text-align: left;
}

strong.company_name {
	text-transform: uppercase;
}
</style>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>