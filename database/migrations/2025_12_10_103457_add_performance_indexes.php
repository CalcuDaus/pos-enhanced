<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add standalone index on account_id for faster JOIN operations
        Schema::table('account_mutations', function (Blueprint $table) {
            $table->index('account_id', 'idx_mutations_account_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_mutations', function (Blueprint $table) {
            $table->dropIndex('idx_mutations_account_id');
        });
    }
};
