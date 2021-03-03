<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->references('id')->on('payments')->nullable();
            $table->string('bank');
            $table->string('name');
            $table->string('no_reg');
            $table->date('date');
            $table->string('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_uploads');
    }
}
