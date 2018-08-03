<div class="tab-pane" id="hotelfinance">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('deposit_type', trans('deposit type'), ['class' => 'control-label']) !!}
				{!! Form::select('deposit_type', @deposittype(), old('deposit_type'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('payment_type', trans('payment type'), ['class' => 'control-label']) !!}
				{!! Form::select('payment_type', @paymenttype(), old('deposit_type'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('credit_limit', trans('credit limit'), ['class' => 'control-label']) !!}
				{!! Form::text('credit_limit', null, [ 'class' => 'form-control', 'placeholder' => 'credit limit' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('id_credit_limit_currency', trans('credit limit currency'), ['class' => 'control-label']) !!}
				{!! Form::text('id_credit_limit_currency', null, [ 'class' => 'form-control', 'placeholder' => 'credit limit currency' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('credit_terms', trans('credit terms'), ['class' => 'control-label']) !!}
				{!! Form::number('credit_terms', null, [ 'class' => 'form-control', 'placeholder' => 'credit terms' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('bank_name_1', trans('bank name 1'), ['class' => 'control-label']) !!}
				{!! Form::text('bank_name_1', null, [ 'class' => 'form-control', 'placeholder' => 'bank name 1' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('currency_1', trans('currency 1'), ['class' => 'control-label']) !!}
				{!! Form::select('currency_1', ['' => 'Choose Currency'] + @$currencys, old('currency_1'), [ 'class' => 'form-control' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('bank_name_2', trans('bank_name_2'), ['class' => 'control-label']) !!}
				{!! Form::text('bank_name_2', null, [ 'class' => 'form-control', 'placeholder' => 'bank name 2' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('bank_account_2', trans('bank account 2'), ['class' => 'control-label']) !!}
				{!! Form::text('bank_account_2', null, [ 'class' => 'form-control', 'placeholder' => 'bank account 2' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('currency_2', trans('currency 2'), ['class' => 'control-label']) !!}
				{!! Form::select('currency_2', ['' => 'Choose Currency'] + @$currencys, old('currency_2'), [ 'class' => 'form-control' ]) !!}

			</div>
		</div>
	</div>
</div>