<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('core_form_id', trans('Core Form'), ['class' => 'control-label']) !!}
            {!! Form::select('core_form_id', ['' => 'Choose Core Form'] + @$coreForms, old('core_form_id'), ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="element-wrapper">
            <div class="element-box">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Debit value : <span class="debit-value">0</span> %</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Credit value : <span class="credit-value">0</span> %</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button class="form-control btn btn-success calculate" type="button">Calculate</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12" id="config-detail">
                        @if(@$accountingConfig->id)
                            @foreach($accountingConfig->details as $key => $detailVal)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select class="form-control master-coa coa-{{$key}}" name="config_detail[coa][{{$key}}]">
                                                <option value="">Choose Master COA</option>
                                                <option value="{{@$detailVal->master_coa_id}}" selected>{{@$detailVal->masterCoa->acc_no_key}}</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control type-{{$key}}" name="config_detail[type][{{$key}}]">
                                                <option value="debit" {{ ($detailVal->type == 'debit') ? 'selected' : '' }}>Debit</option>
                                                <option value="credit" {{ ($detailVal->type == 'credit') ? 'selected' : '' }}>Credit</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="config_detail[value][{{$key}}]" data-value="{{$key}}" class="form-control only_number value" value="{{$detailVal->value}}" placeholder="Input Value (%)">
                                        </div>
                                        <div class="col-sm-2">
                                            @if($key == 0)
                                                <button type="button" class="btn btn-small btn-primary add-detail"><i class="fa fa-plus"></i></button>
                                            @elseif($key > 1)
                                                <button type="button" class="btn btn-small btn-danger remove-detail"><i class="fa fa-trash"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control master-coa coa-0" name="config_detail[coa][0]">
                                            <option value="">Choose Master COA</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control type-0" name="config_detail[type][0]">
                                            <option value="debit">Debit</option>
                                            <option value="credit">Credit</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="config_detail[value][0]" data-value="0" class="form-control only_number value" placeholder="Input Value (%)">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-small btn-primary add-detail"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control master-coa coa-1" name="config_detail[coa][1]">
                                            <option value="">Choose Master COA</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control type-1" name="config_detail[type][1]">
                                            <option value="debit">Debit</option>
                                            <option value="credit">Credit</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" name="config_detail[value][1]" data-value="1" class="form-control value only_number" placeholder="Input Value (%)">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('part_script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/5.0.4/math.min.js"></script>
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Setting\AccountingConfigRequest', '#form-accountingconfig') !!}
<script>
    $(function(){
        var credit_val = 0;
        var debit_val = 0;

        spinnerLoad($('#form-accountingconfig'));
        initSelect2($('#core_form_id'), 'Choose Core Form');
        initSelect2Remote($('.master-coa'), "{{ route('account.search-data') }}", "Choose Master COA", 0);

        var more_detail = "{{ (@$accountingConfig->id) ? ($accountingConfig->details->count() - 1) : 1 }}";
        $('.add-detail').click(function(e) { //on add input button click
            e.preventDefault();
            more_detail++; //text box increment
            $("#config-detail").append('<div class="form-group"><div class="row">'
                    +'<div class="col-sm-4">'
                        +'<select class="form-control coa-'+more_detail+'" name="config_detail[coa]['+more_detail+']">'
                            +'<option value="">Choose Master COA</option>'
                        +'</select>'
                    +'</div>'
                    +'<div class="col-sm-4">'
                        +'<select class="form-control type-'+more_detail+'" name="config_detail[type]['+more_detail+']">'
                            +'<option value="debit">Debit</option>'
                            +'<option value="credit">Credit</option>'
                        +'</select>'
                    +'</div>'
                    +'<div class="col-sm-2">'
                        +'<input type="text" name="config_detail[value]['+more_detail+']" data-value="'+more_detail+'" class="form-control only_number value" placeholder="Input Value (%)">'
                    +'</div>'
                    +'<div class="col-sm-2">'
                        +'<button type="button" class="btn btn-small btn-danger remove-detail"><i class="fa fa-trash"></i></button>'
                    +'</div>'
                +'</div></div>'); //add 

            initSelect2Remote($('.coa-'+more_detail), "{{ route('account.search-data') }}", "Choose Master COA", 0);
        });
        
        $("#config-detail").on("click",".remove-detail", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove();
        });

        $(document).on('click', '.calculate', function() {
            var calculate = calculateConfig();

            if (calculate.deb_val == 100 && calculate.cred_val == 100) {
                // Balance
            } else {
                alert('Credit Value and Debit Value must 100%');
            }
        });

       $(document).on('click', '#btn-submit, #btn-publish-continue, #btn-update',  function(e) {
            e.preventDefault();

            var calculate = calculateConfig();

            if (calculate.deb_val == 100 && calculate.cred_val == 100) {
                $('#form-accountingconfig').submit();    
            } else {
                alert('Credit Value and Debit Value must 100%');
                return false;
            }
            
       }); 
    });

    $(document).ready(function() {
        @if(@$accountingConfig->id)
            $('.calculate').click();
        @endif
    });


    function calculateConfig() {
        credit_val = 0;
        debit_val = 0;

        $.each($('.value'), function(key, value) {
            var value = $('.value').eq(key).val();
            var type = $('.type-'+key).val();
            if (type == 'debit') {
                var scope = {
                    a: debit_val,
                    b: value
                }
                var resValue = math.eval('a + b', scope);
                debit_val = resValue;
            } else {
                var scope = {
                    a: credit_val,
                    b: value
                }
                var resValue = math.eval('a + b', scope);
                credit_val = resValue;
            }
        });

        var scope = {
            a: debit_val,
            b: credit_val
        }

        $('.debit-value').text(debit_val);
        $('.credit-value').text(credit_val);
        $('.total-value').text(math.eval('a + b', scope));

        return { deb_val: debit_val, cred_val: credit_val };
    }
</script>
@endsection