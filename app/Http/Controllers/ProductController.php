<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use App\Models\InventoryLog;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Produk',
            'breadcrumbs' => [
                ['name' => 'Kelola Produk', 'url' => route('products.index')],
                ['name' => 'Daftar Produk', 'url' => route('products.index')],
            ],
            'products' => Product::with('category')->get()
        ];
        return view('products.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk',
            'breadcrumbs' => [
                ['name' => 'Kelola Produk', 'url' => route('products.index')],
                ['name' => 'Tambah Produk', 'url' => route('products.create')],
            ],
            'product' => null,
            'categories' => Category::all(),
            'param' => 'add',
        ];
        return view('products.form', $data);
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        if ($product = Product::create($validatedData)) {
            InventoryLog::create([
                'product_id' => $product->id,
                'change_type' => 'add',
                'quantity' => $product->stock,
                'note' => 'Produk diTambahkan',
                'created_at' => now(),
            ]);
            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        }
        return redirect()->route('products.index')->with('error', 'Produk gagal ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $data = [
            'title' => 'Edit Produk',
            'breadcrumbs' => [
                ['name' => 'Kelola Produk', 'url' => route('products.index')],
                ['name' => 'Edit Produk', 'url' => route('products.edit', $id)],
            ],
            'product' => $product,
            'categories' => Category::all(),
            'param' => 'edit',
        ];
        return view('products.form', $data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->delete()) {
            InventoryLog::create([
                'product_id' => $product->id,
                'change_type' => 'remove',
                'quantity' => 0,
                'note' => 'Produk dihapus',
                'created_at' => now(),
            ]);
            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
        }
        return redirect()->route('products.index')->with('error', 'Produk gagal dihapus.');
    }
}
