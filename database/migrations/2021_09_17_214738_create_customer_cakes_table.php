<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_cakes', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('cake_id');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('cake_id')
                ->references('id')
                ->on('cakes');

            $table->primary(['customer_id', 'cake_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_cakes');
    }
}
