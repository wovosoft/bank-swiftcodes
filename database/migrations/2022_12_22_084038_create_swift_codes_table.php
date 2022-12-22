<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wovosoft\BankSwiftcodes\Models\Bank;
use Wovosoft\BankSwiftcodes\Models\SwiftCode;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(SwiftCode::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string("country");
            $table->string("country_code")->index();
            $table->foreignId("bank_id")->nullable();

            $table->string("city");
            $table->string("branch")->nullable();
            $table->string("swift_code")->index();
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
        Schema::dropIfExists(SwiftCode::getTableName());
    }
};
