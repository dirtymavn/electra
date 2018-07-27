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
			<td>Invoice Flag</td>
			<td>Letter Of Guarantee Flag</td>
			<td>Credit Not Flag</td>
			<td>Deposit Overpayment Flag</td>
			<td>Ap Deposit Flag</td>
			<td>Cash Account Flag</td>
			<td>Bank Account Flag</td>
			<td>Other Account Flag</td>
			<td>JV Period</td>
			<td>Acc Type</td>
			<td>FX Acc</td>
		</tr>
	</thead>
	<tbody>
		@foreach( $trxs as $i =>  $trx )
		<tr>
			<td>{{ $i + 1 }}</td>
			<td>{{ $trx->invoice_flag }}</td>
			<td>{{ $trx->credit_not_flag }}</td>
			<td>{{ $trx->deposit_overpayment_flag }}</td>
			<td>{{ $trx->ap_deposit_flag }}</td>
			<td>{{ $trx->cash_account_flag }}</td>
			<td>{{ $trx->bank_account_flag }}</td>
			<td>{{ $trx->other_account_flag }}</td>
			<td>{{ $trx->jv_period }}</td>
			<td>{{ $trx->acc_type }}</td>
			<td>{{ $trx->fx_acc }}</td>
		</tr>
		@endforeach	
	</tbody>
</table>