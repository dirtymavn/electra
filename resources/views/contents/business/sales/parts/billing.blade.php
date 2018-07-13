<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('ta_no', trans('TA No'), ['class' => 'control-label']) !!}
                    {!! Form::text('ta_no', old('ta_no') , ['class' => 'form-control', 'placeholder' => 'Input the TA No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('cc_id', trans('CC ID'), ['class' => 'control-label']) !!}
                    {!! Form::number('cc_id', old('cc_id') , ['class' => 'form-control', 'placeholder' => 'Input the CC ID']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('purpose_code', trans('Purpose Code'), ['class' => 'control-label']) !!}
                    {!! Form::text('purpose_code', old('purpose_code') , ['class' => 'form-control', 'placeholder' => 'Input the Purpose Code']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('prcj_no', trans('Prcj No'), ['class' => 'control-label']) !!}
                    {!! Form::text('prcj_no', old('prcj_no') , ['class' => 'form-control', 'placeholder' => 'Input the Prcj No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('department', trans('Department'), ['class' => 'control-label']) !!}
                    {!! Form::text('department', old('department') , ['class' => 'form-control', 'placeholder' => 'Input the Department']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('employee_no', trans('Employee No'), ['class' => 'control-label']) !!}
                    {!! Form::text('employee_no', old('employee_no') , ['class' => 'form-control', 'placeholder' => 'Input the Employee No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('account_no', trans('Account No'), ['class' => 'control-label']) !!}
                    {!! Form::text('account_no', old('account_no') , ['class' => 'form-control', 'placeholder' => 'Input the Account No']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('job_title', trans('Job Title'), ['class' => 'control-label']) !!}
                    {!! Form::text('job_title', old('job_title') , ['class' => 'form-control', 'placeholder' => 'Input the Job Title']) !!}
                </div>
            </div>
        </div>
    </div>
</div>