<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;   // data is coming from the database via Model
use App\Http\Requests\ValidationUsersRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\CursorPaginator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $users = Users::paginate(9, ['*'], 'users_pagination');
    
        return view ('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationUsersRequests $request)
    {
        $request->validated();
        $request->request->add(['salt' => fake()->password()]);
        $hash = hash('sha256', $request->password . $request->salt);
        $request->merge(['password' => $hash]);

        $input = $request->all();# input hasla dodaje salt i hash wtedy
        
        Users::create($input);
        return redirect('users')->with('flash_message', 'User Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \DB::enableQueryLog();
        $users = Users::find($id);
    
        $offers = DB::table('offers')
                    ->select('offers.*')
                    ->join('users', 'users.id', '=', 'offers.seller_id')
                    ->where('users.id', '=', $id)
                    #->orderBy('offers.id')
                    ->paginate(3, ['*'], 'offers');

        $user_addresses = DB::table('user_addresses')
                            ->select('user_addresses.*')
                            ->join('users', 'users.id', '=', 'user_addresses.user_id')
                            ->where('users.id', '=', $id)
                            #->orderBy('user_addresses.id')
                            ->paginate(3, ['*'], 'addresses');
                        
        $cart = DB::table('orders')
                    ->select('orders.id as ord_id', 'orders.quantity', 'orders.cart_id', 'offers.id as offer_id', 'offers.item_name')
                    ->join('offers', 'offers.order_id', '=', 'orders.id')
                    ->join('carts', 'carts.id', '=', 'orders.cart_id')
                    ->where('carts.user_id', '=', $id)
                    ->paginate(3, ['*'], 'orders');
        
        #dd(\DB::getQueryLog());
        
        return view('users.show')
                ->with('users', $users)
                ->with('offers', $offers)
                ->with('user_addresses', $user_addresses)
                ->with('cart', $cart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Users::find($id);
        return view('users.edit')->with('users', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationUsersRequests $request, $id)
    {
        $request->validated();

        $users = Users::find($id);
        $input = $request->all();
        $users->update($input);
        
        return redirect('users')->with('flash_message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Users::destroy($id);
        return redirect('users')->with('flash_message', 'User deleted');
    }
}
