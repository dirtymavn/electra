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
			<th>Itinary Code</th>
			<th>Itinary Name</th>
			<th>Branch ID</th>
			<th>Remark</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $itins as $i =>  $itin )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $itin->itinary_code }}</td>
			<td>{{ $itin->itinary_name }}</td>
			<td>{{ $itin->branch_id }}</td>
			<td>{{ $itin->remark }}</td>
			<td>{{ $itin->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>