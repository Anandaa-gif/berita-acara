<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Maintenance;
use App\Models\Vendor;
use App\Models\Backbone;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_ba' => BeritaAcara::count(),
            'total_maintenance' => Maintenance::count(),
            'total_vendor' => Vendor::count(),
            'total_backbone' => Backbone::count(),
        ];

        $recent_ba = BeritaAcara::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recent_ba'));
    }
}
