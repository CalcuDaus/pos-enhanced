<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Income;
use App\Models\Account;
use App\Models\Expense;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use App\Models\AccountMutation;
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
    public function salesMoney()
    {
        $data = [
            'title' => 'Penjualan',
            'breadcrumbs' => [
                ['name' => 'Penjualan', 'url' => route('sales.index')],
                ['name' => 'Halaman Penjualan', 'url' => route('sales.index')],
            ],
            'accounts' => Account::all()
        ];
        return view('sale.sales-money', $data);
    }
    public function storeMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'type_transaction' => 'required|in:in,out',
        ]);
        if (!$request->account_id) {
            return redirect()->back()->with('error', 'Silahkan pilih rekening terlebih dahulu!');
        }
        $account = Account::find($request->account_id);
        if (!$account) {
            return redirect()->back()->with('error', 'Rekening tidak ditemukan!');
        }
        try {
            DB::beginTransaction();
            $account->update([
                'balance' => $request->type_transaction == 'in' ? $account->balance + $request->amount : $account->balance - $request->amount
            ]);
            AccountMutation::create([
                'account_id' => $account->id,
                'mutation_type' => $request->type_transaction,
                'amount' => $request->amount,
            ]);
            $biayaAdmin = $request->amount_manual ?? $this->setBiayaAdmin($request->amount);
            if ($biayaAdmin === null) {
                return redirect()->back()->with('error', 'Jumlah transaksi tidak valid untuk biaya admin!');
            }
            // logic untuk menyimpan income atau expense
            if ($request->type_transaction == 'out') {
                Expense::create([
                    'date' => now()->toDateString(),
                    'amount' => $biayaAdmin,
                    'category' => 'Transaksi Keuangan',
                    'description' => 'Transaksi Penjualan Keuangan',
                ]);
            } else if ($request->type_transaction == 'in') {
                Income::create([
                    'date' => now()->toDateString(),
                    'amount' => $biayaAdmin,
                ]);
            } else {
                return redirect()->back()->with('error', 'Jenis transaksi tidak valid!');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi. ' . $e->getMessage());
        }
    }
    private function setBiayaAdmin($amount)
    {
        if ($amount > 0 && $amount < 100000) {
            return 2000;
        } elseif ($amount > 100000) {
            return 3000;
        } elseif ($amount > 500000) {
            return 5000;
        } elseif ($amount > 3000000) {
            return 7000;
        } elseif ($amount > 5000000) {
            return 10000;
        } else {
            return null;
        }
        return null;
    }
}
