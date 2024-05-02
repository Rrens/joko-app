<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MasterProductController extends Controller
{
    public function index()
    {
        $active = 'master-barang';
        return view('website.pages.master.barang', compact('active'));
    }
}
