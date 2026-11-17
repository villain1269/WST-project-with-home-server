<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * List all customers.
     */
    public function index()
    {
        $customers = Customer::orderBy('full_name')->get();

        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the Create Customer form.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Validate and store a new customer.
     * On failure, Laravel redirects back with $errors and old() input.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('status', 'Customer created successfully.');
    }

    /**
     * Show the Edit Customer form, pre-filled with the record.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Validate and update an existing customer.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($customer)],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('status', 'Customer updated successfully.');
    }
}
