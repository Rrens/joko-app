<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    public function index()
    {
        $active = 'master-user';
        return view('website.pages.master.user', compact('active'));
    }
}
