<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withholding_taxes', function (Blueprint $table) {

            $table->renameColumn(
                'net_payment',
                'net_amount'
            );
        });
    }

    public function down(): void
    {
        Schema::table('withholding_taxes', function (Blueprint $table) {

            $table->renameColumn(
                'net_amount',
                'net_payment'
            );
        });
    }
};
