<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MasterPlatformController extends Controller
{
    public function index()
    {
        $active = 'platform';
        $data = Platform::all();
        return view('website.pages.master.platform', compact('active', 'data'));
    }

    public function store(Request $request)
    {
        $request['name'] = strtolower($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        if ($this->check_platform_empty($request->name)) {
            Alert::toast('Platform Already Taken!', 'error');
            return back();
        }

        unset($request['_token']);
        $data = new Platform();
        $data->fill($request->all());
        $data->save();

        Alert::toast('Success Add Data', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $request['name'] = strtolower($request['name']);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required|exists:platforms,id'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        if ($this->check_platform_empty($request->name)) {
            Alert::toast('Platform Already Taken!', 'error');
            return back();
        }

        Platform::where('id', $request->id)->update(['name' => $request->name]);

        Alert::toast('Success Update Data', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:platforms,id'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        Platform::where('id', $request->id)->delete();

        Alert::toast('Success Delete Data', 'success');
        return back();
    }

    public function check_platform_empty($request)
    {
        $data_for_check = Platform::where('name', $request)->whereNull('deleted_at')->first();
        if (!empty($data_for_check['name'])) {
            return true;
        }

        return false;
    }
}
