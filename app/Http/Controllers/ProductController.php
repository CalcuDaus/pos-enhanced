<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'breadcrumbs' => [
                ['name' => 'Kelola Produk', 'url' => route('products.index')],
                ['name' => 'Produk', 'url' => route('products.index')],
            ],
            'products' => Product::all(),
        ];

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->has('param') && Crypt::decrypt(request()->get('param')) === 'add') {
            $data = [
                'title' => 'Tambah Produk',
                'breadcrumbs' => [
                    ['name' => 'Kelola Produk', 'url' => route('products.index')],
                    ['name' => 'Tambah Produk', 'url' => route('products.create', ['param' => Crypt::encrypt('add')])],
                ],
                'product' => null,
                'categories' => Category::all(),
                'param' => Crypt::encrypt('add'),
            ];
            return view('products.form', $data);
        } elseif (request()->has('param') && Crypt::decrypt(request()->get('param')) === 'edit') {
            if (Product::find(Crypt::decrypt(request()->input('id'))) === null) {
                return redirect()->route('products.index')->with('error', 'Produk Tidak Ditemukan.');
            }
            $data = [
                'title' => 'Edit Produk',
                'breadcrumbs' => [
                    ['name' => 'Kelola Produk', 'url' => route('products.index')],
                    ['name' => 'Edit Produk', 'url' => route('products.create', ['id' => Crypt::encrypt(request()->input('id')), 'param' => Crypt::encrypt('edit')])],
                ],
                'product' => Product::find(Crypt::decrypt(request()->input('id'))),
                'categories' => Category::all(),
                'param' => Crypt::encrypt('edit'),

            ];
            return view('products.form', $data);
        } else {
            return redirect()->route('products.index')->with('error', 'Parameter Tidak Valid.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product = Product::find(Crypt::decrypt($id));
        if ($product) {
            $product->update($validatedData);
            return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
        }
        return redirect()->route('products.index')->with('error', 'Produk Tidak Ditemukan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find(Crypt::decrypt($id));
        if ($product) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
        }
        return redirect()->route('products.index')->with('error', 'Produk Tidak Ditemukan.');
    }
}
