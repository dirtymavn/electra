<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', trans('Customer'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('customer_id', ['' => "Choose Customer"] + @$customers, old('customer_id'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', trans('Code'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', old('code') , ['class' => 'form-control', 'placeholder' => 'Input the Transaction Code']) !!}
    </div>
</div>


@section('part_script')
<!-- <script src="{{ asset('themes/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script> -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Business\TransactionRequest', '#form-transaction') !!}
@endsection