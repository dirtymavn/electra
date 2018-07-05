<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('gst_code', trans('GST Code'), ['class' => 'control-label']) !!}
            {!! Form::text('gst_code', old('gst_code') , ['class' => 'form-control', 'placeholder' => 'Input the GST Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('gst_percent', trans('GST Percent'), ['class' => 'control-label']) !!}
            {!! Form::text('gst_percent', old('gst_percent') , ['class' => 'form-control only_number', 'placeholder' => 'Input the GST Percent']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('absorb_ppn', trans('Absorb PPn'), ['class' => 'control-label']) !!}
            {!! Form::select('absorb_ppn', ['1' => 'Yes', '0' => 'No'], old('absorb_ppn'), ['class' => 'form-control']) !!}
        </div>
        
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\GstRequest', '#form-gst') !!}
<script>
    $(function(){
        spinnerLoad($('#form-gst'));
    });
</script>
@endsection