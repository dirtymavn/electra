<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('Role Name'), ['class' => 'col-sm-6 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', old('name') , ['class' => 'form-control', 'placeholder' => 'Input the Role Name']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('premissions', trans('Permission'), [ 'class' => 'control-label col-sm-6' ]) !!}
    <div class="col-md-12">
        @foreach( $permissions as $key => $datas )
            <div class="row">
                <div class="col-sm-4">
                    <label> {{ $key }} </label>
                </div>
                <div class="col-sm-8">
                    @foreach( $datas as $i => $value )
                        <label>
                            {!! Form::checkbox('permissions[]', $i) !!}
                            {!! $value !!}
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
