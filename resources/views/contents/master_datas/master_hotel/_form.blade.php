<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Name']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
            {!! Form::text('address', old('address') , ['class' => 'form-control', 'placeholder' => 'Input the Address']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_country', trans('country'), ['class' => 'control-label']) !!}
            {!! Form::select('id_country', ['' => 'Choose Country'] + @$countries, old('id_country'), [ 'class' => 'form-control select2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_city', trans('city'), ['class' => 'control-label']) !!}
            {!! Form::select('id_city', ['' => 'Choose City'] + @$cities, old('id_city'), [ 'class' => 'form-control select2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', trans('phone'), ['class' => 'control-label']) !!}
            {!! Form::text('phone', old('phone') , ['class' => 'form-control', 'placeholder' => 'Input the Phone']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone_2', trans('phone 2'), ['class' => 'control-label']) !!}
            {!! Form::text('phone_2', old('phone_2') , ['class' => 'form-control', 'placeholder' => 'Input the Phone']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
            {!! Form::text('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Input the Email']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fax', trans('Fax'), ['class' => 'control-label']) !!}
            {!! Form::text('fax', old('fax') , ['class' => 'form-control', 'placeholder' => 'Input the Fax']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('fax_2', trans('Fax 2'), ['class' => 'control-label']) !!}
            {!! Form::text('fax_2', old('fax_2') , ['class' => 'form-control', 'placeholder' => 'Input the Fax 2']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('id_hotel_chain', trans('Hotel Chain'), ['class' => 'control-label']) !!}
            {!! Form::select('id_hotel_chain', ['' => 'Choose Hotel Chain'] + @$hotelchain, old('id_hotel_chain'), ['class' => 'form-control id_hotel_chain select2']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="os-tabs-w">
            <div class="os-tabs-controls">
                <ul class="nav nav-tabs smaller">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#hotelcontact">Hotel Contact</a></li>
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#hotelproperty">Hotel Property</a></li>
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#hotelfinance">Hotel Finance</a></li>
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#hotelother">Hotel Other</a></li>
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#hotelservice">Hotel Service</a></li>
                    <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#hotelroomstype">Hotel Room Type</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="hotelcontact">
                    @include('contents.master_datas.master_hotel.parts.hotelcontact')
                </div>
                <div class="tab-pane" id="hotelproperty">
                    @include('contents.master_datas.master_hotel.parts.hotelproperty')
                </div>
                <div class="tab-pane" id="hotelfinance">
                    @include('contents.master_datas.master_hotel.parts.hotelfinance')
                </div>
                <div class="tab-pane" id="hotelother">
                    @include('contents.master_datas.master_hotel.parts.hotelother')
                </div>
                <div class="tab-pane" id="hotelservice">
                    @include('contents.master_datas.master_hotel.parts.hotelservice')
                </div>
                <div class="tab-pane" id="hotelroomstype">
                    @include('contents.master_datas.master_hotel.parts.hotelroomstype')
                </div>
            </div>
        </div>
    </div>
</div>

@section('part_script')
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\MasterData\MasterHotelRequest', '#form-masterhotel') !!}
<script>
    $(function(){
        spinnerLoad($('#form-masterhotel'));
    });

    $(document).on('change', '#id_country', function() {
        var _this = $(this);
        console.log(_this)
        if (_this.val() == '') {
            $('#id_city').html('<option value="">Choose City</option>');
            return false;
        }
        $.ajax({
            url: "{{ route('city.search-data-by-country') }}",
            method: "get",
            dataType: "json",
            data: {country_id: _this.val()},
            success: function(data) {
                $.each(data, function(key, value) {
                    $('#id_city').append('<option value="'+value.id+'">'+value.city_name+'</option>');
                });
            }
        });
    });
</script>

@include('contents.master_datas.master_hotel.js.hotelcontact')
@include('contents.master_datas.master_hotel.js.hotelservice')
@endsection