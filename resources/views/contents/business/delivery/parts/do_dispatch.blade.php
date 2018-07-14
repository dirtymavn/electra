<div class="element-wrapper">
	<div class="element-box">
		<div class="row">
			<div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('despatch_staff', trans('Despatch Staff'), ['class' => 'control-label']) !!}
                    {!! Form::number('despatch_staff', old('despatch_staff') , ['class' => 'form-control', 'placeholder' => 'Input the Despatch Staff']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('despatch_time', trans('Despatch Time'), ['class' => 'control-label']) !!}
                    {!! Form::text('despatch_time', old('despatch_time') , ['class' => 'form-control', 'placeholder' => 'Input the Despatch Time']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('realeted_so', trans('Realeted SO'), ['class' => 'control-label']) !!}
                    {!! Form::text('realeted_so', old('realeted_so') , ['class' => 'form-control', 'placeholder' => 'Input the Realeted SO']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('to_area', trans('TO Area'), ['class' => 'control-label']) !!}
                    {!! Form::text('to_area', old('to_area') , ['class' => 'form-control', 'placeholder' => 'Input the TO Area']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('to_deliver', trans('To Deliver'), ['class' => 'control-label']) !!}
                    {!! Form::text('to_deliver', old('to_deliver') , ['class' => 'form-control', 'placeholder' => 'Input the To Deliver']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('to_collect', trans('To Collect'), ['class' => 'control-label']) !!}
                    {!! Form::text('to_collect', old('to_collect') , ['class' => 'form-control', 'placeholder' => 'Input the To Collect']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('received_by', trans('Received By'), ['class' => 'control-label']) !!}
                    {!! Form::text('received_by', old('received_by') , ['class' => 'form-control', 'placeholder' => 'Input the Received By']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('date_received', trans('Date Received'), ['class' => 'control-label']) !!}
                    {!! Form::text('date_received', old('date_received') , ['class' => 'form-control', 'placeholder' => 'Input the Date Received']) !!}
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('instruction', trans('Instruction'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('instruction', old('instruction') , ['class' => 'form-control', 'placeholder' => 'Input the Instruction', 'rows' => '3x6']) !!}
                </div>
            </div>
		</div>
	</div>
</div>