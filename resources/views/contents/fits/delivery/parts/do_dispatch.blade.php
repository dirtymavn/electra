<div class="element-wrapper">
	<div class="element-box">
		<div class="row">
			<div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('despatch_staff', trans('Despatch Staff'), ['class' => 'control-label']) !!}
                    {{-- {!! Form::number('despatch_staff', old('despatch_staff') , ['class' => 'form-control', 'placeholder' => 'Input the Despatch Staff']) !!} --}}
                    {!! Form::select('despatch_staff', ['' => 'Choose Despatch Staff'], old('despatch_staff'), ['class' => 'form-control', 'id' => 'despatch_staff']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('despatch_time', trans('Despatch Time'), ['class' => 'control-label']) !!}
                    {!! Form::date('despatch_time', old('despatch_time') , ['class' => 'form-control', 'placeholder' => 'Input the Despatch Time']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('related_so', trans('Related SO'), ['class' => 'control-label']) !!}
                    {!! Form::text('related_so', old('related_so') , ['class' => 'form-control', 'placeholder' => 'Input the Related SO']) !!}
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
                    {!! Form::label('to_delivery', trans('To Delivery'), ['class' => 'control-label']) !!}
                    {{-- {!! Form::text('to_delivery', old('to_delivery') , ['class' => 'form-control', 'placeholder' => 'Input the To Delivery']) !!} --}}
                    {!! Form::select('to_delivery', ['' => 'Choose To Delivery'], old('to_delivery'), ['class' => 'form-control', 'id' => 'to_delivery']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('to_collect', trans('To Collect'), ['class' => 'control-label']) !!}
                    {{-- {!! Form::text('to_collect', old('to_collect') , ['class' => 'form-control', 'placeholder' => 'Input the To Collect']) !!} --}}
                    {!! Form::select('to_collect', ['' => 'Choose To Collect'], old('to_collect'), ['class' => 'form-control', 'id' => 'to_collect']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('received_by', trans('Received By'), ['class' => 'control-label']) !!}
                    {{-- {!! Form::text('received_by', old('received_by') , ['class' => 'form-control', 'placeholder' => 'Input the Received By']) !!} --}}
                    {!! Form::select('received_by', ['' => 'Choose Received By'], old('received_by'), ['class' => 'form-control', 'id' => 'received_by']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('date_received', trans('Date Received'), ['class' => 'control-label']) !!}
                    {!! Form::date('date_received', old('date_received') , ['class' => 'form-control', 'placeholder' => 'Input the Date Received']) !!}
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