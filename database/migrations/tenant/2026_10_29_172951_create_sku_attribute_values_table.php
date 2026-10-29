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
        Schema::create('sku_attribute_values', function (Blueprint $table) {
            $table->string('sku_id');
            $table->string('attribute_value_id');

            // Chaves Estrangeiras
            $table->foreign('sku_id')
                  ->references('id')
                  ->on('product_skus')
                  ->onDelete('cascade');

            $table->foreign('attribute_value_id')
                  ->references('id')
                  ->on('attribute_values')
                  ->onDelete('cascade');

            // Define a chave primária composta usando as strings
            $table->primary(['sku_id', 'attribute_value_id']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sku_attribute_values');
    }
};
