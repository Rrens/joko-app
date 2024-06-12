<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">No</th>
            <th style="font-weight: bold;">Platform</th>
            <th style="font-weight: bold;">Penjualan Sebelum Admin</th>
            <th style="font-weight: bold;">Penjualan Setelah Admin</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($data as $item)
            @php
                if (!empty($item->platform[0] && !empty($item->platform[0]->admin_cost))) {
                    $priceAfterAdmin = round($item->total_price * $item->platform[0]->admin_cost);
                } else {
                    $priceAfterAdmin = round($item->total_price);
                }
                $totalPrice += $priceAfterAdmin;
            @endphp
            <tr>
                <td style="width: 30px;">{{ $loop->iteration }}</td>
                <td style="width: 250px;">
                    {{ !empty($item->platform[0]) ? $item->platform[0]->name : $item->platform_user[0]->name }}
                </td>
                <td style="width: 180px;">{{ round($item->total_price) }}</td>
                @if (!empty($item->platform[0] && !empty($item->platform[0]->admin_cost)))
                    <td style="width: 180px;">{{ round($item->total_price * $item->platform[0]->admin_cost) }}</td>
                @else
                    <td style="width: 180px;">{{ round($item->total_price) }}</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold;">Total:</td>
            <td>{{ round($totalPrice) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
