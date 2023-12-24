<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Listing;
use App\Models\TotalDebt;
use App\Models\User;
use App\Models\Payment;
use App\Models\sales;
use App\Models\Notification;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ListingController extends Controller
{
    //CHECK DUE DATE
    private function checkDueDate(){
        $currentDate = Carbon::now();

        $dueDate = TotalDebt::where('status', 'Active')
                ->get();
        $user = User::where('id', auth()->id())->get();

        if($user[0]->role == '0'){
                $timestamp = strtotime($dueDate[0]->duedate);

                if($currentDate->diffInDays($dueDate[0]->duedate) == 2){
                    $message = "Duedate of " . $user[0]->name . "'s debt which costs " . $dueDate[0]->totaldebt . " is on " . date('M d, Y', $timestamp);

                    $notif = AdminNotification::create([
                        'user_id' => auth()->id(),
                        'message' => $message
                    ]);

                    $notif->save();
                }
                elseif($currentDate->diffInDays($dueDate[0]->duedate) > 2){
                    $message = "Duedate of " . $user[0]->name . "'s debt which costs " . $dueDate[0]->totaldebt . " was on " . date('M d, Y', $timestamp);

                    $notif = AdminNotification::create([
                        'user_id' => auth()->id(),
                        'message' => $message
                    ]);

                    $notif->save();
                }
        }
    }

    // Show all listings
    public function index(){
        $this->checkDueDate();
        $role = Auth::user()->role;
        $listings = Listing::latest()
                ->filter(request(['search', 'expiry', 'category', 'product', 'quantity']))
                ->paginate(10);
        $users = User::where('role', '0')->get();
        $total = TotalDebt::pluck('totaldebt')->sum();
        $totalSales = sales::sum(DB::raw('amount'));
        $notifs = AdminNotification::orderBy('created_at', 'desc')->get();

        $categoryCounts = Carts::join('listings', 'carts.listing_id', '=', 'listings.id')
            ->select('listings.category', DB::raw('count(listings.category) as category_count'))
            ->groupBy('listings.category')
            ->get();

        $categoryTotalPrices = Carts::join('listings', 'carts.listing_id', '=', 'listings.id')
        ->select('listings.category', DB::raw('sum(carts.quantity * listings.price) as total_price'))
        ->groupBy('listings.category')
        ->get();

        $carts = Carts::select('listing_id', DB::raw('count(*) as trend')
        )
        ->groupBy(
            'listing_id'
        )
        ->orderByDesc('trend')
        ->get();

        $collections = [];

        for($i = 0; $i <= count($carts) - 1; $i++){
            if($i < 5){
                $temp = Listing::where('id', $carts[$i]->listing_id)->get();
                array_push($collections, $temp);
            }
            else{
                break;
            }
        }

        if($role == '1'){
            return view('users.listings.index', ['message' => "Login Successfully!", 'icon' => 'success', 'title' => 'SUCCESS',
                'listings' => $listings, 'users' => $users, 'collections' => $collections, 'total' => $total, 'categoryCounts' => $categoryCounts, 'categoryTotalPrices' => $categoryTotalPrices, 'notifs' => $notifs, 'totalSales' => $totalSales
            ]);
        }
        else{
            return view('debtor', ['message' => "Login Successfully!", 'icon' => 'success', 'title' => 'SUCCESS',
                'listings' => $listings
            ]);
        }
    }

    // Show all inventory
    public function display(){
        $listings = Listing::all();
        $notifs = AdminNotification::all();

        return view('users.listings.inventory', [
            'listings' => $listings, 'notifs' => $notifs
        ]);
    }

    // Show all Products
    public function getProducts(){
        $listings = Listing::latest()->filter(request(['search', 'expiry', 'category', 'product', 'quantity']))->paginate(10);
        $notifs = AdminNotification::all();

        return view('users.listings.product', [
            'listings' => $listings, 'notifs' => $notifs
        ]);
    }


    // Show Create Forms
    public function create(){
        $notifs = AdminNotification::all();

        return view('users.listings.create', ['notifs' => $notifs]);
    }

    // Show Single Listing
    public function show(Listing $listing){
        $listings = Listing::latest()->filter(request(['search', 'expiry', 'category', 'product', 'quantity']))->paginate(10);
        $notifs = AdminNotification::all();

        return view('users.listings.show', [
            'listing' => $listing, 'notifs' => $notifs
        ]);
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'product' => 'required',
            'category' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'expiry' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with(['message' => "Product Added Successfully!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    // Show Edit Form
    public function edit(Listing $listing){
        $notifs = AdminNotification::all();

        return view('users.listings.edit', ['listing' => $listing, 'notifs' => $notifs]);
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
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with(['message' => "Product Updated Successfully!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    //Manage Items - Admin Side
    public function manage(){
        $notifs = AdminNotification::all();
        $listings = Listing::all();

        return view('users.listings.manage', ['notifs' => $notifs, 'listings' => $listings]);
    }
    //DELETE Product
    public function destroy(Listing $listing){

        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    //Show All Product - USER
    public function showListings(Listing $listing){
        $listings = Listing::all();
        $notifs = AdminNotification::all();

        return view('revenue', ['listings' => $listings, 'notifs' => $notifs]);
    }

    //Add to Cart - USER
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

        $listings = Listing::all();
        $notifs = AdminNotification::all();
        $user = User::where('id', auth()->id())->get();
        $message = $user[0]->name . " has bought " . $request->quantity . " " . $listing->product . " on " . date('M d, Y');
        $adminNotif = AdminNotification::create([
            'user_id' => auth()->id(),
            'message' => $message
        ]);
        $adminNotif->save();

        return redirect('')->with([
            'message' => 'Product Bought Successfully!',
            'icon' => 'success',
            'title' => 'SUCCESS',
            'listings' => $listings,
            'notifs' => $notifs
        ]);

    }

    //Show Cart - USER
    public function showCart(Carts $cart){
        $carts = Carts::with('listing')->where('user_id', Auth::user()->id)->where('status', 'Pending')->get();

        return view('cart', ['carts' => $carts]);
    }

    //Show Products that has been bought by the debtor
    public function showListingsDebtor(Listing $listing){
        $listings = Listing::all();
        $user = User::where('id', auth()->id())->get();
        $message = $user[0]->name . " has bought " . $request->quantity . " " . $listing->product . " on " . date('M d, Y');
        $adminNotif = Notification::create([
            'user_id' => auth()->id(),
            'message' => $message
        ]);
        $adminNotif->save();

        return view('debtor', ['listings' => $listings, 'notifs' => $notifs]);
    }

    //Show Debts - ADMIN
    public function showDebts(Carts $cart){
        $carts = Carts::where('status', 'Approved')->get();
        $listings = Listing::all();
        $notifs = AdminNotification::all();

        return view('debt', ['carts' => $carts, 'listings' => $listings, 'notifs' => $notifs]);
    }

    //Show Pending Debts - ADMIN
    public function showPending(Carts $cart){
        $carts = Carts::where('status', 'Pending')->get();
        $notifs = AdminNotification::all();

        return view('pending', ['carts' => $carts, 'notifs' => $notifs]);
    }

    //Accept Debt Request - ADMIN
    public function acceptPending(Request $request, $cartId){
        $cart = Carts::find($cartId);

        $listing = Listing::all();
        $notifs = Notification::all();

        if($request->status == "Approve"){
            $price = Listing::where('id', $cart->listing_id)->get('price');
            $total_debt = TotalDebt::where('user_id', $cart->user_id)->limit(1)->orderBy('created_at', 'desc')->get();

            if($total_debt == null || count($total_debt) == 0){
                $newTotalDebt = TotalDebt::create([
                    'user_id' => $cart->user_id,
                    'totaldebt' => $cart->quantity * $price[0]->price,
                    'duedate' => $request->duedate
                ]);

                $cart->status = "Approved";
                $cart->save();

                $newTotalDebt->save();
            }else{
                $newDebt = $cart->quantity * $price[0]->price;
                $tempDebt = $newDebt + $total_debt[0]->totaldebt;

                if($total_debt[0]->status == 'Active'){
                    if($tempDebt <= 500){
                        $cart->status = $request->status;

                        $total_debt[0]->totaldebt = $total_debt[0]->totaldebt + $newDebt;
                        $total_debt[0]->save();


                        $cart->status = "Approved";
                        $cart->save();
                    }
                    else{
                        return back()->with(['message' => 'CANT PROCEED! DEBT LIMIT HAS BEEN REACHED!', 'icon' => 'warning', 'title' =>
                    'LIMIT REACHED']);
                    }
                }
                elseif($total_debt[0]->status == 'Complete'){
                    $newTotalDebt = TotalDebt::create([
                        'user_id' => $cart->user_id,
                        'totaldebt' => $cart->quantity * $price[0]->price,
                        'duedate' => $request->duedate
                    ]);

                    $newTotalDebt->save();

                    $cart->status = "Approved";
                    $cart->save();
                }

            }
            $message = "Your debt request for " . $cart->quantity . " pc/s of " .  $cart->listing->product . " has been approved.";

            $notif = Notification::create([
                'user_id' => $cart->user_id,
                'carts_id' => $cart->id,
                'message' => $message
            ]);
            $notif->save();

            $carts = Carts::where('status', 'Pending')->get();

            return back()->with(['message' => 'Debt Request Approved!', 'icon' => 'success', 'title' => 'APPROVED!', 'carts' => $carts]);
        } elseif($request->status == "Cancel"){
            $cart->status = "Cancelled";
            $cart->save();

            $message = "Your debt request for " . $cart->quantity . " pc/s of " .  $listing[0]->product . " has been cancelled.";

            $notif = Notification::create([
                'user_id' => $cart->user_id,
                'carts_id' => $cart->id,
                'message' => $message
            ]);
            $notif->save();

            return back()->with(['message' => 'Debt Request Cancelled!', 'icon' => 'warning', 'title' =>
            'CANCELED']);
        }
    }

    //Partial Payment
    public function partialPayment(Request $request, $userId){
        $carts = Carts::find($request->cart_id);
        $payment = Payment::where('user_id', $userId);

        $total_debt = TotalDebt::where('user_id', $userId)
                ->where('status', 'Active')
                ->limit(1)
                ->orderBy('created_at', 'desc')
                ->get();
        $total_debt[0]->totaldebt = $total_debt[0]->totaldebt - $request->payVal;
        $total_debt[0]->save();

        $payment = Payment::create([
            'user_id' => $userId,
            'name' => $request->name,
            'payment' => $request->payVal
        ]);
        $payment->save();

        return back()->with(['message' => "Debt Deducted!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    //Full Payment
    public function fullPayment(Request $request, $userId){
        $payment = Payment::where('user_id', $userId);

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

        $payment = Payment::create([
            'name' => $request->name,
            'user_id' => $userId,
            'payment' => $total_debt[0]->totaldebt
        ]);
        $payment->save();

        return back()->with(['message' => "Debt Paid!", 'icon' => 'success', 'title' => 'SUCCESS']);
    }

    //Show All Payment and Debts in Debtor's Profile
    public function showDebtorHistory(){
        $carts = Carts::with('listing')
            ->where('user_id', Auth::user()->id)
            ->where('status', '!=' ,'Pending')
            ->get();
        $notifs = AdminNotification::all();
        $payments = Payment::with('user')->where('user_id', Auth::user()->id)->get();

        return view('debtor-history', ['carts' => $carts, 'notifs' => $notifs, 'payments' => $payments]);
    }

    //Show History on Admin Side
    public function showHistory(){
        $carts = Carts::with('listing')
            ->where('user_id', '!=', auth()->id())
            ->where('status', '!=' ,'Pending')
            ->get();
        $notifs = AdminNotification::all();


        return view('history', ['carts' => $carts, 'notifs' => $notifs]);
    }

    //Show Debtors' Profile on Admin Side
    public function showDebtorsProfile(){
        $users = User::with('total_debt')
                ->where('role', '0')
                ->get();

        $notifs = AdminNotification::all();

        return view('debtor-profile', ['users' => $users, 'notifs' => $notifs]);
    }

    //Show Debtor Profile on User Side
    public function showDebtorProfile(Request $request){
        $carts = Carts::with('listing')->where('user_id', $request->debtorId)->get();
        $user = User::with('total_debt')->where('id', $request->debtorId)->get();
        $total_debt = TotalDebt::with('user')->where('user_id', $request->debtorId)->where('status', 'Active')->get();

        $payments = Payment::with('user')->where('user_id', $request->debtorId)->get();
        $notifs = AdminNotification::all();

        if($total_debt == null || count($total_debt) == 0){
            return view('debtor-payment', ['carts' => $carts, 'total_debt' => 0, 'payments' => $payments, 'notifs' => $notifs]);
        }

        // Pass the user data to the view
        return view('debtor-payment', ['carts' => $carts, 'total_debt' => $total_debt, 'payments' => $payments, 'notifs' => $notifs]);

    }

    //Clear Notifications
    public function clearNotif(){
        $notif = AdminNotification::where('status','unread')->get();

        foreach($notif as $not){
            $not->status = 'read';

            $not->save();
        }


        return back();
    }

    //Show User Notification
    public function showNotification(){
        $carts = Carts::all();

        $notif = Notification::with('cart')
                ->where('user_id', auth()->id())
                ->get();


        return view('debtor-notification', ['notif' => $notif]);
    }

// Add Sales
    public function addSales(Request $request){
        $listing = Listing::where('id', $request->item)->get();
        $amount = $listing[0]->price * $request->quantity;
        $notifs = AdminNotification::all();
        $user = auth()->id();

        $sales = sales::create([
            'user_id' => $user,
            'listing_id' => $request->item,
            'quantity' => $request->quantity,
            'amount' => $amount,
            'description' => $request->description
        ]);
        $sales->save();
        $sales = sales::all();

        $listing[0]->quantity -= $request->quantity;
        $listing[0]->save();

        return back()->with(['message' => "Sales Added Successfully!", 'icon' => 'success', 'title' => 'SUCCESS', 'sales' => $sales, 'notifs' => $notifs]);
    }

    //Show Sales
    public function showSales(){
        $sales = sales::with('listing')->where('user_id', Auth::user()->id)->get();
        $notifs = AdminNotification::all();

        return view('/sales', ['sales' => $sales, 'notifs' => $notifs]);
    }

    //Show Profile - Debtor Side
    public function profileShow(Request $request){
        // $carts = Carts::with('listing')->where('user_id', $request->debtorId)->get();
        $user = User::with('total_debt')->where('id', auth()->id())->get();
        $total_debt = TotalDebt::with('user')->where('user_id', $request->debtorId)->where('status', 'Active')->get();

        // $payments = Payment::with('user')->where('user_id', $request->debtorId)->get();
        // $notifs = AdminNotification::all();

        if($total_debt == null || count($total_debt) == 0){
            return view('debtor-payment', ['carts' => $carts, 'total_debt' => 0, 'payments' => $payments, 'notifs' => $notifs]);
        }

        // Pass the user data to the view
        return view('profile.show', ['total_debt' => $total_debt]);
    }

    //Show GCash QR Code
    public function showQrcode(){
        return view('pay');
    }

    public function showLowStocks(){
        $listings = Listing::all();
        $notifs = AdminNotification::all();
        return view('lowstocks', ['listings' => $listings, 'notifs' => $notifs]);
    }

}
