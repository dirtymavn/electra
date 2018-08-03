<div class="tab-pane" id="hotelproperty">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('max_cancellation_days_group', trans('max cancel day group'), ['class' => 'control-label']) !!}
				{!! Form::number('max_cancellation_days_group', null, [ 'class' => 'form-control', 'placeholder' => 'room capacity' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('max_cancellation_days_fit', trans('max cancel day fit'), ['class' => 'control-label']) !!}
				{!! Form::number('max_cancellation_days_fit', null, [ 'class' => 'form-control', 'placeholder' => 'suite number' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('minimum_stay', trans('minimum stay'), ['class' => 'control-label']) !!}
				{!! Form::number('minimum_stay', null, [ 'class' => 'form-control', 'placeholder' => 'minimum stay' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('maximum_stay', trans('maximum stay'), ['class' => 'control-label']) !!}
				{!! Form::number('maximum_stay', null, [ 'class' => 'form-control', 'placeholder' => 'maximum stay' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('cancellation_charge', trans('cancellation charge'), ['class' => 'control-label']) !!}
				{!! Form::text('cancellation_charge', null, [ 'class' => 'form-control', 'placeholder' => 'cancellation charge' ]) !!}
			</div>
		</div>
	</div>
</div>