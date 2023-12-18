<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

    // public function index(){
    //     $categoryCounts = Cart::join('listings', 'carts.listing_id', '=', 'listings.id')
    //         ->select('listings.category', DB::raw('count(listings.category) as category_count'))
    //         ->groupBy('listings.category')
    //         ->get();

    //     // return view('/components/chart', compact('listings'));
    //     return dd($categoryCounts);
    // }


}

