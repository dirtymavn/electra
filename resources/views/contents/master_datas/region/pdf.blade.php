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
			<th>Region Name</th>
			<th>Region Code</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $regions as $i =>  $region )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $region->region_name }}</td>
			<td>{{ $region->region_code }}</td>
			<td>{{ $region->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>