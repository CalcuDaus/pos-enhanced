<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Income;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Penjualan',
            'breadcrumbs' => [
                ['name' => 'Penjualan', 'url' => route('sales.index')],
                ['name' => 'Halaman Penjualan', 'url' => route('sales.index')],
            ],
            'products' => Product::with('category')->get()
        ];
        return view('sale.sales', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Generate invoice number
            $invoice = 'INV-' . now()->format('YmdHis') . '-' . rand(100, 999);

            $total = 0;
            $itemsData = [];

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = $item['quantity'];
                $price = $product->price;
                $cost = $product->cost_price; // asumsi kamu punya field ini di tabel produk

                $subtotal = $quantity * $price;
                $profit = ($price - $cost) * $quantity;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'cost_price' => $cost,
                    'price' => $price,
                    'profit' => $profit,
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;

                // Kurangi stok
                $product->stock -= $quantity;
                $product->save();
            }

            // Simpan ke tabel `sales`
            $sale = Sale::create([
                'invoice' => $invoice,
                'user_id' => auth()->id(),
                'customer_id' => null, // kalau kamu punya input customer, bisa ditambahkan
                'total' => $total,
                'payment' => $total, // sementara auto-lunas
                'change' => 0,
            ]);

            // Simpan item
            foreach ($itemsData as $data) {
                $data['sale_id'] = $sale->id;
                SaleItem::create($data);
            }

            // Simpan profit ke incomes
            $totalProfit = array_sum(array_column($itemsData, 'profit'));

            Income::create([
                'date' => now()->toDateString(),
                'amount' => $totalProfit
            ]);
            InventoryLog::create([
                'product_id' => $product->id,
                'change_type' => 'sale',
                'quantity' => $product->stock,
                'note' => 'Produk diJual',
                'created_at' => now(),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi. ' . $e->getMessage());
        }
    }
}
