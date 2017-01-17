@extends('layouts.admin') 
@section('title')
	Update Job
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Update Job</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<form class="form-horizontal" role="form" method="POST" action="{{ route('job.update',$job_edit->id) }}">
							{{csrf_field()}}
							<div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
								<label for="name" class="col-md-3 control-label">Job Title&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<input id="job_title" type="text" class="form-control" name="job_title"
										value="{{$job_edit->job_title}}" placeholder="Job title"> 
										@if ($errors->has('job_title')) 
											<span class="help-block"> <strong>{{ $errors->first('job_title') }}</strong>
											</span>
										@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('job_description') ? ' has-error' : '' }}">
								<label for="job_description" class="col-md-3 control-label">Job Description&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<textarea name="job_description" id="job_description" class="form-control" rows="5" cols="70" placeholder="Job Description">{{$job_edit->job_description}}</textarea>
										@if ($errors->has('job_description')) 
											<span class="help-block"> <strong>{{ $errors->first('job_description') }}</strong>
											</span>
										@endif
								</div>
							</div>
	
	
							<div class="form-group{{ $errors->has('job_requirement') ? ' has-error' : '' }}">
								<label for="job_requirement" class="col-md-3 control-label">Job Requirement&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<textarea name="job_requirement" id="job_requirement" class="form-control" rows="5" cols="70" placeholder="Job Requirement">{{$job_edit->job_requirement}}</textarea>
										@if ($errors->has('job_requirement')) 
											<span class="help-block"> <strong>{{ $errors->first('job_requirement') }}</strong>
											</span>
										@endif
								</div>
							</div>
							
							<div class="form-group{{$errors->has('job_categories') ? ' has-error' : '' }}">
								<label for="job_categories" class="col-md-3 control-label">Job Categories&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<?php 
										$array_job_categories = array(1=>'Social Work',2=>'Web Developement',3=>'Database Monitoring',5=>'Accountance',6=>'Marketing',7=>'Teacher');
										?>
									<select name="job_categories" class="form-control" id="job_categories">
										<option value="">-Select Category-</option>
										@foreach ($array_job_categories as $key=>$category)
											<option value="{{$key}}" <?php echo ($key== old('job_categories') || $job_edit->job_categories==$key)?'selected':'';?>>{{$category}}</option>
										@endforeach
									</select>
										@if ($errors->has('job_categories')) 
											<span class="help-block"> <strong>{{ $errors->first('job_categories') }}</strong>
											</span>
										@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('job_closing_date') ? ' has-error' : '' }}">
								<label for="job_closing_date" class="col-md-3 control-label">Job Closing Date&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<input id="job_closing_date" type="text" class="form-control" name="job_closing_date"
										value="{{$job_edit->job_closing_date}}" > 
										@if ($errors->has('job_closing_date')) 
											<span class="help-block"> <strong>{{ $errors->first('job_closing_date') }}</strong>
											</span>
										@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('job_priority') ? ' has-error' : '' }}">
								<label for="job_priority" class="col-md-3 control-label">Job Priority&nbsp;<span
									class="required">*</span></label>
	
								<div class="col-md-9">
									<?php 
										$job_priority = array(0=>'Normal',1=>'Urgent');
									?>
									<select name="job_priority" class="form-control" id="job_categories">
										<option value="">-Select Priority-</option>
										@foreach ($job_priority as $key=>$priority)
										<option value="{{$key}}" <?php echo ($key==old('job_priority') || $job_edit->job_priority==$key)?'selected':'';?>>{{$priority}}</option>
										@endforeach
									</select>
										@if ($errors->has('job_priority')) 
											<span class="help-block"> <strong>{{ $errors->first('job_priority') }}</strong>
											</span>
										@endif
								</div>
							</div>
	
	
							<div class="form-group">
								<div class="col-md-3 col-md-offset-4">
									<a class="btn btn-danger btn-sm" href="{{route('job.list')}}">Back</a>
									<button type="submit" class="btn btn-primary btn-sm pull-right"
										id="btn-post-job" name="btn-update-job">
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
@endsection
