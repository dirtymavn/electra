<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('category_name', trans('Category Name'), ['class' => 'control-label']) !!}
            {!! Form::text('category_name', old('category_name') , ['class' => 'form-control', 'placeholder' => 'Input the Category Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_code', trans('Category Code'), ['class' => 'control-label']) !!}
            {!! Form::text('category_code', old('category_code') , ['class' => 'form-control', 'placeholder' => 'Input the Category Code', 'maxlength' => '20']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('parent_category_id', trans('Parent Category'), ['class' => 'control-label']) !!}
            {!! Form::select('parent_category_id', $parents, old('parent_category_id'), ['class' => 'form-control', 'placeholder' => 'Choose Parent Category']) !!}
        </div>
         <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::select('status', [true => 'Active', false => 'Disabled'], old('status'), ['class' => 'form-control', 'placeholder' => 'Choose Status']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\ProductCategoryRequest', '#form-product') !!}
<script>
    $(function(){
        spinnerLoad($('#form-product'));
    });
</script>
@endsection