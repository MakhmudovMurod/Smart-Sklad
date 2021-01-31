

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ingredient_id');
            $table->float('added_amount',100);
            $table->float('added_price',100);
            $table->unsignedBigInteger('added_by');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('incomes', function (Blueprint $table) {

            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
