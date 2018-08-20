<div class="tab-pane" id="tourfolderdetail">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
			            {!! Form::label('tour_category', trans('Tour category'), ['class' => 'control-label']) !!}
			            {!! Form::select('tour_category', ['local' => 'local', 'asia' => 'asia', 'europe' => 'europe'], old('tour_category'), ['class' => 'form-control']) !!}
			        </div>
					<div class="form-group">
			            {!! Form::label('tour_type', trans('Tour type'), ['class' => 'control-label']) !!}
			            {!! Form::select('tour_type', ['shopping' => 'shopping', 'elderly' => 'elderly', 'ski' => 'ski'], old('tour_type'), ['class' => 'form-control']) !!}
			        </div>
					<div class="form-group">
						{!! Form::label('id_airlines', trans('Airlines'), ['class' => 'control-label']) !!}
						{!! Form::select('id_airlines', ['' => 'Choose airline'] + @$dataairline, old('id_airlines'), ['class' => 'form-control id_airlines', 'id' => 'id_airlines']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('description', trans('Description'), ['class' => 'control-label']) !!}
						{!! Form::text('description', old('description'), [ 'class' => 'form-control', 'placeholder' => 'Input the Description' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('min_capacity', trans('Min capacity'), ['class' => 'control-label']) !!}
						{!! Form::number('min_capacity', old('min_capacity'), [ 'class' => 'form-control', 'placeholder' => 'Input the Min capacity' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('max_capacity', trans('Max capacity'), ['class' => 'control-label']) !!}
						{!! Form::number('max_capacity', old('max_capacity'), [ 'class' => 'form-control', 'placeholder' => 'Input the Max capacity' ]) !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('number_of_days', trans('Days'), ['class' => 'control-label']) !!}
						{!! Form::number('number_of_days', old('number_of_days'), [ 'class' => 'form-control', 'placeholder' => 'Input the Days' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('cut_of_date', trans('Cut of date'), ['class' => 'control-label']) !!}
						{!! Form::date('cut_of_date', old('cut_of_date'), [ 'class' => 'form-control', 'placeholder' => 'Input the Cut of date' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('ticket_dateline', trans('Ticket dateline'), ['class' => 'control-label']) !!}
						{!! Form::date('ticket_dateline', old('ticket_dateline'), [ 'class' => 'form-control', 'placeholder' => 'Input the Ticket dateline' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('deposit_dateline', trans('Deposit dateline'), ['class' => 'control-label']) !!}
						{!! Form::date('deposit_dateline', old('deposit_dateline'), [ 'class' => 'form-control', 'placeholder' => 'Input the Deposit dateline' ]) !!}
					</div>
					<div class="form-group">
						{!! Form::label('id_currency', trans('Currency'), ['class' => 'control-label']) !!}
						{!! Form::select('id_currency', @$datacurrency, old('id_currency'), ['class' => 'form-control id_currency', 'placeholder' => 'Choose Currency', 'id' => 'id_currency']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('origin', trans('Origin'), ['class' => 'control-label']) !!}
						{!! Form::select('origin', ['1' => 'Yes', '0' => 'No'], old('origin'), ['class' => 'form-control']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>