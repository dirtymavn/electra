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
			<th>Customer No</th>
			<th>Company Name</th>
			<th>Salutation</th>
			<th>Sales ID</th>
			<th>Customer Group ID</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $customers as $i =>  $customer )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $customer->customer_no }}</td>
			<td>{{ $customer->customer_name }}</td>
			<td>{{ $customer->salutation }}</td>
			<td>{{ $customer->sales_id }}</td>
			<td>{{ $customer->customer_group_id }}</td>
			<td>{{ $customer->status }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>