<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('Role Name'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Role Name']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('premissions', trans('Permission'), [ 'class' => 'control-label col-sm-12' ]) !!}
    <div class="text-right">
        <input type="checkbox" name="checkall" id="checkall" onchange="checkAll(this)"> <b>{!! Form::label('dsa', trans('Check All'), [ 'class' => 'control-label' ]) !!} </b>
    </div>

    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th> Role Action </th>
                    <th> Read <input type="checkbox" onchange="checkRead(this)"></th>
                    <th> Create <input type="checkbox" onchange="checkCreate(this)"></th>
                    <th> Update <input type="checkbox" onchange="checkUpdate(this)"></th>
                    <th> Delete <input type="checkbox" onchange="checkDelete(this)"></th>
                    <th> Approve <input type="checkbox" onchange="checkApprove(this)"></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $permissions as $key => $datas )
                    <tr>
                        <th colspan="6"> {{ $key }} </th>
                    </tr>
                    @foreach ($datas as $row => $results)
                        <tr>
                            <td> - {{ $row }} </td>
                            @foreach ($results as $i => $data)
                                <td> {!! Form::checkbox('permissions[]', $i, null,   ['class' => $data]) !!} </td>
                            @endforeach
                        </tr>
                    @endforeach

                @endforeach
            </tbody>   
        </table>
        {{-- @foreach( $permissions as $key => $datas )
            <div class="row">
                <div class="col-sm-12">
                    <label> {{ $key }} </label>
                    <div class="row">
                        @foreach ($datas as $row => $data)
                            <div class="col-sm-6">
                                &nbsp&nbsp&nbsp<span> {{ $row }} </span>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
</div>
