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
			<th>Order No</th>
			<th>Customer Name</th>
			<th>Tour Name</th>
			<th>Depart Date</th>
			<th>Tour Date</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $tourorders as $i =>  $tourorder )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $tourorder->order_no }}</td>
			<td>{{ $tourorder->customer_name }}</td>
			<td>{{ $tourorder->tour_name }}</td>
			<td>{{ $tourorder->depart_date }}</td>
			<td>{{ $tourorder->tour_date }}</td>
			<td>{{ $tourorder->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>