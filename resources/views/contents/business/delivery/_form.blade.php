<div class="row element-voucher">
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header"></p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('delivery_no', trans('DO No.'), ['class' => 'control-label']) !!}
                    {!! Form::text('delivery_no', old('delivery_no') , ['class' => 'form-control', 'placeholder' => 'Input the LG No.']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', trans('DO Type.'), ['class' => 'control-label']) !!}
                    {!! Form::select('type', ['' => 'Choose Type'], old('type') , ['class' => 'form-control col-md-6']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('team_code', trans('Team Code'), ['class' => 'control-label']) !!}
                    {!! Form::text('team_code', old('team_code') , ['class' => 'form-control', 'placeholder' => 'Input the Team Code']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sender', trans('Sender'), ['class' => 'control-label']) !!}
                    {!! Form::text('sender', old('sender') , ['class' => 'form-control', 'placeholder' => 'Input the Sender']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('department', trans('Department'), ['class' => 'control-label']) !!}
                    {!! Form::select('department', ['' => 'Choose Department'], old('department') , ['class' => 'form-control col-md-6']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header"></p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('number', trans('Number'), ['class' => 'control-label']) !!}
                    {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => 'Input the Number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('tel_no', trans('Tel NO 1'), ['class' => 'control-label']) !!}
                            {!! Form::text('tel_no', old('tel_no') , ['class' => 'form-control', 'placeholder' => 'Input the Tel NO']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('tel_no', trans('Tel NO 2'), ['class' => 'control-label']) !!}
                            {!! Form::text('tel_no', old('tel_no') , ['class' => 'form-control', 'placeholder' => 'Input the Tel NO']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('attn', trans('Attn'), ['class' => 'control-label']) !!}
                    {!! Form::text('attn', old('attn') , ['class' => 'form-control', 'placeholder' => 'Input the Attn']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '3']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="element-wrapper">
            <p class="element-header"></p>
            <div class="element-box">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('number', trans('Despatch Staff'), ['class' => 'control-label']) !!}
                            {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => 'Input the Despatch Staff']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('date', trans('Despatch Date/Time'), ['class' => 'control-label']) !!}
                            {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('type', trans('Instruction'), ['class' => 'control-label']) !!}
                            {!! Form::select('type', ['' => 'Choose Type'], old('type') , ['class' => 'form-control ']) !!}
                        </div>  
                        <div class="form-group">
                            {!! Form::label('type', trans('To Deliver'), ['class' => 'control-label']) !!}
                            {!! Form::select('type', ['' => 'Choose To Deliver'], old('type') , ['class' => 'form-control ']) !!}
                        </div>  
                        <div class="form-group">
                            {!! Form::label('type', trans('To Collects'), ['class' => 'control-label']) !!}
                            {!! Form::select('type', ['' => 'Choose Collect'], old('type') , ['class' => 'form-control ']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('type', trans('Price'), ['class' => 'control-label']) !!}
                    {!! Form::select('type', ['' => 'Choose Price'], old('type') , ['class' => 'form-control ']) !!}
                </div>  
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class= 'control-label'>&nbsp</label>
                    {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                </div>  
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    {!! Form::label('type', trans('GST'), ['class' => 'control-label']) !!}
                    {!! Form::select('type', ['' => 'Choose GST'], old('type') , ['class' => 'form-control ']) !!}
                </div>  
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class= 'control-label'>&nbsp</label>
                    {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => '0.00 %']) !!}
                </div>  
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class= 'control-label'>&nbsp</label>
                    {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => '0.00 %']) !!}
                </div>  
            </div>
        </div>
    </div>
</div>
@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Master\CompanyRequest', '#form-voucher') !!}
@endsection