@extends('layouts.admin') 
@section('title')
Jobs list
@endsection
@section('content')
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
			@if(Session::has('message'))
	          	<div id="login-alert" class="alert {{$class}} col-sm-12"
				style="margin-bottom: 10px; padding: 5px;">
				<button type="button" class="close"
					style="color: #d9534f; opacity: 1;" data-dismiss="alert"
					aria-hidden="true">
					<i class="fa fa-times-circle"></i>
				</button>
				<span class="glyphicon glyphicon-ok"></span> <strong>{{$message_title}}</strong>
				<hr class="message-inner-separator">
				<p class="text-center">{{Session::get('message')}}</p>
			</div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<i class="fa fa-list"></i>
				Jobs List
				&nbsp;<span class="badge">{{count($job_list)}}</span>
				@if(Auth::user()->status==0)
					<span class="alert alert-warning"><strong>Alert!</strong> Account is disabled. Please check your email and verify or contact to adminstrator to enable your account before you can post your jobs.</span>
				@endif
				<a href="{{route('job.post')}}" class="text-right btn btn-primary btn-xs pull-right" <?php echo (Auth::user()->status==0)?'disabled':''; ?> > <span class="glyphicon glyphicon-plus"></span> Post Job</a>
				
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
								@if(count($job_list))
									@foreach($job_list as $list)
										<tr>
											<?php 
											$array_job_categories = array(1=>'Social Work',2=>'Web Developement',3=>'Database Monitoring',5=>'Accountance',6=>'Marketing',7=>'Teacher');
											?>
											<td>{{$list->job_title}}</td>
											<td><a href="{{route('job.detail',$list->id)}}">{{$list->company_name}}</a></td>
											<td><span class="btn btn-success btn-xs">{{$array_job_categories[$list->job_categories]}}</span></td>
											<td>{{$list->job_description}}</td>
											<td>{{$list->job_closing_date}}</td>
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
					    					<td><a href="{{route('job.update_status',[$list->id,$list->job_status])}}" title="{{@$title_status}}" alt="{{$title_status}}" ><span class="glyphicon {{$class_icon}} btn {{$class_status}}"></span></a></td>
											<td>
												<a href="{{route('job.edit',$list->id)}}" class="link" title="Click here to edit this record."  alt="Click here to edit this record." ><i class="fa fa-edit"></i></a>&nbsp;
												<a class="link" href="{{route('job.delete',$list->id)}}" onclick="return confirm('Are you sure you want to delete this item?');" title="Click here to delete this record." alt="Click here to delete this record." ><i class="fa fa-trash-o"></i></a></td>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="text-center" colspan="8"><p>No Job added yet.</p></td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
			@if(count($job_list))
			<div class="panel-footer">
				<div id="pagination" class="col-md-8 col-md-offset-2 text-center">
					{{$job_list->links()}}
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
<style>
 	span.disabled{
 		color:#d9534f;
 	} 
 	span.enabled{color:#337ab7;}                  
 </style>
@endsection
