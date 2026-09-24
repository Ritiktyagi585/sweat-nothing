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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('gateway_order_id')->nullable()->unique()->after('payment_method');
            $table->string('gateway_payment_id')->nullable()->unique()->after('gateway_order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['gateway_order_id']);
            $table->dropUnique(['gateway_payment_id']);
            $table->dropColumn(['gateway_order_id', 'gateway_payment_id']);
        });
    }
};
