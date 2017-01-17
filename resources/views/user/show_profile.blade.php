@extends('layouts.admin') @section('title') User Profile @endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php
		if (Session::get ( 'success' )) {
			$class = 'alert-success';
			$message_title = 'Successful!';
		} else {
			$class = 'alert-danger';
			$message_title = 'Fail!';
		}
		?>
			@if(Session::has('message'))
	          	<div id="login-alert" class="alert {{$class}} col-sm-12"
				style="margin-bottom: 10px; padding: 5px;">
				<i class="fa fa-check"></i>
				<button type="button" class="close"
					style="color: #d9534f; opacity: 1;" data-dismiss="alert"
					aria-hidden="true">
					<i class="fa fa-times-circle"></i>
				</button>
				<strong>{{$message_title}}</strong>
				<hr class="message-inner-separator">
				<p class="text-center">{{Session::get('message')}}</p>
			</div>
			@endif
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">User's Profile</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<tr>
								<td><strong>Name : </strong></td>
								<td>{{$user->name}}</td>
							</tr>
							<tr>
								<td><strong>Email : </strong></td>
								<td width="50%">{{$user->email}}</td>
							</tr>
							<tr>
								<td><strong>Role : </strong></td>
								<td><span class="label label-warning">{{$user_role[0]->title}}</span></td>
							</tr>
							<tr>
								<td><strong>Updated: </strong></td>
								<td><span class="label label-danger">{{$user->updated_at}}</span></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if(Auth::user()->user_role !=3)
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">COMPANY INFORMATION</h3>
					<span class="pull-right clickable"><i
						class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2 pull-right">
							<img src="{{asset('images/avatars/thumbnail/'.$company_profile->avatar)}}"
								alt="" title="" class="img-responsive img-thumbnail"
								style="height: 150px;" />
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<strong>Company Name : </strong>
						</div>
						<div class="col-md-3">
							<strong>{{$company_profile->name}}</strong>
						</div>
					</div>
					<br />
						<div class="row">
						<div class="col-md-4">
							<strong>Email: </strong>
						</div>
						<div class="col-md-3">
							{{$company_profile->email}}
						</div>
					</div>
					<br />
						<div class="row">
						<div class="col-md-4">
							<strong>Role: </strong>
						</div>
						<div class="col-md-3">
							<span class="label label-warning">{{$company_profile->title}}</span>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-6">
							<strong>Company Description : </strong>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">{{$company_profile->description}}</div>
					</div>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">COMPANY'S JOBS</h3>
					<span class="pull-right clickable"><i
						class="glyphicon glyphicon-chevron-up"></i></span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<tbody>
										@if(count($job_of_company)) @foreach($job_of_company as $list)
										<tr>
											<td><a href="{{route('job.detail',$list->id)}}">{{$list->job_title}}
											</a>(Dateline {{$list->job_closing_date}})</td>
										</tr>
										@endforeach @else
										<tr>
											<td><p>No job added</p></td>
										</tr>
										@endif
									</tbody>
								</table>
								<div class="col-md-10 col-md-offset-1">
									@if(count($job_of_company)) {{$job_of_company->links()}} @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif @if(Auth::user()->user_role==3)
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<strong>MY PERSIONAL CURRICULUMN VITAE</strong>
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h2 class="resume-main-title text-center">CURRICULUMN VITAE</h2>
						</div>
					</div>
					<div class="col-md-12">
						<h3 class="resume-title">PERSIONAL INFORMATION</h3>
						<img src="/images/avatars/{{$user->avatar}}"
							class="img-responsive img-thumbnail"
							style="width: 113px; height: 150px; position: absolute; right: 0; top: 0;" />
						<ul type="none" class="personal-info">
							<li>- Full name : {{$user->name}}</li>
							<li>- Sex : {{$user->sex}}</li>
							<li>- Date of birth : {{$user->dob}}</li>
							<li>- Phone : {{$user->phone}}</li>
							<li>- Email : {{$user->email}}</li>
							<li>- Address : {{$user->address}}<a
								href="{{route('user.edit_profile')}}"
								class="text-right pull-right link"><i>[Edit]</i></a></li>
						</ul>

						<h3 class="resume-title">
							EDUCATION&nbsp;&nbsp;<a href="#" data-toggle="modal"
								data-target="#modal-popup" class="text-right link add"><i>[+Add]</i></a>
						</h3>
						<ul type="none" class="personal-info">
						@if(@$education)
							@foreach($education as $list)
							<li>- {{$list->school}} ({{$list->start_year}}-{{$list->finish_year}})
								<span class="pull-right edit-delete">
									<a href="#" data-toggle="modal" data-target="#modal-popup-edit"  class="text-right link editable" id="{{$list->id}}">Edit</a>&nbsp;/&nbsp;
									<a href="{{route('education.delete',$list->id)}}"  class="text-right link" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
								</span>
							</li>
							<li>&nbsp;&nbsp;{{$list->major}}<br />
							<br /></li>
							@endforeach
						@else
							<li>No education added yet.</li>
						@endif
						</ul>

						<h3 class="resume-title">
							WORK EXPERIENCE&nbsp;&nbsp;<a href="#" data-toggle="modal"
								data-target="#modal-popup-add-work-experience" class="text-right link add add-work-experience"><i>[+Add]</i></a>
						</h3>
						<ul type="none" class="personal-info">
						@if(count($work_experience))
							@foreach($work_experience as $list)
							<li>- {{$list->company_name}}
								({{date("M-Y",strtotime($list->start_date))}} -
								@if($list->finish_date!='Present'){{date("M-Y",strtotime($list->finish_date))}}@else
								{{$list->finish_date}} @endif) <span
								class="pull-right edit-delete">
								<a href="#" data-toggle="modal" data-target="#modal-popup-edit-work-experience" class="text-right link editwork-experience" id="{{$list->id}}">Edit</a>&nbsp;/&nbsp;
								<a href="{{route('work-experience.delete',$list->id)}}"
									class="text-right link" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></span>
							</li>
							<li>&nbsp;&nbsp;{{$list->position}}<br />
							<br /></li>
							@endforeach
						@else
							<li><p>No work experience added yet.</p></li>
						@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>


