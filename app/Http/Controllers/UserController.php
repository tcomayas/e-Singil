<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ListingController;

class UserController extends Controller
{

    // Show Register/Create Form
    public function create(){
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
{
    $request->validate([
        // ... other validation rules
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'phone' => 'required|regex:/^[a-zA-Z0-9\s\-\+\(\)]*$/|min:10',
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->address = $request->input('address');
    $user->phone = $request->input('phone');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));

    // Handle file upload
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoName = time() . '.' . $photo->getClientOriginalExtension();

        // Store the photo in the file directory
        $photo->storeAs('public/images', $photoName);

        // Save the photo name to the database
        $user->photo = $photoName;
    }

    $user->save();

    return redirect('/')->with(['message' => "Registered Successfully!", 'icon' => "Success", 'title' => "SUCCESS"]);
}

    // Logout User
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with(['message' => "You have been logged out!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    // Show Login Form
    public function login(){
        return view('users.login')->with(['message' => "Login Success!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    // Authenticate User
    public function authenticate(Request $request) {
        // Use $request->input() to get parameters from the GET request
        $queryParameters = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($queryParameters)) {
            $role = Auth::user()->role;

            if ($role == '1') {

                return view('dashboard', ['message' => "Login Successfully!", 'icon' => 'success', 'title' => 'SUCCESS',
                    'listings' => Listing::latest()->filter($request->only(['sizes', 'search']))->paginate(10)
                ]);
            }
            if ($role == '0') {
                return view('debtor', ['message' => "Login Successfully!", 'icon' => 'Success', 'title' => 'SUCCESS',
                    'listings' => Listing::latest()->filter($request->only(['sizes', 'search']))->paginate(10)
                ]);
            }

            return back()->withErrors(['email' => 'Invalid Credentials'])->withInput($request->only('email'));
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput($request->only('email'));
    }


    public function showProfile(){
        $user = auth()->user();
        $carts = Carts::with('listing')->where('user_id', Auth::user()->id)->get();

        // Pass the user data to the view
        return view('profile.show', ['user' => $user, 'carts' => $carts]);
    }


}
