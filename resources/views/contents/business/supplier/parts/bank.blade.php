<div class="tab-pane" id="bank">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('bank_code', trans('Bank Code'), ['class' => 'control-label']) !!}
				{!! Form::text('bank_code', null, [ 'class' => 'form-control', 'placeholder' => 'Bank Code' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('name_bank', trans('Name'), ['class' => 'control-label']) !!}
				{!! Form::text('name_bank', null, [ 'class' => 'form-control', 'placeholder' => 'Name' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('country', trans('country'), ['class' => 'control-label']) !!}
				{!! Form::text('country', null, [ 'class' => 'form-control', 'placeholder' => 'Country' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('city', trans('city'), ['class' => 'control-label']) !!}
				{!! Form::text('city', null, [ 'class' => 'form-control', 'placeholder' => 'City' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('address_bank', trans('Address'), ['class' => 'control-label']) !!}
				{!! Form::textarea('address_bank', null, [ 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '2x3' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('remark_bank', trans('remark'), ['class' => 'control-label']) !!}
				{!! Form::textarea('remark_bank', null, [ 'class' => 'form-control', 'placeholder' => 'Remark', 'rows' => '2x3' ]) !!}
			</div>
		</div>
	</div>
</div>