<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SaleItem;
use App\Models\InventoryLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'barcode', 'category_id', 'cost_price', 'price', 'stock'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function inventoryLogs(): HasMany
    {
        return $this->hasMany(InventoryLog::class);
    }
}
