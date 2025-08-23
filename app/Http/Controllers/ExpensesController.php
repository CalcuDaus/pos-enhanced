<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpensesController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Pengeluaran',
            'breadcrumbs' => [
                ['name' => 'Kelola Pengeluaran', 'url' => route('expenses.index')],
                ['name' => 'Daftar Pengeluaran', 'url' => route('expenses.index')],
            ],
            'expenses' => Expense::orderBy('date', 'desc')->get()
        ];

        return view('expenses.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Expense::create($request->only(['date', 'amount', 'category', 'description']));

        return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit(Expense $expense)
    {
        $data = [
            'title' => 'Edit Pengeluaran',
            'breadcrumbs' => [
                ['name' => 'Kelola Pengeluaran', 'url' => route('expenses.index')],
                ['name' => 'Edit Pengeluaran', 'url' => route('expenses.edit', $expense->id)],
            ],
            'expense' => $expense,
        ];

        return view('expenses.form', $data); // jika ingin modal, bisa juga diindex
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $expense->update($request->only(['date', 'amount', 'category', 'description']));

        return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail(Crypt::decrypt($id));
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
