<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // 施設名
            $table->string('address');  // 施設の住所
            $table->text('description')->nullable();  // 施設の説明
            $table->decimal('price_per_hour', 8, 2);  // 料金（1時間あたり）
            $table->string('category');  // 施設のカテゴリー（例：バスケットボール、テニスなど）
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
