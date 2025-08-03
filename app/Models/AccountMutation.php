<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountMutation extends Model
{
    protected $fillable = ['account_id', 'mutation_type', 'amount'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
