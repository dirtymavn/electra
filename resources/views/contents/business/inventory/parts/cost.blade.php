<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('cost_type', trans('Cost Type'), ['class' => 'control-label']) !!}
                    {!! Form::text('cost_type', old('cost_type') , ['class' => 'form-control', 'placeholder' => 'Input the Cost Type']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('lg_no', trans('LG No'), ['class' => 'control-label']) !!}
                    {!! Form::text('lg_no', old('lg_no'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('supplier_no', trans('Cost Type'), ['class' => 'control-label']) !!}
                    {!! Form::text('supplier_no', old('supplier_no') , ['class' => 'form-control', 'placeholder' => 'Input the Cost Type']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('ticket_cost', trans('Ticket Cost'), ['class' => 'control-label']) !!}
                    {!! Form::number('ticket_cost', old('ticket_cost') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket Cost']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('published_r', trans('Published'), ['class' => 'control-label']) !!}
                    {!! Form::number('published_r', old('published_r') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket Cost']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('exch_rate', trans('Exch Rate'), ['class' => 'control-label']) !!}
                    {!! Form::number('exch_rate', old('exch_rate') , ['class' => 'form-control', 'placeholder' => 'Input the Ticket Cost']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('tax', trans('Tax'), ['class' => 'control-label']) !!}
                    {!! Form::number('tax', old('tax') , ['class' => 'form-control', 'placeholder' => 'Input the Tax']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('discount', trans('Discount'), ['class' => 'control-label']) !!}
                    {!! Form::number('discount', old('discount') , ['class' => 'form-control', 'placeholder' => 'Input the Discount']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('comm_amt', trans('Comm Amt'), ['class' => 'control-label']) !!}
                    {!! Form::number('comm_amt', old('comm_amt') , ['class' => 'form-control', 'placeholder' => 'Input the Comm Amt']) !!}
                </div>
            </div>
        </div>
    </div>
</div>