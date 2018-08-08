<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('id_hotel', trans('hotel'), ['class' => 'control-label']) !!}
            {!! Form::select('id_hotel', ['' => 'Choose Hotel'] + @$listmasterhotel, old('id_hotel'), [ 'class' => 'form-control select2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name_info', trans('Info Name'), ['class' => 'control-label']) !!}
            {!! Form::text('name_info', old('name_info') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('address_info', trans('Info Address'), ['class' => 'control-label']) !!}
            {!! Form::text('address_info', old('address_info') , ['class' => 'form-control', 'placeholder' => 'Input the Address']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('all_contact_person_info', trans('Info Contact Person'), ['class' => 'control-label']) !!}
            {!! Form::text('all_contact_person_info', old('all_contact_person_info') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#hotelallotmentdetail">Hotel Allotment Detail</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="hotelallotmentdetail">
                    @include('contents.master_datas.hotel_allotment.parts.hotelallotmentdetail')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\HotelAllotmentRequest', '#form-hotelallotment') !!}
<script>
    $(function(){
        spinnerLoad($('#form-hotelallotment'));
    });
</script>

@include('contents.master_datas.hotel_allotment.js.hotelallotmentdetail')
@endsection