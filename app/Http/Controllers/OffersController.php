<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offers::paginate(15);
        $usernames = DB::table('users')
                    ->select('id', 'username')
                    ->get();

        return view('dashboard')->with('offers', $offers)->with('usernames', $usernames);
    }

    public function search(Request $request) {
        if ($request->category_dropdown == 'Wszystkie') {
            $request->category_dropdown = '%';
        }

        $offers_searched = DB::table('offers')
                            ->select('offers.*')
                            ->where('category', 'LIKE', $request->category_dropdown) # mozna dodac podzapytanie zeby nie uzywac like
                            ->where('item_name', 'LIKE', '%'.$request->search.'%')
                            ->paginate(15);
        
        return view('dashboard')->with('offers', $offers_searched);
    }

    public function searchMultiple(Request $request) {
        
        $off = DB::table('offers')
                ->select('seller_id', DB::raw('GROUP_CONCAT(item_name SEPARATOR ", ") AS item_name'))
                ->where('item_name', 'LIKE', '%'.$request->first_field.'%')
                ->orWhere('item_name', 'LIKE', '%'.$request->second_field.'%')
                ->groupBy('seller_id')
                ->paginate(15);
                
        # str_contains checks for "," - if there is, then there are two or more items from the same user
        $names = [];
        foreach($off as $of) {
            if(str_contains($of->item_name, ',')) {
                $tmp_name = explode(", ", $of->item_name);
                array_push($names, $tmp_name);                
            }
        }
        
        $offers_multiple = DB::table('offers')
        ->select('offers.*')
        ->where('item_name', 'LIKE', '%'.$request->first_field.'%')
        ->orWhere('item_name', 'LIKE', '%'.$request->second_field.'%')
        ->orderBy('seller_id')
        ->paginate(15);
        

        return view('dashboard')->with('offers', $offers_multiple)->with('multiple_names', $names);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.addOffer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->request->add(['seller_id' => Auth::id()]);
        $input = $request->all();
        
        Offers::create($input);

        return redirect('users/'.Auth::id());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offers = Offers::find($id);
        
        return view('offers.show')->with('offers', $offers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function makeOrder($id) 
    {
        $offer_to_order = Offers::find($id);
        $current_user_id = Auth::id();
        
        # create order, add to cart, insert order_id into offer
        $cart_of_current_user = DB::table('carts')
                                ->select('id')
                                ->where('user_id', '=', $current_user_id)
                                ->get();
        
        DB::table('orders')
            ->insert([
                'cart_id' => $cart_of_current_user[0]->id,
                'quantity' => 1,
            ]);


        DB::table('offers')
            ->where('id', '=', $id)    
            ->update(['order_id' => $current_user_id]);
            
            
        #return view('offers.makeOrder')->with('offer_id', $id)->with('order_id', $id);     # for payment form
        return view('home');
    }

    public function finishOrder(Request $request, $id) {
        dd($request);
    }

    public function addOffer(Request $request, $id) {

        return view('offers.addOffer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
