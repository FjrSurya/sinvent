<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Brmasuk;
use App\Models\Brkeluar;


class DashboardController extends Controller
{
    public function index() {
        return view('v_dashboard.index');
    }
}