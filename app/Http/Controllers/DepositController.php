<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class DepositController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Titipan',
            'breadcrumbs' => [
                ['name' => 'Kelola Titipan', 'url' => route('deposits.index')],
                ['name' => 'Daftar Titipan', 'url' => route('deposits.index')],
            ],
            'deposits' => Deposit::with(['customer'])->get()
        ];

        return view('deposits.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Titipan',
            'breadcrumbs' => [
                ['name' => 'Kelola Titipan', 'url' => route('deposits.index')],
                ['name' => 'Tambah Titipan', 'url' => route('deposits.create')],
            ],
            'deposit' => null,
            'customers' => Customer::all(),
        ];

        return view('deposits.form', $data);
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
                Deposit::create([
                    'customer_id' => $customerCreate->id,
                    'amount' => $request->amount,
                ]);
                return redirect()->route('deposits.index')->with('success', 'Titipan berhasil ditambahkan.');
            }else{
                return redirect()->route('deposits.index')->with('error', 'Titipan gagal ditambahkan.');
            }
        }
        Deposit::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil ditambahkan.');
    }

    public function edit(Deposit $deposit)
    {
        $data = [
            'title' => 'Edit Titipan',
            'breadcrumbs' => [
                ['name' => 'Kelola Titipan', 'url' => route('deposits.index')],
                ['name' => 'Edit Titipan', 'url' => route('deposits.edit', $deposit->id)],
            ],
            'deposit' => $deposit,
            'customers' => Customer::all(),
        ];

        return view('deposits.form', $data);
    }

    public function update(Request $request, Deposit $deposit)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $deposit->update([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
        ]);

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil diperbarui.');
    }

    public function addAmount(Request $request, $id)
    {
        $request->validate([
            'add_amount' => 'required|numeric|min:0',
        ]);

        $deposit = Deposit::findOrFail(Crypt::decrypt($id));
        $deposit->update(['amount' => $deposit->amount + $request->add_amount]);

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil ditambahkan.');
    }

    public function withdrawAmount(Request $request, $id)
    {
        $request->validate([
            'withdraw_amount' => 'required|numeric|min:0',
        ]);

        $deposit = Deposit::findOrFail(Crypt::decrypt($id));

        if ($request->withdraw_amount > $deposit->amount) {
            return redirect()->route('deposits.index')->with('error', 'Jumlah penarikan melebihi saldo titipan.');
        }

        $deposit->update(['amount' => $deposit->amount - $request->withdraw_amount]);

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil diambil sebagian.');
    }

    public function payOff($id)
    {
        $deposit = Deposit::findOrFail(Crypt::decrypt($id));
        $deposit->update(['amount' => 0]);

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil diambil/dilunasi.');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findOrFail(Crypt::decrypt($id));
        $deposit->delete();

        return redirect()->route('deposits.index')->with('success', 'Titipan berhasil dihapus.');
    }
}
