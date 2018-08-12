<div class="tab-pane" id="hotelbookingremark">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('remark', trans('Remark'), ['class' => 'control-label']) !!}
						{!! Form::text('remark', old('remark'), [ 'class' => 'form-control', 'placeholder' => 'Input the Remark' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('internal_notes', trans('Internal notes'), ['class' => 'control-label']) !!}
						{!! Form::text('internal_notes', old('internal_notes'), [ 'class' => 'form-control', 'placeholder' => 'Input the Internal notes' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('accounting_notes', trans('Accounting notes'), ['class' => 'control-label']) !!}
						{!! Form::text('accounting_notes', old('accounting_notes'), [ 'class' => 'form-control', 'placeholder' => 'Input the Accounting notes' ]) !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('cancel_notice', trans('Cancel notice'), ['class' => 'control-label']) !!}
						{!! Form::text('cancel_notice', old('cancel_notice'), [ 'class' => 'form-control', 'placeholder' => 'Input the Cancel notice' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('reference_number', trans('Reference number'), ['class' => 'control-label']) !!}
						{!! Form::text('reference_number', old('reference_number'), [ 'class' => 'form-control', 'placeholder' => 'Input the Reference number' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('tnr_number', trans('Tnr number'), ['class' => 'control-label']) !!}
						{!! Form::text('tnr_number', old('tnr_number'), [ 'class' => 'form-control', 'placeholder' => 'Input the Tnr number' ]) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>