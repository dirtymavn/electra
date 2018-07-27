<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>
<table style="width: 100%;">
	<thead>
		<tr>
			<th>No.</th>
			<th>Passenger Class Name</th>
			<th>Passenger Class Code</th>
			<th>Passenger Class Type</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $passengers as $i =>  $passenger )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $passenger->passenger_class_name }}</td>
			<td>{{ $passenger->passenger_class_code }}</td>
			<td>{{ $passenger->passenger_class_type }}</td>
			<td>{{ $passenger->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>