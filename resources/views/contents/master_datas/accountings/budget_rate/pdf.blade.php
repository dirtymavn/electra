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
			<td>Acc Period MO</td>
			<td>From Currency</td>
			<td>To Currency</td>
			<td>Exchange Rate</td>
			<td>Created At</td>
		</tr>
	</thead>
	<tbody>
		@foreach( $trxs as $i =>  $trx )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $trx->acc_period_mo }}</td>
			<td>{{ $trx->from_currency }}</td>
			<td>{{ $trx->exchange_rate }}</td>
			<td>{{ $trx->created_at }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>