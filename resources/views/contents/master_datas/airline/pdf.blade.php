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
			<th>Airline Name</th>
			<th>Airline Code</th>
			<th>Airline Class</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $airlines as $i =>  $airline )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $airline->airline_name }}</td>
			<td>{{ $airline->airline_code }}</td>
			<td>{{ $airline->airline_class }}</td>
			<td>{{ $airline->status }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>