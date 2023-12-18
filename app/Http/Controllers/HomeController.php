<?php

namespace App\Http\Controllers;
use App\Models\Listing;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $role = Auth::user()->role;

        if($role == '1'){
            return view('dashboard',  ['message' => "Login Successfully!", 'icon' => "Success", 'title' => "SUCCESS",
                'listings' => Listing::latest()->filter(request(['sizes', 'search']))->paginate(10)
            ]);
        }
        if($role == '0'){
            return view('debtor', ['message' => "Login Successfully!", 'icon' => "Success", 'title' => "SUCCESS",
                'listings' => Listing::latest()->filter(request(['sizes', 'search']))->paginate(10)
            ]);
        }
    }

    public function showListings()
{
    $listings = Listing::all();
    return view('revenue', compact('listings'));
}

}
