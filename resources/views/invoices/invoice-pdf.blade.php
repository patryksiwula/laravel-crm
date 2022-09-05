<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Invoice PDF</title>
</head>
<body style="width: 100%; padding: 0px; font-family: sans-serif;">
	<table style="display: table; width: 100%;">
		<tr>
			<td style="font-size: 24px; font-weight: bold;">{{ $configs->get(0)->value }}</td>
			<td style="text-align: right; font-size: 24px; font-weight: bold; text-transform: uppercase;">{{ __('Invoice') }}</td>
		</tr>
		<tr>
			<td>
				{{ __('VAT: ') }} <span style="font-weight: bold;">{{ $configs->get(3)->value }}</span>
			</td>
		</tr>
		<tr>
			<td style="padding-top: 20px; line-height: 24px;">
				{!! $configs->get(2)->value !!}
			</td>
		</tr>
	</table>

	<div style="margin-top: 100px;">
		<div style="float: left; width: 70%;">
			<table style="display: table; width: 100%;">
				<tr>
					<td style="font-weight: bold;">{{ __('Bill to') }}</td>
					<td style="font-weight: bold;">{{ __('Ship to') }}</td>
				</tr>
				<tr>
					<td>
						Jan Kowalski <br>
						32133 Random street <br>
						New York, NY 12210
					</td>
					<td>
						Jan Kowalski <br>
						32133 Random street <br>
						New York, NY 12210
					</td>
				</tr>
			</table>
		</div>
	
		<div style="float: left; width: 30%;">
			<table style="display: table; width: 100%; text-align: right;">
				<tr>
					<td style="font-weight: bold;">{{ __('Invoice #') }}</td>
					<td>{{ $invoice->invoice_number }}</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">{{ __('Invoice date') }}</td>
					<td>{{ $invoice->invoice_date->format($configs->get(5)->value) }}</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">{{ __('Sale date') }}</td>
					<td>{{ $invoice->sale_date->format($configs->get(5)->value) }}</td>
				</tr>
				<tr>
					<td style="font-weight: bold;">{{ __('Due date') }}</td>
					<td>{{ $invoice->sale_date->format($configs->get(5)->value) }}</td>
				</tr>
			</table>
		</div>
	</div>

	<div style="clear: both; width: 100%; margin-top: 150px;">
		<table style="display: table; border-collapse: collapse; width: 100%;">
			<thead>
				<tr>
					<td style="padding: 20px 20px; border: 1px solid black; border-bottom: 3px solid black; background-color: #E6E6E6;"></td>
					<td style="padding: 20px 20px; border: 1px solid black; border-bottom: 3px solid black; text-transform: uppercase; text-align: center; background-color: #E6E6E6;">{{ __('Product description') }}</td>
					<td style="padding: 20px 20px; border: 1px solid black; border-bottom: 3px solid black; text-transform: uppercase; text-align: center; background-color: #E6E6E6;">{{ __('Unit price') }}</td>
					<td style="padding: 20px 20px; border: 1px solid black; border-bottom: 3px solid black; text-transform: uppercase; text-align: center; background-color: #E6E6E6;">{{ __('Quantity') }}</td>
				</tr>
			</thead>
			<tbody>
				@forelse ($invoice->products as $key => $product)
					<tr>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
						<td style="padding: 10px 20px; border: 1px solid black;">{{ $product->name }}</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">{{ number_format($product->price, 2) }}</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">{{ $product->pivot->quantity }}</td>
					</tr>
				@empty
					<tr>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: center;">&nbsp;</td>
						<td style="padding: 10px 20px; border: 1px solid black;">&nbsp;</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">&nbsp;</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">&nbsp;</td>
					</tr>
				@endforelse

				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ __('Subtotal') }}</td>
					<td style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ number_format($subtotal, 2) }}</td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ __('VAT ') . $configs->get(4)->value }}&percnt;</td>
					<td style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ number_format($tax, 2) }}</td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right; font-size: 22px; font-weight: bold;">
						{{ __('Total') }}
					</td>
					<td style="padding: 10px 20px; border: 1px solid black; text-align: right; background-color: #E6E6E6; font-size: 22px; font-weight: bold;">
						{{ number_format($subtotal + $tax, 2) }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>