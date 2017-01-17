@extends('layouts.admin')
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
				<div class="panel-heading">Employer Lists</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Nº</th>
					    					<th>Avatar</th>
					    					<th>Full name</th>
					    					<th>Email</th>
					    					<th>Phone</th>
					    					<th style="width:20%">Address</th>
					    					<th>Status</th>
					    					<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if(count($employer_list))
											@foreach($employer_list as $list)
												<tr>
													<td><img src="{{asset('images/avatars/'.$list->avatar)}}" class="img-responsive" width="60"/></td>
													<td>{{$list->name}}</td>
													<td>{{$list->email}}</td>
													<td>{{$list->phone}}</td>
													<td>{{$list->address}}</td>
													<td><a href="{{route('employer.edit',$list->id)}}" class="link">Edit</a>/<a class="link" href="{{route('employer.delete',$list->id)}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					@if(count($employer_list))
					<div id="pagination" class="col-md-8 col-md-offset-2 text-center">
						{{$employer_list->links()}}
					</div>
					@else 
						<p><center style="color:red;">No employer found!</center></p>
					@endif
				</div>
			</div>
		</div>
    </div>
</div>
@endsection
