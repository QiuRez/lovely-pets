<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PetController extends Controller
{
    public function pet()
    {
        return Inertia::render('Pet');
    }

    public function list()
    {
        return Inertia::render('PetList');
    }
}
