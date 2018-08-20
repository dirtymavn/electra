<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('tour_code', trans('Tour code'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_code', old('tour_code'), [ 'class' => 'form-control', 'id' => 'tour_code', 'placeholder' => '<Auto Number>', 'readonly' => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tour_name', trans('Tour name'), ['class' => 'control-label']) !!}
            {!! Form::text('tour_name', old('tour_name') , ['class' => 'form-control', 'placeholder' => 'Input the Tourfolder status']) !!}
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
            {!! Form::select('branch_id', ['' => 'Choose Branch'] + @$databranch, old('branch_id'), ['class' => 'form-control branch_id', 'id' => 'branch_id']) !!}
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tourfoldercustomer">Tour folder Detail</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tourfolderservice">Tour folder service</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tourfolderitinerary">Tour folder itinerary</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tourfolderrate">Tour folder rate</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tourfolderguide">Tour folder guide</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="tourfoldercustomer">
                    @include('contents.outbounds.tour_folder.parts.tourfolderdetail')
                </div>
                <div class="tab-pane" id="tourfolderservice">
                    @include('contents.outbounds.tour_folder.parts.tourfolderservice')
                </div>
                <div class="tab-pane" id="tourfolderitinerary">
                    @include('contents.outbounds.tour_folder.parts.tourfolderitinerary')
                </div>
                <div class="tab-pane" id="tourfolderrate">
                    @include('contents.outbounds.tour_folder.parts.tourfolderrate')
                </div>
                <div class="tab-pane" id="tourfolderguide">
                    @include('contents.outbounds.tour_folder.parts.tourfolderguide')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Outbound\TourFolderRequest', '#form-tourfolder') !!}
<script>
    $(function(){
        spinnerLoad($('#form-tourfolder'));
        initSelect2Remote($('#branch_id'), "{{ route('branch.search-data') }}", "Choose Branch", 0);
        initSelect2Remote($('#id_airlines'), "{{ route('airline.search-data') }}", "Choose Air line", 0);
        initSelect2Remote($('.id_currency'), "{{ route('currencyrate.search-data') }}", "Choose Currency", 0);
        initSelect2Remote($('.id_tour_guide'), "{{ route('guide.search-data') }}", "Choose guide", 0);
    });
</script>
@include('contents.outbounds.tour_folder.js.tourfolderservice')
@include('contents.outbounds.tour_folder.js.tourfolderitinerary')
@include('contents.outbounds.tour_folder.js.tourfolderrate')
@include('contents.outbounds.tour_folder.js.tourfolderguide')
@endsection