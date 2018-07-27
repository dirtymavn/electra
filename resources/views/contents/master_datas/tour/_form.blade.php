<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('tour_name', trans('Tour Name'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_name', old('tour_name') , ['class' => 'form-control', 'placeholder' => 'Input the tour Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_code', trans('Tour Code'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_code', old('tour_code') , ['class' => 'form-control', 'placeholder' => 'Input the Tour Code']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('depart_date', trans('Depart Date'), ['class' => 'control-label']) !!}
            {!! Form::date('depart_date', old('depart_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('return_date', trans('Return Date'), ['class' => 'control-label']) !!}
            {!! Form::date('return_date', old('return_date'), ['class' => 'form-control', 'min' => date('Y-m-d')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('source_type', trans('Source Type'), ['class' => 'control-label']) !!}
            {!! Form::text('source_type', old('source_type') , ['class' => 'form-control', 'placeholder' => 'Input the Source Type']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_category', trans('Tour Category'), ['class' => 'control-label']) !!}
            {!! Form::select('tour_category', @$categories, old('tour_category'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('pax_no', trans('Pax No'), ['class' => 'control-label']) !!}
            {!! Form::text('pax_no', old('pax_no') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Pax No']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('adult', trans('Adult'), ['class' => 'control-label']) !!}
            {!! Form::text('adult', old('adult') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Adult']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('child', trans('Child'), ['class' => 'control-label']) !!}
            {!! Form::text('child', old('child') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Child']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('infant', trans('Infant'), ['class' => 'control-label']) !!}
            {!! Form::text('infant', old('infant') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Infant']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('senior', trans('Senior'), ['class' => 'control-label']) !!}
            {!! Form::text('senior', old('senior') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Senior']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('ticket_only', trans('Ticket Only'), ['class' => 'control-label']) !!}
            {!! Form::text('ticket_only', old('ticket_only') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Ticket Only']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_type', trans('Tour Type'), ['class' => 'control-label']) !!}
            {!! Form::select('tour_type', ['1' => 'Yes', '0' => 'No'], old('tour_type'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('availability', trans('Availability'), ['class' => 'control-label']) !!}
            {!! Form::text('availability', old('availability') , ['class' => 'form-control only_numeric', 'placeholder' => 'Input the Availability']) !!}
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\TourRequest', '#form-tour') !!}
<script>
    $(function(){
        spinnerLoad($('#form-tour'));
    });
</script>
@endsection