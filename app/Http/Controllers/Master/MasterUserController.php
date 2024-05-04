<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MasterUserController extends Controller
{
    public function index()
    {
        $active = 'master-user';
        $data = User::all();
        return view('website.pages.master.user', compact('active', 'data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|max:255|min:5'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);
        $data = new User();
        $data->fill($request->all());
        $data->password = Hash::make($request->password);
        $data->save();

        Alert::toast('Success Save Data', 'success');
        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|exists:users,email',
            'password' => 'nullable|max:255|min:5'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back()->withInput();
        }

        unset($request['_token']);
        $data = User::where('email', $request->email)->first();
        $data->fill($request->all());
        if ($request->has('password')) {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        Alert::toast('Success Update Data', 'success');
        return back();
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        User::where('email', $request->email)->delete();

        Alert::toast('Success Deleted Data', 'success');
        return back();
    }
}
