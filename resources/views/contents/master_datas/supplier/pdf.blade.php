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
			<th>Supplier No</th>
			<th>Supplier Type</th>
			<th>Name</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $suppliers as $i =>  $supplier )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $supplier->supplier_no }}</td>
			<td>{{ $supplier->supplier_type }}</td>
			<td>{{ $supplier->name }}</td>
			<td>{{ $supplier->status }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>