<!-- Modal add-->
<div class="modal fade" id="modal-popup" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"
				style="padding: 5px; background-color: #337ab7; color: #fff;">
				<span class="modal-title">Add your background education</span>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('education.save') }}">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
							<label for="school" class="col-md-2 control-label">University</label>

							<div class="col-md-10">
								<input id="school" type="text" class="form-control" name="school"
									value="{{ old('school')}}" required> @if ($errors->has('school')) <span
									class="help-block"> <strong>{{ $errors->first('school') }}</strong>
								</span> @endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group{{ $errors->has('start_year') ? ' has-error' : '' }}">
								<label for="start_year" class="col-md-5 control-label">From Year</label>
	
								<div class="col-md-7">
									<?php 
										$year = date("Y");
										$start_year = '1990';
									?>
									<select id="start_year" class="form-control" required name="start_year">
										<?php 
											for($year;$year>=$start_year;$year--){
												echo '<option value='.$year.'>'.$year.'</option>';	
											}
										?>
									</select>
									@if ($errors->has('start_year')) 
										<span class="help-block">
											<strong>{{ $errors->first('start_year') }}</strong>
										</span> 
									@endif
								</div>
							</div>
							<div class="col-md-6 form-group{{ $errors->has('finish_year') ? ' has-error' : '' }}">
								<label for="finish_year" class="col-md-4 control-label">To Year</label>
	
								<div class="col-md-8">
									<select id="finish_year"  required class="form-control" name="finish_year"> 
										<?php 
											$year = date("Y");
											$start_year = '1990';
											for($year;$year>=$start_year;$year--){
												echo '<option value='.$year.'>'.$year.'</option>';	
											}
										?>
									</select>
										@if ($errors->has('finish_year')) 
										<span class="help-block">
											<strong>
												{{ $errors->first('finish_year') }}
											</strong>
										</span> 
										@endif
								</div>
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
							<label for="major" class="col-md-2 control-label">Marjoring</label>

							<div class="col-md-10">
								<input id="major" type="text" class="form-control" name="major" required> 
								@if ($errors->has('major')) 
									<span class="help-block">
										<strong>{{ $errors->first('major') }}</strong>
									</span>
								@endif
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
				</div>

			</div>
		</div>
	</div>
</div>

<!-- =========Modal popup for add work experience======= -->

