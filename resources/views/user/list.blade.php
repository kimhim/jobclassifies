@extends('layouts.admin')
@section('title')
Employees List
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<?php 
		if(Session::has('success')){
			$class='alert-success';
			$message_title = 'Successful!';
		}else{
			$class='alert-danger';
			$message_title = 'Successful!';
		}
		?>
			@if(Session::has('message'))
	          	<div id="login-alert"
					class="alert {{$class}} col-sm-12" style="margin-bottom:10px;padding:5px;">
				     <button type="button" class="close" style="color:#d9534f;opacity:1;" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
	               <span class="glyphicon glyphicon-ok"></span> <strong>{{$message_title}}</strong>
	                <hr class="message-inner-separator">
	                <p class="text-center">{{Session::get('message')}}</p>
				</div>
			@endif
		</div>
	</div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title col-md-6"><i class="fa fa-btn fa-list"></i>  EMPLOYEES LIST <span class="badge">{{count($user_list)}}</span></h3>
					<a class="text-right btn btn-primary btn-xs pull-right" href="{{route('user.register')}}"><i class="fa fa-btn fa-plus"></i> Register</a>
				</div>
				<div class="panel-body">
					<div class="table table-responsive"> 
			    		<table class="table table-bordered table-hover user-list">
			    			<thead>
			    				<tr>
			    					<th>Avatar</th>
			    					<th>Full name</th>
			    					<th>Email</th>
			    					<th>Phone</th>
			    					<th style="width:20%">Address</th>
			    					<th>Role Type</th>
			    					<th>Status</th>
			    					<th>Action</th>
			    				</tr>
			    			</thead>
			    			
			    			<tbody>
			    			@if(count($user_list))
			    				@foreach($user_list as $list)
		        					<tr>
				    					<td><img src="{{asset('images/avatars/thumbnail/'.$list->avatar)}}" class="img-responsive" style="max-height:60px;margin:0 auto;" /></td>
				    					<td>{{$list->name}}</td>
				    					<td>{{$list->email}}</td>
				    					<td>{{$list->phone}}</td>
				    					<td>{{$list->address}}</td>
				    					<td>
				    					@if($list->user_role==2)
				    						<span class="label label-danger"><i class="fa fa-user"></i> {{@$list->title}}</span>
				    					@else
				    						<span class="label label-warning"><i class="fa fa-user"></i> {{@$list->title}}</span>
				    					@endif
				    					</td>
				    					<?php 
				    					$class_status = 'disabled';
				    					$class_icon = 'glyphicon-remove-sign';
				    					$title_status = 'Click here to enable this user.';
				    					if($list->status==1){
				    						$class_status = 'enabled';
				    						$class_icon = 'glyphicon-ok-sign';
				    						$title_status = 'Click here to disable this user.';
				    					}
				    					?>
				    					<td><a href="{{route('user.update_status',[$list->id,$list->status])}}" title="{{@$title_status}}" alt="{{$title_status}}" ><span class="glyphicon {{$class_icon}} btn {{$class_status}}"></span></a></td>
				    					<td>
				    						<a  class="link" href="{{route('user.edit',$list->id)}}"><i class="fa fa-edit"></i></a>
				    						<a class="link" href="{{route('user.delete',$list->id)}}" onclick="return confirm('Are you sure you want to delete this item?');">
				    							<i class="fa fa-trash-o"></i></a>
				    					</td>
				    				</tr>
								@endforeach
							@endif
			    			</tbody>
			    		</table>
	    			</div>
				</div>
				@if(count($user_list))
					<div class="panel-footer">
						<div id="pagination" class="col-md-8 col-md-offset-2 text-center">
							{{$user_list->links()}}
						</div>
					</div>
				@endif
			</div>
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