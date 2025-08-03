<?php

namespace App\Models;

use App\Models\Debt;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address'];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function debts(): HasMany
    {
        return $this->hasMany(Debt::class);
    }
}
