<?php

namespace App\Http\Controllers;

use App\Store;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function joinToCrm(Store $store,Request $request)
    {
        $request['store_id'] = $store->id;
        $user = auth()->user();
        
        if($user)
        {
            $validData = $this->validate($request, [
                    'store_id' => 'required|unique:customers,store_id,NULL,id,user_id,'.auth()->user()->id,
                ]
            );

            $user->Customer()->create([
                'user_id' => $user->id,
                'store_id' => $store->id
            ]);

            $store->member_count = $store->member_count + 1;

            $store->save();  

            return back();

        }else{

            return view('auth.login');
        
        }
    }
}
