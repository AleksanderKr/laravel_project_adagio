<?php
                                                # funkcje okienkowe, join zamienic na podzapytanie, jakas statystyka
                                                # statystyka z jakiego kraju kto
                                                # kwestia edycji jednego uzytkownika

                                                #zapytanie z wartoscia kolumny N zsumowana z N-1 - uzyc okienkowych
                                                # suma krocząca 1234
                                                #               3610
                                                # transakcja
                                                # widok
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
    
        \DB::enableQueryLog();
        
        $country_stat = DB::table('carts')
                            ->select('user_addresses.country', DB::raw('COUNT(*) as orders_count'))
                            ->join('orders', 'orders.cart_id', '=', 'carts.id')
                            ->join('user_addresses', 'user_addresses.user_id', '=', 'carts.user_id')
                            ->groupBy('user_addresses.country')
                            ->get();
        
    # bazy, join, podzapytanie łatwe
        $joiner = DB::table('offers')
                    ->select('offers.item_name')
                    ->join('users', 'offers.seller_id', '=', 'users.id')
                    ->where('users.username', 'LIKE', 'Mariusz')
                    ->get();
        
        $disjoiner = DB::table('offers')
                    ->select('item_name')
                    ->whereRaw('seller_id IN (SELECT id FROM users WHERE username LIKE "Mariusz")')
                    ->get();
        
        
        # bazy, ilu użytkowników z jakiego państwa
        $user_countries = DB::table('user_addresses')
                            ->select('user_addresses.country',  DB::raw('COUNT(*) as users_from'))
                            ->groupBy('country')
                            ->get();
        
        # bazy, OVER(PARTITION BY())
        $window_func = DB::table('payments')
                        ->select('id AS payment_id', 'cart_id', 'method', DB::raw('COUNT(method) OVER(PARTITION BY method) AS n_payments'), 
                        DB::raw('SUM(amount) OVER(PARTITION BY method) AS amount_sum'), 
                        DB::raw('MIN(amount) OVER(PARTITION BY method) AS min_amount'), 
                        DB::raw('MAX(amount) OVER(PARTITION BY method) AS max_amount'))
                        ->get(); 
        
        $not_window_func = DB::table('payments')
                            ->select('payments.id AS payment_id', 'payments.cart_id', 'payments.method', 
                            'methods.number_of_payments', 'methods.amount_sum', 'methods.min_amount', 'methods.max_amount')
                            ->join(DB::raw('(
                                SELECT method, COUNT(*) AS number_of_payments,
                                SUM(amount) AS amount_sum,
                                MIN(amount) AS min_amount,
                                MAX(amount) AS max_amount
                                FROM payments
                                GROUP BY method) AS methods
                            '), 'methods.method', '=', 'payments.method')
                            ->orderBy('payments.method')
                            ->get();
    
    
        #dd(\DB::getQueryLog());
        # bazy, window function, ranking kto ile wydał
        $ranking = DB::table('carts')
                    ->select('carts.user_id', 
                    DB::raw('SUM(payments.amount) AS total_amount'), 
                    DB::raw('DENSE_RANK() OVER(ORDER BY SUM(amount) DESC) AS RANKING'))
                    ->join('payments', 'payments.cart_id', '=', 'carts.id')
                    ->groupBy('carts.user_id')
                    ->orderBy('RANKING')
                    ->get();
                              
        # bazy, join, podzapytanie
        $ranking_sub = DB::table('carts')
                        ->select('user_id',                             
                        DB::raw('(SELECT SUM(amount) FROM payments WHERE cart_id = carts.id) as total_amount'), 
                        DB::raw('DENSE_RANK() OVER (ORDER BY (SELECT SUM(amount) FROM payments WHERE cart_id = carts.id) DESC) as RANKING'))                        
                        ->groupBy('user_id')
                        ->orderBy('RANKING')
                        ->limit(9)
                        ->get();

        #dd($ranking_sub);
                        
        # RANK() vs. DENSE_RANK() - przeskakuje, bo to liczba poprzednich wierszy + 1
        
        # bazy, running total
        $suma_kroczaca = DB::table('carts')
                            ->select('carts.user_id', 
                            DB::raw('SUM(payments.amount) AS total_amount'), 
                            #DB::raw('payments.amount'), 
                            DB::raw('SUM(SUM(payments.amount)) OVER(ORDER BY carts.user_id
                            ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS suma_kroczaca'))
                            ->join('payments', 'payments.cart_id', '=', 'carts.id')
                            ->groupBy('carts.user_id')
                            ->get();

        
        return view ('users.index')->with('users', $users)->with('country_stat', $country_stat);
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
                    ->where('offers.seller_id', '=', $id)
                    ->orderBy('offers.id')
                    ->paginate(3, ['*'], 'offers');

        
        $user_addresses = DB::table('user_addresses')
                            ->select('user_addresses.*')
                            ->where('user_addresses.user_id', '=', $id)
                            ->orderBy('user_addresses.id')
                            ->paginate(3, ['*'], 'addresses');
                        
        $cart = DB::table('orders')
                    ->select('orders.id as ord_id', 'orders.quantity', 'orders.cart_id', 'offers.id as offer_id', 'offers.item_name')
                    ->join('offers', 'offers.order_id', '=', 'orders.id')
                    ->join('carts', 'carts.id', '=', 'orders.cart_id')
                    ->where('carts.user_id', '=', $id)
                    ->orderBy('orders.id')
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
        \DB::enableQueryLog();
        $request->validated();
        
        $users = Users::find($id);
        $input = $request->all();
        
        DB::transaction(function () use($input, $users) {
            $users->update($input);
        });
        
        #dd(\DB::getQueryLog());
        
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
