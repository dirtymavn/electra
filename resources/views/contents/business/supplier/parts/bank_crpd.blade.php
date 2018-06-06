<div class="tab-pane" id="bank_crpd">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('ac_no', trans('ac_no'), ['class' => 'control-label']) !!}
				{!! Form::text('ac_no', null, [ 'class' => 'form-control', 'placeholder' => 'Bank Code' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
				{!! Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Name' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('swift', trans('swift'), ['class' => 'control-label']) !!}
				{!! Form::text('swift', null, [ 'class' => 'form-control', 'placeholder' => 'Swift' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
				{!! Form::textarea('address', null, [ 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '2x3' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('remark', trans('remark'), ['class' => 'control-label']) !!}
				{!! Form::textarea('remark', null, [ 'class' => 'form-control', 'placeholder' => 'Remark', 'rows' => '2x3' ]) !!}
			</div>
		</div>
	</div>
</div>