<!-- Modal add-->
<div class="modal fade" id="modal-popup-add-work-experience" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"
				style="padding: 5px; background-color: #337ab7; color: #fff;">
				<span class="modal-title">Add your work experience</span>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('work-experience.save') }}">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
							<label for="company_name" class="col-md-2 control-label">Company</label>

							<div class="col-md-10">
								<input id="company_name" type="text" class="form-control" name="company_name"
									value="{{ old('company_name')}}" required> @if ($errors->has('company_name')) <span
									class="help-block"> <strong>{{ $errors->first('company_name') }}</strong>
								</span> @endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
								<label for="start_date" class="col-md-5 control-label">From</label>
	
								<div class="col-md-7">
									<input type="text" class="from-date form-control" name="start_date" required/>
									@if ($errors->has('start_date')) 
										<span class="help-block">
											<strong>{{ $errors->first('start_date') }}</strong>
										</span> 
									@endif
								</div>
							</div>
							<div class="col-md-6 form-group{{ $errors->has('finish_date') ? ' has-error' : '' }}">
								<label for="finish_date" class="col-md-4 control-label">To</label>
	
								<div class="col-md-8">
									<input type="text" class="to-date form-control" name="finish_date" required style="display:block;"/>
										@if ($errors->has('finish_date')) 
										<span class="help-block">
											<strong>
												{{ $errors->first('finish_date') }}
											</strong>
										</span> 
									@endif
								</div>
							</div>
						</div>
						
						<div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
							<label for="position" class="col-md-2 control-label">Positions</label>

							<div class="col-md-10">
								<input id="position" type="text" class="form-control" name="position" required> 
								@if ($errors->has('position')) 
									<span class="help-block">
										<strong>{{ $errors->first('position') }}</strong>
									</span>
								@endif
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
				</div>

			</div>
		</div>
	</div>
</div>


<!-- Modal Edit education-->
<div class="modal fade" id="modal-popup-edit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"
				style="padding: 5px; background-color: #337ab7; color: #fff;">
				<span class="modal-title">Update</span>
				<button type="button" class="close" data-dismiss="modal"  style="color:red;">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12 update-education">
				</div>

			</div>
		</div>
	</div>
</div>
<!-- Modal Edit work experience-->
<div class="modal fade" id="modal-popup-edit-work-experience" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"
				style="padding: 5px; background-color: #337ab7; color: #fff;">
				<span class="modal-title">Update</span>
				<button type="button" class="close" data-dismiss="modal"  style="color:red;">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12 update-workd-experience">
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

th.label-primary {
	color: #fff;
}

.clickable {
	cursor: pointer;
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}

.modal-body {
	overflow: hidden;
}
</style>
<script>
	jQuery(document).ready(function(){
		//=========Edit Education background=======
		jQuery('.editable').click(function(){
			var id = $(this).attr('id');
			$.ajax({
		        method: 'GET',
		        url:'{{route("education.edit")}}',
		        data: {
		            education_id : id
		         },
		         success: function(response) {
					  jQuery(".update-education").html(response);
				},
			    error: function(x, t, m) {
			        if(t==="timeout") {
			            alert("got timeout");
			        } else {
			            alert(m);
			        }
			    }
		    });
		});

		//============Edit Work Experience===========

		jQuery('.editwork-experience').click(function(){
			var id = $(this).attr('id');
			$.ajax({
		        method: 'GET',
		        url:'{{route("work-experience.edit")}}',
		        data: {
		            work_experience_id : id
		         },
		         success: function(response) {
			         //alert(response);
					 jQuery(".update-workd-experience").html(response);
				},
			    error: function(x, t, m) {
			        if(t==="timeout") {
			            alert("got timeout");
			        } else {
			            alert(m);
			        }
			    }
		    });
		});
	});

	$('.modal-content').resizable({
	    //alsoResize: ".modal-dialog",
	    minHeight: 300,
	    minWidth: 300
	});
	$('.modal-dialog').draggable();

	$('#modal-popup-edit').on('show.bs.modal', function () {
	    $(this).find('.modal-body').css({
	        'max-height':'100%'
	    });
	});

	$(".from-date,.to-date").datepicker({
		format: "M-yyyy",
	    viewMode: "months", 
	    minViewMode: "months",
	    autoclose:true
	});
</script>

@endsection
