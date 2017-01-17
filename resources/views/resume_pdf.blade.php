<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>My CV</title>
    <link rel="stylesheet" href="{{asset('css/custom-style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-12">
								<h2 class="resume-main-title text-center">CURRICULUMN VITAE</h2>
							</div>
						</div>
						<div class="col-md-12">
							<h3 class="resume-title">PERSIONAL INFORMATION</h3>
							<img src="{{asset('/images/avatars/'.$user->avatar)}}"
								class="img-responsive img-thumbnail"
								style="width: 113px; height: 150px; position: absolute; right: 0; top: 0;" />
							<ul type="none" class="personal-info">
								<li>- Full name : {{$user->name}}</li>
								<li>- Sex : {{$user->sex}}</li>
								<li>- Date of birth : {{$user->dob}}</li>
								<li>- Phone : {{$user->phone}}</li>
								<li>- Email : {{$user->email}}</li>
								<li>- Address : {{$user->address}}</li>
							</ul>
	
							<h3 class="resume-title">
								EDUCATION
							</h3>
							<ul type="none" class="personal-info">
								@foreach($education as $list)
								<li>- {{$list->school}} ({{$list->start_year}}-{{$list->finish_year}})
								</li>
								<li>&nbsp;&nbsp;{{$list->major}}<br />
								<br /></li>
								@endforeach
							</ul>
	
							<h3 class="resume-title">
								WORK EXPERIENCE
							</h3>
							<ul type="none" class="personal-info">
							@if(count($work_experience))
								@foreach($work_experience as $list)
								<li>- {{$list->company_name}}
								(
									{{date("M-Y",strtotime($list->start_date))}} -
									@if($list->finish_date!='Present')
										{{date("M-Y",strtotime($list->finish_date))}}
									@else
										{{$list->finish_date}} 
									@endif
								)
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
		</div>
	</div>
</div>
</body>
</html>