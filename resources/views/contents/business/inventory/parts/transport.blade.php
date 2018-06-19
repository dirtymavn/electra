<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('pcc', trans('PCC'), ['class' => 'control-label']) !!}
                    {!! Form::text('pcc', old('pcc') , ['class' => 'form-control', 'placeholder' => 'Input the PCC']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('airline', trans('Airline'), ['class' => 'control-label']) !!}
                    {!! Form::select('airline', ['' => "Choose Airline"], old('airline'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('valid_from', trans('Valid From'), ['class' => 'control-label']) !!}
                    {!! Form::date('valid_from', old('valid_from') , ['class' => 'form-control', 'placeholder' => 'Input the Valid From']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('valid_to', trans('Valid To'), ['class' => 'control-label']) !!}
                    {!! Form::date('valid_to', old('valid_to') , ['class' => 'form-control', 'placeholder' => 'Input the Valid To']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('issue_date', trans('Issue Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('issue_date', old('issue_date') , ['class' => 'form-control', 'placeholder' => 'Input the Issue Date']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('reissue', trans('Reissue'), ['class' => 'control-label']) !!}
                    {!! Form::text('reissue', old('reissue') , ['class' => 'form-control', 'placeholder' => 'Input the Reissue']) !!}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('conjunction_ticket_flag', trans('Conjunction Ticket Flag'), ['class' => 'control-label']) !!}
                    {!! Form::text('conjunction_ticket_flag', old('conjunction_ticket_flag') , ['class' => 'form-control', 'placeholder' => 'Input the Conjunction Ticket Flag']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('conjunction_first_ticket', trans('Conjunction Ticket Flag'), ['class' => 'control-label']) !!}
                    {!! Form::text('conjunction_first_ticket', old('conjunction_first_ticket') , ['class' => 'form-control', 'placeholder' => 'Input the Conjunction Ticket Flag']) !!}
                </div>
            </div>
        </div>

    </div>
</div>