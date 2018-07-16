<div class="element-wrapper">
    <div class="element-box">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button type="button" class="btn btn-primary form-control btn-add-sales col-md-2"><i class="fa fa-plus m-right-10"></i> Add</button>
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="sales-detail" style="width:100%;">
                            <thead>
                                <tr class="text-center">
                                    <th>Product Code</th>
                                    <th>Passenger Class Code</th>
                                    <th>Is Group Flag</th>
                                    <th>Is Supperss Flag</th>
                                    <th>Is Pax Sup</th>
                                    <th>Is Group Item</th>
                                    <th>PNR No</th>
                                    <th>DK No</th>
                                    <th>Airline Form</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('models')
<div id="form-sales-trx" class="modal fade model-lg" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['id' => 'form-sales-detail', 'method' => 'post']) !!}
            <input type="hidden" value="" name="sales_id" id="sales_id">
                        
            <div class="modal-header">
                <h4 class="modal-title">Sales Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @include('contents.business.sales.parts.detail_wizard')
            </div>
            {!! Form::close() !!}
            <div class="modal-footer">
                <a id="form-sales-trx-cancel" href="#" class="btn btn-grey pull-left" data-dismiss="modal">    <i class="fa fa-times m-right-10"></i> Cancel
                </a>
                <button id="form-sales-trx-accept" type="button" class="btn btn-success pull-left">    <i class="fa fa-check"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>

@stack('modal_detail')
@endpush
