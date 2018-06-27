<div class="tab-pane" id="term">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						{!! Form::label('term_code', trans('Term Code'), ['class' => 'control-label']) !!}
						{!! Form::text('term_code', null, [ 'class' => 'form-control', 'placeholder' => 'Input a Term Code' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('invoice_due_date_calculation', trans('Invoice Due Date Calculation'), ['class' => 'control-label']) !!}
						{!! Form::text('invoice_due_date_calculation', null, [ 'class' => 'form-control', 'placeholder' => 'Input a Invoice Due Date Calculation' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('credit_days', trans('Credit Days'), ['class' => 'control-label']) !!}
						{!! Form::number('credit_days', null, [ 'class' => 'form-control', 'placeholder' => 'Credit Days' ]) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
