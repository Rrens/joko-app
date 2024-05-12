<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\Transaction;
use Illuminate\Http\Request;

class transactionController extends Controller
{

    public function category_product()
    {
        $data = ProductCategories::all();
        return $data;
    }
    public function transaction_data($date = null, $platform = null, $category = null)
    {
        $query = Transaction::query();

        if ($date != "null" && $date != null) {
            $query->where(function ($q) use ($date) {
                $q->whereDate('created_at', $date)
                    ->orWhereDate('updated_at', $date);
            });
        }

        if ($platform != "null" && $platform != null) {
            $query->whereHas('platform', function ($q) use ($platform) {
                $q->where('name', $platform);
            });
        }

        if ($category != "null" && $category != null) {
            $query->whereHas('product.category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        $transaction = $query->with('product', 'platform', 'user')->get();
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

        $platform_data = Platform::all();
        $category_data = $this->category_product();

        return view('website.pages.report.transaction', compact(
            'active',
            'data',
            'platform_data',
            'category_data',
            'total_price',
        ));
    }

    public function filter($date, $platform, $category)
    {
        $active = 'report';
        $data = $this->transaction_data($date, $platform, $category)['transaction'];
        $total_price = $this->transaction_data($date, $platform, $category)['total_price'];
        $date_now = $date;

        $platform_data = Platform::all();
        $category_data = $this->category_product();
        return view('website.pages.report.transaction', compact(
            'active',
            'data',
            'date_now',
            'platform_data',
            'category_data',
            'platform',
            'category',
            'total_price',
        ));
    }
}
