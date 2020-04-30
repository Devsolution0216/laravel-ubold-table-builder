<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\User;
use File;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(500);
        }

        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'color' => 'required',
            'logo' => ['required', 'image'],
        ]);

        $api_key = uniqid(base64_encode(str_random(60)));

        $imagePath = $request->logo->store('logos', 'public');

        $customer = new Customer;
        $customer->name = $data['name'];
        $customer->color = $data['color'];
        $customer->logo = $imagePath;
        $customer->api_key = $api_key;
        $customer->save();
        
        return redirect()->route('admin.customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);

        return view('admin.customers.edit', compact('customer'));
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
        $data = $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);
        
        $customer = Customer::find($id);
        $imagePath = $customer->logo;
        if ($request->logo){
            File::delete(public_path('/storage').'/'.$imagePath);
            $imagePath = $request->logo->store('logos', 'public');
        }

        $customer->name = $data['name'];
        $customer->color = $data['color'];
        $customer->logo = $imagePath;
        $customer->save();

        return redirect()->route('admin.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $logo = $customer->logo;
        $customer->delete();
        File::delete(public_path('/storage').'/'.$logo);

        User::where('customer_id',$id)->delete();
    }
}
