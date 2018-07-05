<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('product_type_name', trans('Product Type Name'), ['class' => 'control-label']) !!}
            {!! Form::text('product_type_name', old('product_type_name') , ['class' => 'form-control', 'placeholder' => 'Input the Product Type Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('product_type_code', trans('Product Type Code'), ['class' => 'control-label']) !!}
            {!! Form::text('product_type_code', old('product_type_code') , ['class' => 'form-control', 'placeholder' => 'Input the Product Type Code']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\ProductTypeRequest', '#form-producttype') !!}
<script>
    $(function(){
        spinnerLoad($('#form-producttype'));
    });
</script>
@endsection