<div class="tab-pane" id="hotelproperty">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('room_capacity', trans('room capacity'), ['class' => 'control-label']) !!}
				{!! Form::text('room_capacity', old('room_capacity') , [ 'class' => 'form-control', 'placeholder' => 'room capacity' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('suite_number', trans('suite number'), ['class' => 'control-label']) !!}
				{!! Form::text('suite_number', null, [ 'class' => 'form-control', 'placeholder' => 'suite number' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('number_of_floors', trans('number of floors'), ['class' => 'control-label']) !!}
				{!! Form::text('number_of_floors', null, [ 'class' => 'form-control', 'placeholder' => 'number of floors' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('non_smooking_room', trans('non smooking room'), ['class' => 'control-label']) !!}
				{!! Form::select('non_smooking_room', ['1' => 'Yes', '0' => 'No'], old('non_smooking_room'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('number_of_meeting_room', trans('number of meeting_room'), ['class' => 'control-label']) !!}
				{!! Form::number('number_of_meeting_room', null, [ 'class' => 'form-control', 'placeholder' => 'number of meeting room' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('max_capacity', trans('max capacity'), ['class' => 'control-label']) !!}
				{!! Form::number('max_capacity', null, [ 'class' => 'form-control', 'placeholder' => 'max capacity' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('property_type', trans('property type'), ['class' => 'control-label']) !!}
				{!! Form::select('property_type', @propertytype(), old('property_type'), ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>
</div>