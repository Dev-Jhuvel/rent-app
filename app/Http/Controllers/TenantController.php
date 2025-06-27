<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{


    public function create(House $house)
    {
        $tenantCount = $house->users()->count();
        if ($tenantCount === $house->roomCount) {
            return inertia('Admins/Houses/HouseShow', ['house' => $house, 'users' => User::where('house_id', $house->id)->get()]);
        }
        return inertia('Admins/Tenants/TenantCreate', ['house' => $house]);
    }

    public function store(Request $request, House $house)
    {
        $tenantCount = $house->users()->count();
        $request['email']  = strtolower(explode(' ', $request['name'])[0] . '@email.com');
        $fields = $request->validate([
            'name' => 'required',
            'members' => 'required',
            'contact' => 'required|unique:users,contact',
            'email' => 'required|unique:users,email',
        ]);
        $fields['password'] = Hash::make($fields['contact']);
        $request->house->users()->create($fields);
        $tenantCount++;
        if ($tenantCount === $house->roomCount) {
            $house->update(array('isAvailable' => false));
            return redirect()->route('houses.show', ['house' => $house])->with('message', 'Tenant Created Successfully And House Room Full!');
        }

        return redirect()->route('houses.show', ['house' => $house])->with('message', 'Tenant Created Successfully!');
    }

    public function show(House $house, User $user)
    {
        $bills = Bill::latest()->where('user_id', $user->id)->get();

        return inertia('Admins/Tenants/TenantShow', ['house' => $house, 'user' => $user, 'bills' => $bills]);
    }

    public function edit(House $house, User $user)
    {
        return inertia('Admins/Tenants/TenantEdit', ['house' => $house, 'user' => $user]);
    }

    public function update(Request $request, House $house, User $user)
    {
        $request['email']  = strtolower(explode(' ', $request['name'])[0] . '@email.com');
        $fields = $request->validate([
            'name' => 'required',
            'members' => 'required',
            'contact' => 'required|unique:users,contact,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id,
        ]);
        $fields['password'] = Hash::make($fields['contact']);
        $user->update($fields);
        return redirect()->route('houses.show', ['house' => $house])->with('message', 'Tenant Updated Successfully!');
    }

    public function destroy(House $house, User $user)
    {
        $user->delete();

        return redirect()->route('houses.show', ['house' => $house])->with('message', 'Tenant Deleted Successfully!');
    }
}
// class TenantController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $tenants = Tenant::with('house');
//         return inertia('Admins/Tenants/TenantIndex', ['tenants' => $tenants]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create(House $house)
//     {
//         if ($house->roomCount <= $house->tenants()->count()) {
//             $tenants = Tenant::where('house_id', $house->id)->get();
//             return redirect()->route('houses.show', ['house' => $house, 'tenants' => $tenants])->with('message', 'Tenant Full!');
//         }
//         return inertia('Admins/Tenants/TenantCreate', ['house' => $house]);
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request, House $house)
//     {

//         $fields = $request->validate([
//             'fullName' => 'required|max:120|min:3',
//             'members' => 'required|numeric',
//             'contactNumber' => 'required',
//         ]);

//         $house->tenants()->create($fields);
//         return redirect()->route('houses.show', ['house' => $house])->with('message', 'New Tenant Added');
//     }

//     public function createTenantAccount(Request $request)
//     {
//         $tenant = $request->tenant;
//         $tenant_id = $request->tenant['id'];
//         $house = $request->house['id'];
//         $fullName = $tenant['fullName'];
//         $email = strtolower(explode(' ', $fullName)[0] . 'absdsssa@email.com');
//         $contact = $tenant['contactNumber'];
//         // dd($fullName, $email, $contact);
//         User::create([
//             'name' => $fullName,
//             'tenant_id' => (int) $tenant['id'],
//             'email' => $email,
//             'password' =>   $contact,
//             'contact' =>  $contact,
//         ]);
//         return redirect()->route('houses.tenants.show', ['house' => $house, 'tenant' => $tenant_id])->with('message','Tenant Account Created');
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(House $house, Tenant $tenant)
//     {
//         // dd($tenant);
//         $bills = Bill::where('tenant_id', $tenant->id)->get();

//         return inertia('Admins/Tenants/TenantShow', ['tenant' => $tenant, 'house' => $house, 'bills' => $bills]);
//     }


//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(House $house, Tenant $tenant)
//     {
//         return inertia('Admins/Tenants/TenantEdit', ['tenant' => $tenant, 'house' => $house]);
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, House $house, Tenant $tenant)
//     {
//         $fields = $request->validate([
//             'fullName' => 'required|max:120|min:3',
//             'members' => 'required|numeric',
//             'contactNumber' => 'required',
//         ]);

//         $house->tenants()->update($fields);

//         return redirect()->route('houses.tenants.show', ['tenant' => $tenant, 'house' => $house])->with('message', 'Update Successfully');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(House $house, Tenant $tenant)
//     {
//         $tenant->delete();

//         return redirect()->route('houses.show', ['house' => $house])->with('message', 'Tenant Deleted Successfully');
//     }
// }
