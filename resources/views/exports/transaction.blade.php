<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">No</th>
            <th style="font-weight: bold;">Nama Customer</th>
            <th style="font-weight: bold;">Nama Barang</th>
            <th style="font-weight: bold;">Kategori</th>
            <th style="font-weight: bold;">QTY</th>
            <th style="font-weight: bold;">Harga Satuan</th>
            <th style="font-weight: bold;">Platform</th>
            <th style="font-weight: bold;">Total Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($data as $item)
            @php
                $totalPrice += $item->total_price;
            @endphp
            <tr>
                <td style="width: 30px;">{{ $loop->iteration }}</td>
                <td style="width: 250px;">
                    {{ $item->name_customer . '    ' . $item->acc_number . '    ' . $item->area }}
                </td>
                <td style="width: 180px;">{{ $item->product[0]->name }}</td>
                <td style="width: 180px;">{{ $item->product[0]->category[0]->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td style="width: 100px;">{{ round($item->product[0]->price) }}</td>
                <td style="width: 100px;">
                    {{ !empty($item->platform[0]) ? $item->platform[0]->name : $item->platform_user[0]->name }}</td>
                <td style="width: 100px;">{{ round($item->total_price) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7" style="text-align: right; font-weight: bold;">Total:</td>
            <td>{{ round($totalPrice) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
