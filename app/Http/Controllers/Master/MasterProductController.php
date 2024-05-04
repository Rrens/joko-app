<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MasterProductController extends Controller
{
    public function index()
    {
        $active = 'master-barang';
        $data = Products::orderBy('created_at', 'DESC')->get();
        return view('website.pages.master.barang', compact('active', 'data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => "required|integer"
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);
        $data = new Products();
        $data->fill($request->all());
        $data->save();

        Alert::toast('Success Add Data', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => "required|integer"
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);
        $data = Products::findOrFail($request->id);
        $data->update($request->all());

        Alert::toast('Success Update Data', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        Products::where('id', $request->id)->delete();

        Alert::toast('Success Delete Data', 'success');
        return back();
    }
}
