<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
