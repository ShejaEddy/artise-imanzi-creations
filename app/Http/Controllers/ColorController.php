<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductColors;

class ColorController extends Controller
{
    // GET TAGS
    public function getProductColors()
    {
        $colors = ProductColors::all();
        return response()->json($colors);
    }
}
