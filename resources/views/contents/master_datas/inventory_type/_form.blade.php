<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('inventory_type_name', trans('Inventory Type Name'), ['class' => 'control-label']) !!}
            {!! Form::text('inventory_type_name', old('inventory_type_name') , ['class' => 'form-control', 'placeholder' => 'Input the Inventory Type Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('inventory_type_code', trans('Inventory Type Code'), ['class' => 'control-label']) !!}
            {!! Form::text('inventory_type_code', old('product_type_code') , ['class' => 'form-control', 'placeholder' => 'Input the Inventory Type Code']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\InventoryTypeRequest', '#form-inventorytype') !!}
<script>
    $(function(){
        spinnerLoad($('#form-inventorytype'));
    });
</script>
@endsection