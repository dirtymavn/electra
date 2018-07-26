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
			<th>Voucher Date</th>
			<th>Valid From</th>
			<th>Valid To</th>
			<th>Cust No</th>
			<th>Cust Name</th>
			<th>Cust Address</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $vouchers as $voucher )
		<tr>
			<td>{{ $voucher->id }}</td>
			<td>{{ $voucher->voucher_no }}</td>
			<td>{{ $voucher->voucher_date }}</td>
			<td>{{ $voucher->valid_from }}</td>
			<td>{{ $voucher->valid_to }}</td>
			<td>{{ $voucher->cust_no }}</td>
			<td>{{ $voucher->cust_name }}</td>
			<td>{{ $voucher->cust_address }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>