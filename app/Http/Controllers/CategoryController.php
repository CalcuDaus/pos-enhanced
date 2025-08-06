<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Kategori',
            'breadcrumbs' => [
                ['name' => 'Kelola Kategori', 'url' => route('categories.index')],
                ['name' => 'Daftar Kategori', 'url' => route('categories.index')],
            ],
            'categories' => Category::all()
        ];

        return view('categories.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
            'breadcrumbs' => [
                ['name' => 'Kelola Kategori', 'url' => route('categories.index')],
                ['name' => 'Tambah Kategori', 'url' => route('categories.create')],
            ],
            'category' => null
        ];

        return view('categories.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        $data = [
            'title' => 'Edit Kategori',
            'breadcrumbs' => [
                ['name' => 'Kelola Kategori', 'url' => route('categories.index')],
                ['name' => 'Edit Kategori', 'url' => route('categories.edit', $category->id)],
            ],
            'category' => $category
        ];

        return view('categories.form', $data);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
