<div class="tab-pane" id="contact">
	<div class="element-wrapper">
		<div class="element-box">
			<div class="form-group">
				{!! Form::label('surname', trans('Surname'), ['class' => 'control-label']) !!}
				{!! Form::text('surname', null, [ 'class' => 'form-control', 'placeholder' => 'Surname' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('given_name', trans('Given Name'), ['class' => 'control-label']) !!}
				{!! Form::text('given_name', null, [ 'class' => 'form-control', 'placeholder' => 'given_name' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('email', trans('Email'), ['class' => 'control-label']) !!}
				{!! Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'email' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
				{!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'title' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('phone', trans('Phone'), ['class' => 'control-label']) !!}
				{!! Form::text('phone', null, [ 'class' => 'form-control', 'placeholder' => 'phone' ]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('fax', trans('Fax'), ['class' => 'control-label']) !!}
				{!! Form::text('fax', null, [ 'class' => 'form-control', 'placeholder' => 'fax' ]) !!}
			</div>
		</div>
	</div>
</div>