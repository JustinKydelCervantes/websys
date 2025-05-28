<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Card</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        .center-text {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="center-text">
        <p>General Form No. <br>
        Revised </p>
    </div>

    <h2 class="center-text">STOCK CARD</h2>
    <h4 class="center-text">PSU-Urdaneta Campus</h4>
    <h5 class="center-text">Agency</h5>

    <table>
        <tr>
            <td colspan="2" class="bold">Item: 
                <span style="font-weight:normal;">{{ $item->item_name }}</span>
            </td>
            <td colspan="2" class="bold">Description: 
                <span style="font-weight:normal;">{{ $item->item_description }}</span>
            </td>
            <td class="bold">Stock #:</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <td colspan="3" class="bold"></td>
                <td colspan="2" class="bold">ISSUANCE</td>
                <td colspan="2" class="bold"></td>
            </tr>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Receipt Qty</th>
                <th>Issuance Qty</th>
                <th>Office</th>
                <th>Balance Qty</th>
                <th>No. of Days Consume</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = [];

                foreach ($stocks as $stock) {
                    $ref = $stock->reference ?? 'no-ref-' . $stock->id;
                    $grouped[$ref]['date'] = $stock->created_at->format('Y-m-d');
                    $grouped[$ref]['reference'] = $stock->reference;
                    $grouped[$ref]['receipt_qty'] = $stock->receipt_qty ?? $stock->quantity;
                    $grouped[$ref]['balance_qty'] = $stock->quantity;
                    $grouped[$ref]['no_of_days'] = $stock->no_of_days_consume ?? '';
                }

                foreach ($issuances as $issuance) {
                    $ref = $issuance->reference ?? 'no-ref-' . $issuance->id;
                    $grouped[$ref]['date'] = $issuance->created_at->format('Y-m-d');
                    $grouped[$ref]['reference'] = $issuance->reference;
                    $grouped[$ref]['issuance_qty'] = $issuance->qty_issued;
                    $grouped[$ref]['office'] = $issuance->office;
                    $grouped[$ref]['balance_qty'] = $issuance->balance_qty;
                    $grouped[$ref]['no_of_days'] = $issuance->no_of_days ?? '';
                }
            @endphp

            @foreach ($grouped as $entry)
                <tr>
                    <td>{{ $entry['date'] ?? '' }}</td>
                    <td>{{ $entry['reference'] ?? '' }}</td>
                    <td>{{ $entry['receipt_qty'] ?? '' }}</td>
                    <td>{{ $entry['issuance_qty'] ?? '' }}</td>
                    <td>{{ $entry['office'] ?? '' }}</td>
                    <td>{{ $entry['balance_qty'] ?? '' }}</td>
                    <td>{{ $entry['no_of_days'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
