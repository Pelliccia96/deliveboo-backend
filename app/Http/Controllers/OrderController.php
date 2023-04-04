<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function sumPricebyRestaurants(){
        $currentDate = DB::table('orders')->max('created_at');

    $months = DB::table(DB::raw('(SELECT 0 AS offset UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11) AS offsets'))
    ->select(DB::raw("DATE_FORMAT(DATE_SUB(DATE_FORMAT('$currentDate', '%Y-%m-01'), INTERVAL offsets.offset MONTH), '%M %Y') AS month_year"))
    ->orderBy('offsets.offset')
    ->get();

    $monthNames = $months->pluck('month_year')->toArray();

$totalsByMonth = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 AS month UNION SELECT 3 AS month UNION SELECT 4 AS month UNION SELECT 5 AS month UNION SELECT 6 AS month UNION SELECT 7 AS month UNION SELECT 8 AS month UNION SELECT 9 AS month UNION SELECT 10 AS month UNION SELECT 11 AS month UNION SELECT 12 AS month) AS months'))
                  ->leftJoin('orders', function ($join) {
                      $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'));
                  })
                  ->selectRaw("DATE_FORMAT(CONCAT('2023-', months.month, '-01'), '%M') as month, COUNT(orders.id) as count, ROUND(SUM(orders.total_order / 10), 2) as total")
                  ->whereIn(DB::raw("DATE_FORMAT(CONCAT('2023-', months.month, '-01'), '%M %Y')"), $monthNames)
                  ->groupBy('months.month', DB::raw('MONTH(orders.created_at)'))
                  ->orderBy('months.month')
                  ->get();





        $restaurantCounts = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 AS month UNION SELECT 3 AS month UNION SELECT 4 AS month UNION SELECT 5 AS month UNION SELECT 6 AS month UNION SELECT 7 AS month UNION SELECT 8 AS month UNION SELECT 9 AS month UNION SELECT 10 AS month UNION SELECT 11 AS month UNION SELECT 12 AS month) AS months'))
        ->leftJoin('orders', function ($join) {
            $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'));
        })
        ->leftJoin('restaurants', function ($join) {
            $join->on(DB::raw('MONTH(restaurants.created_at)'), '=', DB::raw('months.month'));
        })
        ->selectRaw('months.month as month, COUNT(DISTINCT restaurants.id) as count, ROUND(SUM(orders.total_order / 10), 2) as total')
        ->groupBy('months.month')
        ->orderBy('months.month')
        ->get();

        $restaurantCountTotal = DB::table('restaurants')
        ->selectRaw('COUNT(*) as count')
        ->first();
        return view('admin.statistics', compact('totalsByMonth','restaurantCounts', 'restaurantCountTotal', 'months'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function searchCategories(Request $request)
    {
        $query = $request->get('name');
        
        $categories = [];
        if(isset($query)){
            $categories = Category::where('name', 'like', '%' . $query . '%')
            ->get();
        } 
        
    return view('admin.show', compact('categories'));
}

public function searchRestaurants(Request $request)
    {
        $query = $request->get('name');
        
        $restaurants = [];
        if(isset($query)){
            $restaurants = Restaurant::where('name', 'like', '%' . $query . '%')
            ->get();
        } 
        
    return view('admin.show', compact('restaurants'));
}

public function searchUsers(Request $request)
    {
        $query = $request->get('name');
        
        $users = [];
        if(isset($query)){
            $users = User::where('email', 'like', '%' . $query . '%')
            ->get();
        } 
        
    return view('admin.show', compact('users'));
}


    
    public function chartDataByMonth()
    {
        $currentDate = DB::table('orders')->max('created_at');

    $months = DB::table(DB::raw('(SELECT 0 AS offset UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11) AS offsets'))
    ->select(DB::raw("DATE_FORMAT(DATE_SUB(DATE_FORMAT('$currentDate', '%Y-%m-01'), INTERVAL offsets.offset MONTH), '%M %Y') AS month_year"))
    ->orderBy('offsets.offset')
    ->get();

    $monthNames = $months->pluck('month_year')->toArray();
        $restaurantId = Auth::user()->id;
        $chartData = DB::table(DB::raw('(SELECT 1 AS month UNION SELECT 2 AS month UNION SELECT 3 AS month UNION SELECT 4 AS month UNION SELECT 5 AS month UNION SELECT 6 AS month UNION SELECT 7 AS month UNION SELECT 8 AS month UNION SELECT 9 AS month UNION SELECT 10 AS month UNION SELECT 11 AS month UNION SELECT 12 AS month) AS months'))
                    ->leftJoin('orders', function ($join) use ($restaurantId) {
                        $join->on(DB::raw('months.month'), '=', DB::raw('MONTH(orders.created_at)'))
                            ->where('orders.restaurant_id', $restaurantId);
                    })
                    ->selectRaw("DATE_FORMAT(CONCAT('2023-', months.month, '-01'), '%M') as month, COUNT(orders.id) as count, SUM(orders.total_order) as sum")
                    ->whereIn(DB::raw("DATE_FORMAT(CONCAT('2023-', months.month, '-01'), '%M %Y')"), $monthNames)
                    ->groupBy('months.month', DB::raw('MONTH(orders.created_at)'))
                    ->orderBy('months.month')
                    ->get();

        return view('testingChart.chart', compact('chartData'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Completato';
        $order->save();


        return redirect()->route('restaurants.showOrders', $order->restaurant_id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function unupdate($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'In lavorazione';
        $order->save();


        return redirect()->route('restaurants.showOrders', $order->restaurant_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}