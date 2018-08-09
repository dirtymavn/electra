<div class="tab-pane" id="invoicecustomer">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
			            {!! Form::label('customer_id', trans('Customer'), ['class' => 'control-label']) !!}
			            {!! Form::select('customer_id', ['' => 'Choose Customer'] + @$customers, old('customer_id'), [ 'class' => 'form-control select2']) !!}
			        </div>
					<div class="form-group">
						{!! Form::label('customer_no', trans('Given Name'), ['class' => 'control-label']) !!}
						<!-- {!! Form::text('customer_no', null, [ 'class' => 'form-control', 'placeholder' => 'Input the Customer no' ]) !!} -->

						{!! Form::text('customer_no', old('customer_no'), [ 'class' => 'form-control', 'placeholder' => 'Surname' ]) !!}

					</div>
					<div class="form-group">
						{!! Form::label('customer_name', trans('Customer name'), ['class' => 'control-label']) !!}
						{!! Form::text('customer_name', old('customer_name'), [ 'class' => 'form-control', 'placeholder' => 'Input the Customer name' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('customer_address', trans('Customer address'), ['class' => 'control-label']) !!}
						{!! Form::text('customer_address', old('customer_address'), [ 'class' => 'form-control', 'placeholder' => 'Input the Customer address' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('customer_attention', trans('Customer attention'), ['class' => 'control-label']) !!}
						{!! Form::text('customer_attention', old('customer_attention'), [ 'class' => 'form-control', 'placeholder' => 'Input the Customer attention' ]) !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('customer_gname', trans('Customer gname'), ['class' => 'control-label']) !!}
						{!! Form::text('customer_gname', old('customer_gname'), [ 'class' => 'form-control', 'placeholder' => 'Input the Customer gname' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('customer_title', trans('Customer title'), ['class' => 'control-label']) !!}
						{!! Form::text('customer_title', old('customer_title'), [ 'class' => 'form-control', 'placeholder' => 'Input the Customer title' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('our_ref', trans('Our Ref'), ['class' => 'control-label']) !!}
						{!! Form::text('our_ref', old('our_ref'), [ 'class' => 'form-control', 'placeholder' => 'Input the Our Ref' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('your_ref', trans('Your Ref'), ['class' => 'control-label']) !!}
						{!! Form::text('your_ref', old('your_ref'), [ 'class' => 'form-control', 'placeholder' => 'Input the Your Ref' ]) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>