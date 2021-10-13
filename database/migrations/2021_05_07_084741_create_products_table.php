<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('size');
            $table->integer('price', false, true)->length(11);
            $table->integer('discount', false, true)->length(11)->nullable();
            $table->text('shortDesc');
            $table->longText('longDesc');
            $table->longText('book_pdf');
            $table->text('thumbnail')->nullable();
            $table->text('forwardImage');
            $table->text('backwardImage')->nullable();
            $table->integer('categoryId', false, true)->length(11);
            $table->integer('otherCategoryId', false, true)->length(11);
            $table->float('stock', 11, 2);
            $table->string('location');
            $table->string('product_type')->default('Others');
            $table->boolean('is_for_company')->default(false);
            $table->string('views')->nullable();
            $table->string('status')->default('Pending');
            $table->integer('added_by', false, true)->length(11);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
