<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::withCount('users')->with('users')->get();
        return inertia('Admins/Houses/HouseIndex', ['houses' => $houses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admins/Houses/HouseCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'isAvailable' => 'required',
            'roomCount' => 'required|numeric',
            'houseRent' => 'required|numeric',
            'waterRate' =>  'required|numeric',
            'electricRate' =>  'required|numeric|between:0,99.99',
        ]);

        House::create($fields);

        
        return redirect()->route('houses.index')->with('message', 'New House Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        $users = User::where('house_id', $house->id)->get();

        return inertia('Admins/Houses/HouseShow', ['house' => $house, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        return inertia('Admins/Houses/HouseEdit', ['house' => $house]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'isAvailable' => 'required',
            'roomCount' => 'required|numeric',
            'houseRent' => 'required|numeric',
            'waterRate' =>  'required|numeric',
            'electricRate' =>  'required|numeric|between:0,99.99',
        ]);

        $house->update($fields);
        return redirect()->route('houses.show', ['house' => $house])->with('message', 'House Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();

        return redirect()->route('houses.index')->with('message', 'House Deleted Successfully');
    }
}
