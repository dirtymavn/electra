<div class="tab-pane" id="hotelroomstype">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('room_type', trans('room type'), ['class' => 'control-label']) !!}
				{!! Form::text('room_type', null, [ 'class' => 'form-control', 'placeholder' => 'room type' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('room_description', trans('room description'), ['class' => 'control-label']) !!}
				{!! Form::text('room_description', null, [ 'class' => 'form-control', 'placeholder' => 'room description' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('bed_type', trans('bed type'), ['class' => 'control-label']) !!}
				{!! Form::text('bed_type', null, [ 'class' => 'form-control', 'placeholder' => 'bed type' ]) !!}
			</div>
		</div>
	</div>
</div>