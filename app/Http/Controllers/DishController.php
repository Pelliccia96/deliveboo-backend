<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = Dish::all();
        return view('dishes.create', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishRequest $request)
    {
        $restaurant = Auth::user();

        $data = $request->validated();
        $dish = Dish::create($data);
        
        if (key_exists('image', $data)){
            $path = Storage::put('dishs', $data['image']);
            $dish->image = $path;
        } 
        $dish->restaurant_id = $restaurant->id;
        $dish->save();
        return redirect()->route("dishes.show", $dish->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $user_id = auth()->user()->id;
        $dishes = Dish::where('restaurant_id', $user_id)
        ->orderBy('name', 'asc')
        ->get();
        return view("dishes.show", compact("dish", "dishes"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $dishes = Dish::all();
        $this->authorize('update', $dish);
        return view('dishes.edit', compact('dish', 'dishes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        
        $dish->update($data);
        
        if(key_exists("image", $data)){
            $path = Storage::put("dishes", $data["image"]);
            Storage::delete($dish->image);
            $dish->image = $path;
        }
        $dish->visibility = $request->has('visibility');
        $dish->save();

        return redirect()->route("dishes.show", $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if($dish->image){
            Storage::delete($dish->image);
        }
        $dish->delete();
        return redirect()->route("dashboard");
    }
}