<?php

namespace App\Http\Controllers;

use App\Events\CustomerCreated;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customer = Customer::paginate(20);
        // return view('customers.index', compact('customer'));
        return Customer::paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $customer = Customer::create($data);

        // TODO: Sending email to admin when this new customer is created
        event(new CustomerCreated($customer));
        return response()->json($customer, 201);
        // return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($customer->photo && Storage::disk('public')->exists($customer->photo)) {
                Storage::disk('public')->delete($customer->photo);
            }

            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $customer->update($data);

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->photo) {
            Storage::disk('public')->delete($customer->photo);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully'], 200);
        // return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');

    }
}
