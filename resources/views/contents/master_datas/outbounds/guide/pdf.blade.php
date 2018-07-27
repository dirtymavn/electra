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
			<th>Start Date</th>
			<th>Tour Code</th>
			<th>Status</th>
			<th>Remark</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $guides as $i =>  $guide )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ date('d/m/Y', strtotime($guide->start_date)) }}</td>
			<td>{{ $guide->tour_code }}</td>
			<td>{{ $guide->status }}</td>
			<td>{{ $guide->remark }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>