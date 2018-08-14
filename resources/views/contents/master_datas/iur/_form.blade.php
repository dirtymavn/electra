<div class="row">
    <div class="col-sm-12 col-xxxl-9">
        <div class="box">
            <div class="box-body">
                <div class="form-group ">
                    <label for="name" class="col-sm-6 control-label">Company Name</label>
                    <div class="col-md-6">
                        <input class="form-control"  name="iur" type="file" accept=".txt" id="iur">
                    </div>
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn btn-default" id="submit">Upload</button>
                </div>
            </div>
        </div>
        <div class="element-box">
            <div class="os-tabs-w">
                <div class="os-tabs-controls">
                    <ul class="nav nav-tabs smaller">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_passenger">Overview</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_itinerary">Passenger</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_misc">Misc Record</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_passenger">
                        <div class="content">
                            @foreach ($passenger as $key => $value )
                                <h5>{{ucwords(str_replace('_',' ',$key))}}</h5>
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            @foreach ($value[0] as $field => $x )
                                                <th>{{ucwords(str_replace('_',' ',$field))}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value as $val)
                                                <tr>
                                                    @foreach ($val as $field => $x )
                                                        <td>{{$x}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_itinerary">
                        <div class="content">
                            @foreach ($itinerary as $key => $value )
                                <h5>{{ucwords(str_replace('_',' ',$key))}}</h5>
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            @foreach ($value[0] as $field => $x )
                                                <th>{{ucwords(str_replace('_',' ',$field))}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value as $val)
                                                <tr>
                                                    @foreach ($val as $field => $x )
                                                        <td>{{$x}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_misc">
                        <div class="content">
                            @foreach ($misc as $key => $value )
                                <h5>{{ucwords(str_replace('_',' ',$key))}}</h5>
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            @foreach ($value[0] as $field => $x )
                                                <th>{{ucwords(str_replace('_',' ',$field))}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($value as $val)
                                                <tr>
                                                    @foreach ($val as $field => $x )
                                                        <td>{{$x}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>