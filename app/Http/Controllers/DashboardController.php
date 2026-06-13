<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;

class DashboardController extends Controller
{
    public function index()
    {
        $warehouse = Warehouse::first();

        return view('pages.admin.dashboard', compact('warehouse'));
    }
}
