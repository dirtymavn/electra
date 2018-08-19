<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fit_code', trans('Fit code'), ['class' => 'control-label']) !!}
            {!! Form::text('fit_code', old('fit_code'), [ 'class' => 'form-control', 'id' => 'fit_code', 'placeholder' => '<Auto Number>', 'readonly' => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fit_name', trans('Fit name'), ['class' => 'control-label']) !!}
            {!! Form::text('fit_name', old('fit_name') , ['class' => 'form-control', 'placeholder' => 'Input the Tourfolder status']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('departure_date', trans('Departure date'), ['class' => 'control-label']) !!}
            {!! Form::date('departure_date', old('departure_date') , ['class' => 'form-control', 'placeholder' => 'Input the Departure date']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('return_date', trans('Return date'), ['class' => 'control-label']) !!}
            {!! Form::date('return_date', old('return_date') , ['class' => 'form-control', 'placeholder' => 'Input the Return date']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
            {!! Form::text('status', old('status') , ['class' => 'form-control', 'placeholder' => 'Input the status']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('direction', trans('Customer credit term'), ['class' => 'control-label']) !!}
            {!! Form::select('direction', ['inbound' => 'inbound', 'outbound' => 'outbound'], old('direction'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('branch_id', trans('Branch'), ['class' => 'control-label']) !!}
            {!! Form::select('branch_id', ['' => 'Choose Branch'] + @$databranch, old('branch_id'), ['class' => 'form-control branch_id']) !!}
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#fitfoldercustomer">Fit folder Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fitfolderservice">Fit folder service</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fitfolderitinerary">Fit folder itinerary</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fitfolderrate">Fit folder rate</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fitfolderguide">Fit folder guide</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="fitfoldercustomer">
                    @include('contents.fits.tour_folder.parts.fitfolderdetail')
                </div>
                <div class="tab-pane" id="fitfolderservice">
                    @include('contents.fits.tour_folder.parts.fitfolderservice')
                </div>
                <div class="tab-pane" id="fitfolderitinerary">
                    @include('contents.fits.tour_folder.parts.fitfolderitinerary')
                </div>
                <div class="tab-pane" id="fitfolderrate">
                    @include('contents.fits.tour_folder.parts.fitfolderrate')
                </div>
                <div class="tab-pane" id="fitfolderguide">
                    @include('contents.fits.tour_folder.parts.fitfolderguide')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Fit\FitFolderRequest', '#form-fitfolder') !!}
<script>
    $(function(){
        spinnerLoad($('#form-fitfolder'));
    });
</script>
@include('contents.fits.tour_folder.js.fitfolderservice')
@include('contents.fits.tour_folder.js.fitfolderitinerary')
@include('contents.fits.tour_folder.js.fitfolderrate')
@include('contents.fits.tour_folder.js.fitfolderguide')
@endsection