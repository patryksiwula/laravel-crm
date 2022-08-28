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
			<td>{{ __('Company name') }}</td>
			<td style="text-align: right; text-transform: uppercase;">{{ __('Invoice') }}</td>
		</tr>
		<tr>
			<td style="padding-top: 20px; line-height: 24px;">
				{{ __('32133 Random street') }} <br>
				{{ __('New York, NY 12210') }}
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
					<td>{{ __('Invoice #') }}</td>
					<td>{{ $invoice->invoice_number }}</td>
				</tr>
				<tr>
					<td>{{ __('Invoice date') }}</td>
					<td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d.m.Y') }}</td>
				</tr>
				<tr>
					<td>{{ __('Sale date') }}</td>
					<td>{{ \Carbon\Carbon::parse($invoice->sale_date)->format('d.m.Y') }}</td>
				</tr>
				<tr>
					<td>{{ __('Due date') }}</td>
					<td>{{ \Carbon\Carbon::parse($invoice->sale_date)->format('d.m.Y') }}</td>
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
				@foreach ($invoice->products as $key => $product)
					<tr>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: center;">{{ $key + 1 }}</td>
						<td style="padding: 10px 20px; border: 1px solid black;">{{ $product->name }}</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">{{ $product->price }}</td>
						<td style="padding: 10px 20px; border: 1px solid black; text-align: right;">{{ $product->quantity }}</td>
					</tr>
				@endforeach

				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ __('Subtotal') }}</td>
					<td style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">145.00</td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">{{ __('VAT 23%') }}</td>
					<td style="padding: 10px 20px; border-right: 1px solid black; text-align: right;">33.35</td>
				</tr>
				<tr>
					<td colspan="3" style="padding: 10px 20px; border-right: 1px solid black; text-align: right; font-size: 22px; font-weight: bold;">{{ __('Total') }}</td>
					<td style="padding: 10px 20px; border: 1px solid black; text-align: right; background-color: #E6E6E6; font-size: 22px; font-weight: bold;">178.35</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>