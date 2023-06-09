<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Gate;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        $restaurantsId = Restaurant::where('user_id' , auth()->user()->id)->pluck('id')->toArray();
        $foods = Food::with('restaurant' , 'discount' , 'category' , 'images')
            ->whereIn('restaurant_id' , $restaurantsId)->paginate(5);

        return view('seller.food.index' , compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        $discounts = Discount::all();
        $categories = FoodCategory::all();
        $restaurants = Restaurant::where('user_id' , auth()->user()->id)->get();
        return view('seller.food.create' , compact('discounts' , 'categories' , 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        Food::create($request->all());
        return redirect()->to(route('seller.food.index'))->with('success' , 'Food Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        $food = Food::with('restaurant' , 'discount' , 'category' , 'images')->findOrFail($id);
        $discounts = Discount::all();
        $categories = FoodCategory::all();
        $restaurants = Restaurant::where('user_id' , auth()->user()->id)->get();
        return view('seller.food.edit' , compact('food' , 'discounts' , 'categories' , 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, $id)
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        $food = Food::findOrFail($id);
        $food->update($request->all());

        return redirect()->back()->with('success' , 'Food Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (! Gate::allows('seller-all-capability')) {
            abort(403);
        }
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->back()->with('success' , 'Food Deleted successfully!');
    }
}
