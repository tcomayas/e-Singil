<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    // public function listingsChart()
    // {
    //     $listings = Listing::all();

    //     $chart = Charts::create('bar', 'highcharts')
    //         ->title('Listings Chart')
    //         ->labels($listings->pluck('product')->toArray())
    //         ->values($listings->pluck('quantity')->toArray())
    //         ->responsive(true);

    //     return view('components.chart', compact('chart'));
    // }

    public function index(){
        $listings = DB::table('listings')
            ->select('product as prodname', DB::raw('count(price) as votes'))
            ->groupBy('prodname')
            ->get();

        return view('/components/chart', compact('listings'));
    }


}

