<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\House;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $tenants = Tenant::with('house');
    //     return inertia('Admins/Tenants/TenantIndex', ['tenants' => $tenants]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(House $house, User  $user)
    {
        return inertia('Admins/Bills/BillCreate', ['house' => $house, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, House $house, User $user)
    {

        $fields = $request->validate([
            'billOwner' =>  'required',
            'waterBill' =>  'required',
            'electricBill' =>  'required',
            'houseRentBill' =>  'required',
            'totalBill' =>  'required',
        ]);

        $user->bills()->create($fields);

        return redirect()->route('houses.users.show', ['house' => $house, 'user' => $user])->with('message', 'New Bill Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house, Tenant $tenant)
    {
        return inertia('Admins/Tenants/TenantShow', ['tenant' => $tenant, 'house' => $house]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house, Tenant $tenant)
    {
        return inertia('Admins/Tenants/TenantEdit', ['tenant' => $tenant, 'house' => $house]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house, Tenant $tenant)
    {
        $fields = $request->validate([
            'fullName' => 'required|max:120|min:3',
            'members' => 'required|numeric',
            'contactNumber' => 'required',
        ]);

        $house->tenants()->update($fields);

        return redirect()->route('houses.tenants.show', ['tenant' => $tenant, 'house' => $house])->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house, User $user, Bill $bill)
    {
        $bill->delete();

        return redirect()->route('houses.users.show', ['house' => $house, 'user' => $user])->with('message', 'Bill Deleted Successfully');
    }

    public function publish(Request $request)
    {


        $isPublished = $request->isPublished;
        $house = $request->house;
        $user = $request->user;
        $bill_id = $request->bill;
        $bill = Bill::findOrFail($bill_id);
        $bill->isPublished = $isPublished;
        $result = $bill->save();

        if ($result) {
            return redirect()->route('houses.users.show', ['house' => $house, 'user' => $user, 'bill' => $bill])->with('message', 'Bill Status Updated!');
        } else {
            return redirect()->route('houses.users.show', ['house' => $house, 'user' => $user, 'bill' => $bill])->with('message', 'Error!');
        }
    }
}
