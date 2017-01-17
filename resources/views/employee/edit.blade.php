<form class="form-horizontal" role="form" method="POST" action="{{ route('education.update',$data->id) }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
		<label for="school" class="col-md-2 control-label">University</label>
	
		<div class="col-md-10">
			<input id="school" type="text" class="form-control" name="school"
				value="{{ $data->school}}" required> @if ($errors->has('school')) <span
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
							?>
							<option value="{{$year}}" <?php echo $data->start_year == $year?'selected':''?>>{{$year}}</option>
							<?php 
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
							?>
							<option value="{{$year}}" <?php echo $data->finish_year == $year?'selected':''?>>{{$year}}</option>
							<?php 
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
				<input id="major" type="text" class="form-control" name="major" required value="{{$data->major}}"> 
				@if ($errors->has('major'))
					<span class="help-block">
						<strong>{{ $errors->first('major') }}</strong>
					</span>
				@endif
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