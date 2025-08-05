<?php

namespace App\Http\Controllers;

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
        ];

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->has('param') && request()->get('param') === 'add') {
            $data = [
                'title' => 'Tambah Produk',
                'breadcrumbs' => [
                    ['name' => 'Kelola Produk', 'url' => route('products.index')],
                    ['name' => 'Tambah Produk', 'url' => route('products.create', ['param' => 'add'])],
                ],
                'product' => null,
                'categories' => Category::all(),
            ];
            return view('products.form', $data);
        } elseif (request()->has('param') && request()->get('param') === 'edit') {
            if (Product::find(Crypt::decrypt(request()->input('id'))) === null) {
                return redirect()->route('products.index')->with('error', 'Produk Tidak Ditemukan.');
            }
            $data = [
                'title' => 'Edit Produk',
                'breadcrumbs' => [
                    ['name' => 'Kelola Produk', 'url' => route('products.index')],
                    ['name' => 'Edit Produk', 'url' => route('products.create', ['id' => Crypt::encrypt(request()->input('id')), 'param' => 'edit'])],
                ],
                'product' => Product::find(Crypt::decrypt(request()->input('id'))),
                'categories' => Category::all(),
            ];
            return view('products.form', $data);
        } else {
            return redirect()->route('products.index')->with('error', 'Parameter Tidak Valid.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
