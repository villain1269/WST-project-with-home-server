<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * TFA6: records are now retrieved through the Customer Eloquent
     * model instead of the static array used in TFA5.
     */
    public function index()
    {
        $customers = Customer::orderBy('full_name')->get();

        return view('customers', ['customers' => $customers]);
    }
}
