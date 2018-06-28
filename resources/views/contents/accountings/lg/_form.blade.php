<div class="row element-voucher">
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Letter of Guarantee</p>
            <div class="element-box">
                <div class="form-group">
                    {!! Form::label('lg_no', trans('LG No.'), ['class' => 'control-label']) !!}
                    {!! Form::text('lg_no', old('lg_no') , ['class' => 'form-control', 'placeholder' => 'Input the LG No.']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type', trans('Type.'), ['class' => 'control-label']) !!}
                    {!! Form::select('type', ['' => 'Choose Type'], old('type') , ['class' => 'form-control col-md-6']) !!}
                </div>  
                <div class="form-group">
                    {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                    {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('supplier_ref_no', trans('Supplier Ref No'), ['class' => 'control-label']) !!}
                    {!! Form::text('supplier_ref_no', old('supplier_ref_no') , ['class' => 'form-control', 'placeholder' => 'Input the Supplier Ref No']) !!}
                </div>
            </div>
        </div>

        <div class="element-wrapper">
            <p class="element-header">Others</p>
            <div class="element-box">
                <div class="row"> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('credit_term', trans('Credit term'), ['class' => 'control-label']) !!}
                            {!! Form::text('credit_term', old('credit_term') , ['class' => 'form-control', 'placeholder' => 'Input Credit Term']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                            {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('number', trans('Paid Amount'), ['class' => 'control-label']) !!}
                    {!! Form::text('number', old('number') , ['class' => 'form-control', 'placeholder' => 'Input the Paid Amount']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="element-wrapper">
            <p class="element-header">Supplier</p>
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
                            {!! Form::label('attention', trans('Attention'), ['class' => 'control-label']) !!}
                            {!! Form::text('attention', old('attention') , ['class' => 'form-control', 'placeholder' => 'Input the Attention']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('gname', trans('G-Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('gname', old('gname') , ['class' => 'form-control', 'placeholder' => 'Input the G-Name']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address', 'rows' => '3']) !!}
                </div>
            </div>
        </div>

        <div class="element-wrapper">
            <p class="element-header">Currency</p>
            <div class="element-box">
                <div class="row"> 
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('credit_term', trans('Base'), ['class' => 'control-label']) !!}
                            {!! Form::text('credit_term', old('credit_term') , ['class' => 'form-control', 'placeholder' => 'Input Credit Term']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('date', trans('Number'), ['class' => 'control-label']) !!}
                            {!! Form::date('date', old('date') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('credit_term', trans('Biling'), ['class' => 'control-label']) !!}
                            {!! Form::text('credit_term', old('credit_term') , ['class' => 'form-control', 'placeholder' => 'Input Credit Term']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label></label>
                            {!! Form::number('number', old('number') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label></label>
                            {!! Form::number('number', old('number') , ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="element-wrapper">
            <p class="element-header">Items</p>
            <div class="element-box">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Product Code</td>
                            <td>Prod. Code Desc</td>
                            <td>Suppress ltin...</td>
                            <td>Qty</td>
                            <td>Unit Cost</td>
                            <td>Total Amt.</td>
                            <td>Discount</td>
                            <td>Tax</td>
                            <td>GST Amount</td>
                            <td>Sales</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('part_script')
<script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Master\CompanyRequest', '#form-voucher') !!}
@endsection