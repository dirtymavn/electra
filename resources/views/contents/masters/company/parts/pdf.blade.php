<table style="width: 100%">
	<thead>
		<tr>
			<td>No.</td>
			<td>Name</td>
			<td>Address</td>
			<td>Phone</td>
			<td>Tax</td>
		</tr>
	</thead>
	<tbody>
		@foreach( $companies as $company )
		<tr>
			<td>{{ $company->id }}</td>
			<td>{{ $company->name }}</td>
			<td>{{ $company->address }}</td>
			<td>{{ $company->phone }}</td>
			<td>{{ $company->tax }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>