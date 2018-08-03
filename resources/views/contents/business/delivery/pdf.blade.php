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
			<th>DO No</th>
			<th>DO Type</th>
			<th>DO Date</th>
			<th>Team Code</th>
			<th>Sender</th>
			<th>Tel No</th>
			<th>Department Code</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $deliveries as $i =>  $delivery )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $delivery->do_no }}</td>
			<td>{{ $delivery->do_type }}</td>
			<td>{{ $delivery->do_date }}</td>
			<td>{{ $delivery->team_code }}</td>
			<td>{{ $delivery->sender }}</td>
			<td>{{ $delivery->tel_no }}</td>
			<td>{{ $delivery->department_code }}</td>
			<td>{{ $delivery->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>