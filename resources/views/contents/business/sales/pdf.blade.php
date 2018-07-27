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
			<th>Sales No</th>
			<th>Customer ID</th>
			<th>Trip Date</th>
			<th>Deadline</th>
			<th>Invoice No</th>
			<th>Sale Date</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $saless as $i =>  $sales )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $sales->sales_no }}</td>
			<td>{{ $sales->customer->customer_name }}</td>
			<td>{{ $sales->trip_date }}</td>
			<td>{{ $sales->deadline }}</td>
			<td>{{ $sales->invoice_no }}</td>
			<td>{{ $sales->sale_date }}</td>
			<td>{{ $sales->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>