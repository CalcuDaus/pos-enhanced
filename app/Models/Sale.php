<?php

namespace App\Models;

use App\Models\Debt;
use App\Models\User;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    protected $fillable = ['invoice', 'user_id', 'customer_id', 'total', 'payment', 'change'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }


    public function debt(): HasOne
    {
        return $this->hasOne(Debt::class);
    }
}
