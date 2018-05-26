<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('Role Name'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Role Name']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('premissions', trans('Permission'), [ 'class' => 'control-label col-sm-6' ]) !!}
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th> Role Action </th>
                    <th> Create </th>
                    <th> Update </th>
                    <th> Read </th>
                    <th> Delete </th>
                    <th> Approve </th>
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
                                <td> {!! Form::checkbox('permissions[]', $i) !!} </td>
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
