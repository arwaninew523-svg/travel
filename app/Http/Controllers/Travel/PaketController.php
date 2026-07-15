<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PaketController extends Controller
{
    public function index() {

        return Inertia::render('admin/paket/Index');
    }
}
