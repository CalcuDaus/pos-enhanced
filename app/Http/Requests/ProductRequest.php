<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:1000',
            'cost_price' => 'required|numeric|min:0',
            'barcode' => 'required',
            'product_code' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:10240',
            'stock' => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama produk harus diisi.',
            'barcode.required' => 'Barcode harus diisi.',
            'product_code.required' => 'Kode produk harus diisi.',
            'category_id.required' => 'Kategori produk harus dipilih.',
            'description.required' => 'Deskripsi produk harus diisi.',
            'cost_price.required' => 'Harga modal harus diisi.',
            'price.required' => 'Harga jual harus diisi.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'stock.required' => 'Stok produk harus diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'stock.min' => 'Stok tidak boleh kurang dari nol.',
            'cost_price.numeric' => 'Harga modal harus berupa angka.',
            'price.numeric' => 'Harga jual harus berupa angka.',
            'cost_price.min' => 'Harga modal tidak boleh kurang dari nol.',
            'price.min' => 'Harga jual tidak boleh kurang dari nol.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 10 MB.',
            'image.image' => 'File yang diunggah harus berupa gambar dengan format: jpeg, png, bmp, gif, atau svg.',

        ];
    }
}
