<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class DebtController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Hutang',
            'breadcrumbs' => [
                ['name' => 'Kelola Hutang', 'url' => route('debts.index')],
                ['name' => 'Daftar Hutang', 'url' => route('debts.index')],
            ],
            'debts' => Debt::with(['customer', 'sale'])->get()
        ];

        return view('debts.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Hutang',
            'breadcrumbs' => [
                ['name' => 'Kelola Hutang', 'url' => route('debts.index')],
                ['name' => 'Tambah Hutang', 'url' => route('debts.create')],
            ],
            'debt' => null,
            'customers' => Customer::all(),
        ];

        return view('debts.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'amount' => 'required|numeric|min:0',
        ]);
        if ($request->customer_id == null) {
            $customerCreate = Customer::create([
                'name' => $request->customer_name,
                'address' => '-',
                'phone' => '-',
                'email' => 'dummy@gmail.com'
            ]);
            if ($customerCreate) {
                Debt::create([
                    'customer_id' => $customerCreate->id,
                    'amount' => $request->amount,
                ]);
                return redirect()->route('debts.index')->with('success', 'Hutang berhasil ditambahkan.');
            }else{
                return redirect()->route('debts.index')->with('error', 'Hutang gagal ditambahkan.');
            }
        }
        Debt::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil ditambahkan.');
    }

    public function edit(Debt $debt)
    {
        $data = [
            'title' => 'Edit Hutang',
            'breadcrumbs' => [
                ['name' => 'Kelola Hutang', 'url' => route('debts.index')],
                ['name' => 'Edit Hutang', 'url' => route('debts.edit', $debt->id)],
            ],
            'debt' => $debt,
            'customers' => Customer::all(),
        ];

        return view('debts.form', $data);
    }

    public function update(Request $request, Debt $debt)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $debt->update([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $debt = Debt::findOrFail(Crypt::decrypt($id));
        $debt->delete();

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil dihapus.');
    }
}
