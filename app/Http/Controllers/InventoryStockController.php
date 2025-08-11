<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Http\Controllers\Controller;

class InventoryStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Log Stok',
            'breadcrumbs' => [
                ['name' => 'Kelola Log Stok', 'url' => route('inventories.index')],
                ['name' => 'Log Stok', 'url' => route('inventories.index')],
            ],
            'inventories' => InventoryLog::with('product')->orderBy('created_at', 'desc')->get()
        ];

        return view('inventories.index', $data);
    }
}
