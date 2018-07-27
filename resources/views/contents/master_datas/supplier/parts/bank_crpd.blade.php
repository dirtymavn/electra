<div class="tab-pane" id="bank_crpd">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('ac_no', trans('Ac No.'), ['class' => 'control-label']) !!}
				{!! Form::text('ac_no', null, [ 'class' => 'form-control', 'placeholder' => 'Ac No' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('name_crpd', trans('Name'), ['class' => 'control-label']) !!}
				{!! Form::text('name_crpd', null, [ 'class' => 'form-control', 'placeholder' => 'Account Name' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('swift_crpd', trans('Swift'), ['class' => 'control-label']) !!}
				{!! Form::text('swift_crpd', null, [ 'class' => 'form-control', 'placeholder' => 'Swift' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('address_crpd', trans('Address'), ['class' => 'control-label']) !!}
				{!! Form::textarea('address_crpd', null, [ 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '2x3' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('remark', trans('remark'), ['class' => 'control-label']) !!}
				{!! Form::textarea('remark_crpd', null, [ 'class' => 'form-control', 'placeholder' => 'Remark', 'rows' => '2x3' ]) !!}
			</div>
		</div>
	</div>
</div>