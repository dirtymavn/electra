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
			<th>Category Name</th>
			<th>Category Code</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $categories as $i =>  $category )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $category->product_type_name }}</td>
			<td>{{ $category->product_type_code }}</td>
			<td>{{ $category->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>