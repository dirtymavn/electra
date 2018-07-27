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
			<th>Voucher No</th>
			<th>Product Code</th>
			<th>Received Date</th>
			<th>Booked</th>
			<th>Sold</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $inventories as $i =>  $inventory )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $customer->voucher_no }}</td>
			<td>{{ $customer->product_code }}</td>
			<td>{{ $customer->received_date }}</td>
			<td>{{ $customer->booked }}</td>
			<td>{{ $customer->sold }}</td>
			<td>{{ $customer->status }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>