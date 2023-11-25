<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Listing;
use App\Models\TotalDebt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // Show all listings
    public function index(){
        $role = Auth::user()->role;
        $listings = Listing::latest()->filter(request(['sizes', 'search']))->paginate(10);
        if($role == '1'){
            return view('users.listings.index', [
                'listings' => $listings
            ]);
        }
        else{
            return view('debtor', [
                'listings' => $listings
            ]);
        }
    }

    // Show all inventory
    public function display(){
        return view('users.listings.inventory', [
            'listings' => Listing::latest()->filter(request(['sizes', 'search', 'expiry', 'category', 'product', 'quantity']))->paginate(10)
        ]);
    }

    // Show all Products
    public function getProducts(){
        return view('users.listings.product', [
            'listings' => Listing::latest()->filter(request(['sizes', 'search', 'expiry', 'category', 'product', 'quantity']))->paginate(10)
        ]);
    }


    // Show Create Forms
    public function create(){
        return view('users.listings.create');
    }

    // Show Single Listing
    public function show(Listing $listing){
        return view('users.listings.show', [
            'listing' => $listing
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'product' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'expiry' => 'required',
            'sizes' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Product created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing){
         return view('users.listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing) {

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'product' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'expiry' => 'required',
            'sizes' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Product updated successfully!');
    }

    public function destroy(Listing $listing){

        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

public function showListings(Listing $listing)
{
    $listings = Listing::all();
    return view('revenue', compact('listings'));
}

public function buyNow(Request $request, $listingId){
    $formFields = $request->validate([
        'quantity' => 'required',
    ]);
    $formFields['user_id'] = auth()->id();
    $formFields['listing_id'] = $listingId;


    Carts::create($formFields);
    $listingQty = Listing::where('id', $listingId)->get('quantity');
    $newQty = $listingQty[0]->quantity - intval($request->quantity);
    $listing = Listing::find($listingId);
    $listing->quantity = $newQty;
    $listing->save();

    // $carts = Carts::with('user')->where('user_id', Auth::user()->id)->get();
    $listings = Listing::all();

    return redirect('')->with(['listings' => $listings]);
}

public function showCart(Carts $cart){
    $carts = Carts::with('listing')->where('user_id', Auth::user()->id)->where('status', 'Pending')->get();

    return view('cart', ['carts' => $carts]);
}

public function showListingsDebtor(Listing $listing){

    $listings = Listing::all();

    return view('debtor', ['listings' => $listings]);
}

public function showDebts(Carts $cart){
    $carts = Carts::where('status', 'Approve')->get();

    return view('debt', ['carts' => $carts]);
}

public function showPending(Carts $cart){
    $carts = Carts::where('status', 'Pending')->get();

    return view('pending', ['carts' => $carts]);
}

public function acceptPending(Request $request, $cartId){
    $cart = Carts::find($cartId);

    if($request->status == "Approve"){
        $price = Listing::where('id', $cart->listing_id)->get('price');
        $total_debt = TotalDebt::where('user_id', $cart->user_id)->limit(1)->orderBy('created_at', 'desc')->get();

        if($total_debt == null || count($total_debt) == 0){
            $newTotalDebt = TotalDebt::create([
                'user_id' => $cart->user_id,
                'totaldebt' => $cart->quantity * $price[0]->price
            ]);
            $newTotalDebt->save();
        }else{
            $newDebt = $cart->quantity * $price[0]->price;
            $tempDebt = $newDebt + $total_debt[0]->totaldebt;

            if($total_debt[0]->status == 'Active'){
                if($tempDebt <= 500){
                    $cart->status = $request->status;

                    $total_debt[0]->totaldebt = $total_debt[0]->totaldebt + $newDebt;
                    $total_debt[0]->save();
                }
                else{
                    return back()->with(['message' => 'CANT PROCEED! DEBT LIMIT HAS BEEN REACHED!', 'icon' => 'warning', 'title' =>
                'LIMIT REACHED']);
                }
            }
            elseif($total_debt[0]->status == 'Complete'){
            $newTotalDebt = TotalDebt::create([
                    'user_id' => $cart->user_id,
                    'totaldebt' => $cart->quantity * $price[0]->price
                ]);

                $newTotalDebt->save();
            }

        }
        return back()->with(['message' => 'Debt Request Approved!', 'icon' => 'success', 'title' => 'APPROVED!']);
    } elseif($request->status == "Cancel"){
        $cart->status = $request->status;
        $cart->save();


        return back()->with(['message' => 'Debt Request Cancelled!', 'icon' => 'warning', 'title' =>
        'CANCELED']);
    }


    $carts = Carts::where('status', 'Pending')->get();

    return back()->with(['carts' => $carts]);
}

public function partialPayment(Request $request, $userId){
    $carts = Carts::find($request->cart_id);

    $total_debt = TotalDebt::where('user_id', $userId)
            ->where('status', 'Active')
            ->limit(1)
            ->orderBy('created_at', 'desc')
            ->get();


    $total_debt[0]->totaldebt = $total_debt[0]->totaldebt - $request->payVal;

    $total_debt[0]->save();

    return back()->with(['message' => "Debt Deducted!", 'icon' => 'success', 'title' => 'SUCCESS']);
}

public function fullPayment($userId){
    $total_debt = TotalDebt::where('user_id', $userId)
                ->where('status', 'Active')
                ->limit(1)
                ->orderBy('created_at', 'desc')
                ->get();

    if($total_debt == null || count($total_debt) == 0){
        return back()->with(['total_debt' => 0]);
    }

    $total_debt[0]->status = 'Complete';
    $total_debt[0]->save();

    return back()->with(['message' => "Debt Paid!", 'icon' => 'success', 'title' => 'SUCCESS']);
}

public function showDebtorHistory(){
    $carts = Carts::with('listing')
        ->where('user_id', Auth::user()->id)
        ->where('status', '!=' ,'Pending')
        ->get();


    return view('debtor-history', ['carts' => $carts]);
}

public function showHistory(){
    $carts = Carts::with('listing')
        ->where('user_id', '!=', Auth::user()->id)
        ->where('status', '!=' ,'Pending')
        ->get();


    return view('history', ['carts' => $carts]);
}

// public function maxDebt(){
//     $total_debt = TotalDebt::with('user')->where('status', 'Active')->get();

//     if($total_debt->totaldebt > 500)
// }

public function showDebtorsProfile(){
    $users = User::with('total_debt')->where('role', '0')->get();

    return view('debtor-profile', ['users' => $users]);
}

public function showDebtorProfile(Request $request){
    $carts = Carts::with('listing')->where('user_id', $request->debtorId)->get();
    $user = User::with('total_debt')->where('id', $request->debtorId)->get();
    $total_debt = TotalDebt::with('user')->where('user_id', $request->debtorId)->where('status', 'Active')->get();

    if($total_debt == null || count($total_debt) == 0){
        return view('debtor-payment', ['carts' => $carts, 'total_debt' => 0]);
    }

    // Pass the user data to the view
    return view('debtor-payment', ['carts' => $carts, 'total_debt' => $total_debt]);

}

}
