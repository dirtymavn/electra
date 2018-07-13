<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('card_type', trans('Card Type'), ['class' => 'control-label']) !!}
                    {!! Form::text('card_type', old('card_type') , ['class' => 'form-control', 'placeholder' => 'Input the Card Type']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('card_no', trans('Card No'), ['class' => 'control-label']) !!}
                    {!! Form::text('card_no', old('card_no') , ['class' => 'form-control', 'placeholder' => 'Input the Card No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('cardholder_name', trans('Cardholder Name'), ['class' => 'control-label']) !!}
                    {!! Form::text('cardholder_name', old('cardholder_name') , ['class' => 'form-control', 'placeholder' => 'Input the Cardholder Name']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('expiry_date', trans('Expiry Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('expiry_date', old('expiry_date') , ['class' => 'form-control', 'placeholder' => 'Input the Expiry Date']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('security_id', trans('Security'), ['class' => 'control-label']) !!}
                    {!! Form::text('security_id', old('security_id') , ['class' => 'form-control', 'placeholder' => 'Input the Security']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('merchant_no', trans('Merchant No'), ['class' => 'control-label']) !!}
                    {!! Form::number('merchant_no', old('merchant_no') , ['class' => 'form-control', 'placeholder' => 'Input the Merchant No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('roc_no', trans('Roc No'), ['class' => 'control-label']) !!}
                    {!! Form::text('roc_no', old('roc_no') , ['class' => 'form-control', 'placeholder' => 'Input the Roc No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('sof_flag', trans('Sof Lag'), ['class' => 'control-label']) !!}
                    {!! Form::text('sof_flag', old('sof_flag') , ['class' => 'form-control', 'placeholder' => 'Input the Sof Lag']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('amount', trans('Amount'), ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('amount') , ['class' => 'form-control', 'placeholder' => 'Input the Amount']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('authorisation_code', trans('Authorisation Code'), ['class' => 'control-label']) !!}
                    {!! Form::text('authorisation_code', old('authorisation_code') , ['class' => 'form-control', 'placeholder' => 'Input the Authorisation Code']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('authorisation_date', trans('Authorisation Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('authorisation_date', old('authorisation_date') , ['class' => 'form-control', 'placeholder' => 'Input the Authorisation Date']) !!}
                </div>
            </div>
        </div>
    </div>
</div>