<div class="tab-pane active show" id="main">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('default_payee', trans('Default Payee'), ['class' => 'control-label']) !!}
						{!! Form::text('default_payee', null, [ 'class' => 'form-control', 'placeholder' => 'Default Payee' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('services_provided', trans('Services Provided'), ['class' => 'control-label']) !!}
						{!! Form::text('service_provided', null, [ 'class' => 'form-control', 'placeholder' => 'Services Provided' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('gst_registration_no', trans('GST Registration No.'), ['class' => 'control-label']) !!}
						{!! Form::text('gst_registration_no', null, [ 'class' => 'form-control', 'placeholder' => 'GST Registration No' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('gst_id', trans('GST'), ['class' => 'control-label']) !!}
						{{-- {!! Form::text('gst_id', null, [ 'class' => 'form-control', 'placeholder' => 'gst_id' ]) !!} --}}
						<select class="form-control" name="gst_id">
							<option value="1">Option 1</option>
							<option value="2">Option 2</option>
							<option value="3">Option 3</option>
							<option value="4">Option 4</option>
							<option value="5">Option 5</option>
						</select>
					</div>
					<div class="form-group">
						{!! Form::label('interface_no', trans('Interface No.'), ['class' => 'control-label']) !!}
						{!! Form::text('interface_no', null, [ 'class' => 'form-control', 'placeholder' => 'Interface No.' ]) !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('credit_limit', trans('Credit Limit'), ['class' => 'control-label']) !!}
						{!! Form::number('credit_limit', null, [ 'class' => 'form-control', 'placeholder' => 'Credit Limit' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('credit_days', trans('Credit Days'), ['class' => 'control-label']) !!}
						{!! Form::number('credit_days', null, [ 'class' => 'form-control', 'placeholder' => 'Credit Days' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('credit_term_type', trans('Credit Term Type'), ['class' => 'control-label']) !!}
						{{-- {!! Form::number('credit_term_type', null, [ 'class' => 'form-control', 'placeholder' => 'credit_term_type' ]) !!} --}}
						<select class="form-control" name="credit_term_type">
							<option value="1">Option 1</option>
							<option value="2">Option 2</option>
							<option value="3">Option 3</option>
							<option value="4">Option 4</option>
							<option value="5">Option 5</option>
						</select>
					</div>
					<div class="form-group">
						{!! Form::label('trading_currency', trans('Trading Currency'), ['class' => 'control-label']) !!}
						{!! Form::select('trading_currency', ['' => 'Choose Currency'] + @$currencys, [ 'class' => 'form-control']) !!}
					</div>
					<div class="form-group" style="display: none;">
						{!! Form::label('xo_calculated_by', trans('XO Calculated By'), ['class' => 'control-label']) !!}
						{!! Form::text('xo_calculated_by', null, [ 'class' => 'form-control', 'placeholder' => 'XO Calculated By' ]) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
