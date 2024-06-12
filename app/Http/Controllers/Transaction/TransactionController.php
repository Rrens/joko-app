<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use App\Models\Products;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    public function input()
    {
        $active = 'transaction';
        $transaction_active = 'input';

        $products = Products::all();
        $platforms = Platform::all();

        return view('website.pages.transaction', compact(
            'active',
            'transaction_active',
            'products',
            'platforms',
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'platformID' => 'required|exists:platforms,id',
            'productID' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'name_customer' => 'required',
            'acc_number' => 'required|numeric',
            'area' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }
        $product = Products::findOrFail($request->productID);

        if ($request->quantity > $product->quantity) {
            Alert::toast('Quantity must not exceed stock', 'error');
            return back();
        }

        $data = new Transaction();
        $data->productID = $request->productID;
        $data->platformID = $request->platformID;
        $data->quantity = $request->quantity;
        $data->total_price = $request->quantity * Products::find($request->productID)->price;
        $data->userID = Auth::user()->id;
        $data->name_customer = $request->name_customer;
        $data->acc_number = $request->acc_number;
        $data->area = $request->area;
        $data->save();

        $product->quantity -= $request->quantity;
        $product->save();

        Alert::toast('Success Add Data', 'success');
        return back();
    }

    public function data()
    {
        $active = 'transaction';
        $transaction_active = 'data';

        $data = Transaction::whereDate('created_at', now()->today())
            ->where('userID', Auth::user()->id)
            ->with('product', 'platform', 'user')->get();
        $products = Products::all();
        $platforms = Platform::all();

        return view('website.pages.transaction', compact('active', 'transaction_active', 'data', 'products', 'platforms'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:transactions,id',
            'platformID' => 'required|exists:platforms,id',
            'productID' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'name_customer' => 'required',
            'acc_number' => 'required|numeric',
            'area' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        $temp_quantity = 0;

        $product = Products::findOrFail($request->productID);

        if ($request->quantity > $product->quantity) {
            Alert::toast('Quantity must not exceed stock', 'error');
            return back();
        }

        $data = Transaction::where('id', $request->id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        $temp_quantity = $product->quantity - $request->quantity;

        $data->productID = $request->productID;
        $data->platformID = $request->platformID;
        $temp_quantity += $request->temp_quantity;
        $data->quantity = $request->quantity;
        $data->total_price = $request->quantity * Products::find($request->productID)->price;
        $data->userID = Auth::user()->id;
        $data->name_customer = $request->name_customer;
        $data->acc_number = $request->acc_number;
        $data->area = $request->area;
        $data->save();

        $product->quantity = $temp_quantity;
        $product->save();

        Alert::toast('Success Update Data', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:transactions,id'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        $transaction = Transaction::where('id', $request->id)->first();
        $product = Products::where('id', $transaction->productID)->first();

        $product->quantity += $transaction->quantity;
        $product->save();
        $transaction->delete();

        Alert::toast('Success Delete Data', 'success');
        return back();
    }
}
