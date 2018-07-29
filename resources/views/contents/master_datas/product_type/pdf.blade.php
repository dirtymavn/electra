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
			<th>Product Type Name</th>
			<th>Product Type Code</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $types as $i =>  $type )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $type->product_type_name }}</td>
			<td>{{ $type->product_type_code }}</td>
			<td>{{ $type->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>