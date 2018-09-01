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
			<th>Invoice Number</th>
			<th>Invoice Status</th>
			<th>Invoice Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $types as $i =>  $type )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $type->invoice_no }}</td>
			<td>{{ $type->invoice_status }}</td>
			<td>{{ $type->invoice_date }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>