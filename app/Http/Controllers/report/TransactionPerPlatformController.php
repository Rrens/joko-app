<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionPerPlatformController extends Controller
{
    public function transaction_data($month = null, $year = null)
    {
        $query = Transaction::query();

        if ($month != "null" && $month != null && $year != "null" && $year != null) {
            $query->where(function ($q) use ($month, $year) {
                $q->where(function ($subQ) use ($month, $year) {
                    $subQ->whereMonth('created_at', (int) $month)
                        ->whereYear('created_at', (int) $year);
                });

                $q->orWhere(function ($subQ) use ($month, $year) {
                    $subQ->whereMonth('updated_at', (int) $month)
                        ->whereYear('updated_at', (int) $year);
                });
            });
        } else {
            $month = now()->month;
            $year = now()->year;
            $query->where(function ($q) use ($month, $year) {
                $q->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->orWhereMonth('updated_at', $month)
                    ->orWhereYear('updated_at', $year);
            });
        }

        $transaction = $query->selectRaw('*, SUM(total_price) as total_price')
            ->with('product', 'platform', 'user')
            ->groupBy('platformID')
            ->get();

        $total_price = $transaction->sum('total_price');

        return [
            'transaction' => $transaction,
            'total_price' => $total_price
        ];
    }

    public function index()
    {
        $active = 'report';

        $data = $this->transaction_data()['transaction'];
        $total_price = $this->transaction_data()['total_price'];
        return view('website.pages.report.transaction-platform', compact('active', 'data', 'total_price'));
    }

    public function filter($month, $year)
    {
        $active = 'report';

        $data = $this->transaction_data($month, $year)['transaction'];
        $total_price = $this->transaction_data($month, $year)['total_price'];
        return view('website.pages.report.transaction-platform', compact(
            'active',
            'data',
            'total_price',
            'month',
            'year',
        ));
    }
}
