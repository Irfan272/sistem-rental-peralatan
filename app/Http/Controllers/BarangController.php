<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(){
        return view("admin.master_data.barang.index");
    }

    public function create(){
        return view("admin.master_data.barang.create");
    }
}
