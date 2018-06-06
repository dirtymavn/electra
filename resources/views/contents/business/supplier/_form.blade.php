<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			{!! Form::label('supplier_no', trans('Supplier No.'), ['class' => 'control-label']) !!}
			{!! Form::text('supplier_no', null, [ 'class' => 'form-control', 'id' => 'supplier_no', 'placeholder' => 'Supplier No' ]) !!}
			
		</div>
		<div class="form-group">
			{!! Form::label('supplier_type', trans('Supplier Type'), ['class' => 'control-label']) !!}
			{!! Form::text('supplier_type', null, [ 'class' => 'form-control', 'id' => 'supplier_type', 'placeholder' => 'Supplier Type' ]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
			{!! Form::text('name', null, [ 'class' => 'form-control', 'placeholder' => 'Name' ]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
			{!! Form::textarea('address', null, [ 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '3x2' ]) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			{!! Form::label('hotel_vendor_flag', trans('Hotel Vendor Flag'), ['class' => 'control-label']) !!}
			{!! Form::select('hotel_vendor_flag', ['1' => 'Active', '0' => 'Non Active'], old('hotel_vendor_flag'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('sundry_profile_flag', trans('Hotel Vendor Flag'), ['class' => 'control-label']) !!}
			{!! Form::select('sundry_profile_flag', ['1' => 'Active', '0' => 'Non Active'], old('sundry_profile_flag'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('sundry_profile_flag', trans('Hotel Vendor Flag'), ['class' => 'control-label']) !!}
			{!! Form::select('status', ['active' => 'Active', 'non_active' => 'Non Active'], old('status'), ['class' => 'form-control']) !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="os-tabs-w">
			<div class="os-tabs-controls">
				<ul class="nav nav-tabs smaller">
					<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#main">Main</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Contact</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#term">Bank</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#finance">Bank CRPD</a></li>
				</ul>
			</div>
			<div class="tab-content">
				@include('contents.business.supplier.parts.main')

				@include('contents.business.supplier.parts.contact')

				@include('contents.business.supplier.parts.bank')

				@include('contents.business.supplier.parts.bank_crpd')
			</div>
		</div>
	</div>
</div>

