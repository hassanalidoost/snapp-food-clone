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
        Schema::table('orders' , function (Blueprint $table){
            $table->dropColumn('address');
            $table->foreignId('address_id')->after('price')->constrained()->noActionOnDelete();
            $table->foreignId('restaurant_id')->after('address_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
