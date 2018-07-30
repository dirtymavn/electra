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
			<th>Product Code</th>
			<th>Product Name</th>
			<th>Status</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $codes as $i =>  $code )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $code->product_code }}</td>
			<td>{{ $code->product_name }}</td>
			<td>{{ $code->status }}</td>
			<td>{{ $code->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>