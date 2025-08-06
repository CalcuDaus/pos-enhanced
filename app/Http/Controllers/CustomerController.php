<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Pelanggan',
            'breadcrumbs' => [
                ['name' => 'Kelola Pelanggan', 'url' => route('customers.index')],
                ['name' => 'Daftar Pelanggan', 'url' => route('customers.index')],
            ],
            'customers' => Customer::all()
        ];

        return view('customers.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pelanggan',
            'breadcrumbs' => [
                ['name' => 'Kelola Pelanggan', 'url' => route('customers.index')],
                ['name' => 'Tambah Pelanggan', 'url' => route('customers.create')],
            ],
            'customer' => null
        ];

        return view('customers.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:255',
            'address' => 'nullable|string'
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Customer $customer)
    {
        $data = [
            'title' => 'Edit Pelanggan',
            'breadcrumbs' => [
                ['name' => 'Kelola Pelanggan', 'url' => route('customers.index')],
                ['name' => 'Edit Pelanggan', 'url' => route('customers.edit', $customer->id)],
            ],
            'customer' => $customer
        ];

        return view('customers.form', $data);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:255',
            'address' => 'nullable|string'
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
