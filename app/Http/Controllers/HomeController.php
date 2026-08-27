<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $packages = TourPackage::where('is_active', true)
            ->latest()
            ->get();

        return Inertia::render('Welcome', [
            'packages' => $packages,
        ]);
    }
}
