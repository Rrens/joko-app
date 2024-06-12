<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">No</th>
            <th style="font-weight: bold;">Kategori</th>
            <th style="font-weight: bold;">Total Produk Terjual</th>
            <th style="font-weight: bold;">Total Penjualan</th>
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
                    {{ $item->product[0]->category[0]->name }}
                </td>
                <td style="width: 250px;">
                    {{ $item->quantity }}
                </td>
                <td style="width: 180px;">{{ round($item->total_price) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
            <td>{{ round($totalPrice) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
