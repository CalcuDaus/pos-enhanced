<?php

namespace App\Models;

use App\Models\AccountMutation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'balance',
        'image',
    ];
    public function mutations()
    {
        return $this->hasMany(AccountMutation::class);
    }
}
