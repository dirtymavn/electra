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
			<th>GST Code</th>
			<th>GST Percent</th>
			<th>ABSORB PPN</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		@foreach( $gsts as $i =>  $gst )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $gst->gst_code }}</td>
			<td>{{ $gst->gst_percent }}</td>
			<td>{{ $gst->absorb_ppn }}</td>
			<td>{{ $gst->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>