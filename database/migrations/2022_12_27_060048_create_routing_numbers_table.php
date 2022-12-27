<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BankSwiftcodes\Models\RoutingNumber;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(RoutingNumber::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string("bank_code");
            $table->foreignId("bank_id")->nullable();
            $table->string("bank_name");
            $table->string("branch_name")->nullable();
            $table->string("branch_code")->nullable();
            $table->string("routing_no");
            $table->foreignId("district_id")->nullable();
            $table->string("district_code");
            $table->string("district");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(RoutingNumber::getTableName());
    }
};
