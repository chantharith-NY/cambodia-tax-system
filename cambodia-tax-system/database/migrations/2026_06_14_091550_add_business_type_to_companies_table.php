<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->enum(
                'business_type',
                [
                    'legal_entity',
                    'sole_proprietorship',
                    'natural_resource',
                    'qip'
                ]
            )
                ->default('legal_entity')
                ->after('industry');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->dropColumn(
                'business_type'
            );
        });
    }
};
