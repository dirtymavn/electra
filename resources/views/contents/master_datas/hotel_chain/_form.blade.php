<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('Hotel Chain Name'), ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Hotel Chain Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', trans('Hotel Chain Description'), ['class' => 'control-label']) !!}
            {!! Form::text('description', old('description') , ['class' => 'form-control', 'placeholder' => 'Input the Hotel Chain Code']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\HotelChainRequest', '#form-hotelchain') !!}
<script>
    $(function(){
        spinnerLoad($('#form-hotelchain'));
    });
</script>
@endsection