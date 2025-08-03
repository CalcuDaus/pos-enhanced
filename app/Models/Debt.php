<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    protected $fillable = ['amount', 'due_date', 'status'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
