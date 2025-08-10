<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Rekening',
            'breadcrumbs' => [
                ['name' => 'Kelola Rekening', 'url' => route('accounts.index')],
                ['name' => 'Daftar Rekening', 'url' => route('accounts.index')],
            ],
            'accounts' => Account::all()
        ];
        return view('accounts.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Rekening',
            'breadcrumbs' => [
                ['name' => 'Kelola Rekening', 'url' => route('accounts.index')],
                ['name' => 'Tambah Rekening', 'url' => route('accounts.create')],
            ],
            'account' => null,
            'param' => 'add',
        ];
        return view('accounts.form', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'account_name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('accounts', $filename, 'public');
            $validatedData['image'] = 'accounts/' . $filename;
        }

        Account::create($validatedData);

        return redirect()->route('accounts.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);

        $data = [
            'title' => 'Edit Rekening',
            'breadcrumbs' => [
                ['name' => 'Kelola Rekening', 'url' => route('accounts.index')],
                ['name' => 'Edit Rekening', 'url' => route('accounts.edit', $id)],
            ],
            'account' => $account,
            'param' => 'edit',
        ];
        return view('accounts.form', $data);
    }

    public function update(Request $request, Account $account)
    {
        $validatedData = $request->validate([
            'account_name' => 'required|string|max:255',
            'balance' => 'required|numeric',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($account->image && Storage::disk('public')->exists($account->image)) {
                Storage::disk('public')->delete($account->image);
            }

            $filename = $request->file('image')->hashName();
            $request->file('image')->storeAs('accounts', $filename, 'public');
            $validatedData['image'] = 'accounts/' . $filename;
        }

        $account->update($validatedData);

        return redirect()->route('accounts.index')->with('success', 'Rekening berhasil diupdate.');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);

        if ($account->image && Storage::disk('public')->exists($account->image)) {
            Storage::disk('public')->delete($account->image);
        }

        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Rekening berhasil dihapus.');
    }
}
