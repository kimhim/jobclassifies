<form class="form-horizontal" role="form" method="POST" action="{{ route('work-experience.update',$data->id) }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
		<label for="company_name" class="col-md-2 control-label">Company</label>

		<div class="col-md-10">
			<input id="company_name" type="text" class="form-control" name="company_name"
				value="{{ $data->company_name}}" required> @if ($errors->has('company_name')) <span
				class="help-block"> <strong>{{ $errors->first('company_name') }}</strong>
			</span> @endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group{{ $errors->has('start_year') ? ' has-error' : '' }}">
			<label for="start_year" class="col-md-5 control-label">From</label>

			<div class="col-md-7">
				<input type="text" class="from-date form-control" name="start_date" value="{{$data->start_date}}" required />
				@if ($errors->has('start_year')) 
					<span class="help-block">
						<strong>{{ $errors->first('start_year') }}</strong>
					</span> 
				@endif
			</div>
		</div>
		<div class="col-md-6 form-group{{ $errors->has('finish_year') ? ' has-error' : '' }}">
			<label for="finish_year" class="col-md-4 control-label">To</label>

			<div class="col-md-8">
				<input type="text" class="to-date form-control" name="finish_date" value="{{$data->finish_date}}" required/>
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
		<label for="position" class="col-md-2 control-label">Positions</label>

		<div class="col-md-10">
			<input id="position" type="text" class="form-control" name="position" required value="{{$data->position}}"> 
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

<script>
$(".from-date,.to-date").datepicker({
	format: "M-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    autoclose:true
});
</script>