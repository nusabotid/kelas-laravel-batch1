<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $devices = Device::all();

        return view('dashboard.index', [
            "devices" => $devices,
        ]);
    }
}
