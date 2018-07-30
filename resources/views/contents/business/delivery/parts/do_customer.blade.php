<div class="element-wrapper">
	<div class="element-box">
		<div class="row">
			<div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('customer_no', trans('Customer No'), ['class' => 'control-label']) !!}
                    {{-- {!! Form::text('customer_no', old('customer_no') , ['class' => 'form-control', 'placeholder' => 'Input the Customer No']) !!} --}}
                    {!! Form::select('customer_no', @$customers, old('customer_no'), ['class' => 'form-control', 'id' => 'cust_no']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('tell_no', trans('Customer No'), ['class' => 'control-label']) !!}
                    {!! Form::text('tell_no', old('tell_no') , ['class' => 'form-control', 'placeholder' => 'Input the Customer No']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('customer_address', trans('Customer Address'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('customer_address', old('customer_address') , ['class' => 'form-control', 'placeholder' => 'Input the Customer Address', 'rows' => '3x6']) !!}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('attn', trans('Attn'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('attn', old('attn') , ['class' => 'form-control', 'placeholder' => 'Input the Attn', 'rows' => '3x6']) !!}
                </div>
            </div>
		</div>
	</div>
</div>