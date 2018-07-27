<div class="tab-pane" id="bank_detail">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						{!! Form::label('name_bank_detail', trans('Name'), ['class' => 'control-label']) !!}
						{!! Form::text('name_bank_detail', null, [ 'class' => 'form-control', 'placeholder' => 'name' ]) !!}	
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('swift_bank_detail', trans('Swift'), ['class' => 'control-label']) !!}
						{!! Form::text('swift_bank_detail', null, [ 'class' => 'form-control', 'placeholder' => 'Swift' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('bic', trans('BIC'), ['class' => 'control-label']) !!}
						{!! Form::text('bic', null, [ 'class' => 'form-control', 'placeholder' => 'BIC' ]) !!}	
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_1', trans('Acc No 1'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_1', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 1' ]) !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_1_currency', trans('Acc No 1 Currency'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_1_currency', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 1 Currency' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('iban_1', trans('Iban 1'), ['class' => 'control-label']) !!}
						{!! Form::text('iban_1', null, [ 'class' => 'form-control', 'placeholder' => 'Iban 1' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_2', trans('Acc No 2'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_2', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 2' ]) !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_2_currency', trans('Acc No 2 Currency'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_2_currency', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 2 Currency' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('iban_2', trans('Iban 2'), ['class' => 'control-label']) !!}
						{!! Form::text('iban_2', null, [ 'class' => 'form-control', 'placeholder' => 'Iban 2' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_3', trans('Acc No 3'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_3', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 3' ]) !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_3_currency', trans('Acc No 3 Currency'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_3_currency', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 3 Currency' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('iban_3', trans('Iban 3'), ['class' => 'control-label']) !!}
						{!! Form::text('iban_3', null, [ 'class' => 'form-control', 'placeholder' => 'Iban 3' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_4', trans('Acc No 4'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_4', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 4' ]) !!}
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('acc_no_4_currency', trans('Acc No 4 Currency'), ['class' => 'control-label']) !!}
						{!! Form::text('acc_no_4_currency', null, [ 'class' => 'form-control', 'placeholder' => 'Acc No 4 Currency' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						{!! Form::label('iban_4', trans('Iban 4'), ['class' => 'control-label']) !!}
						{!! Form::text('iban_4', null, [ 'class' => 'form-control', 'placeholder' => 'Iban 4' ]) !!}
					</div>
					
				</div>
				<div class="col-sm-12">
					{!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
					{!! Form::textarea('remark_bank_detail', null, [ 'class' => 'form-control', 'placeholder' => 'Remark' ]) !!}
				</div>
			</div>
		</div>
	</div>
</div>