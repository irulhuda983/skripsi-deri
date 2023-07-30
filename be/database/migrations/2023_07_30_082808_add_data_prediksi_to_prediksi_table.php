<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataPrediksiToPrediksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prediksi', function (Blueprint $table) {
            $table->text('data_prediksi')->after('hasil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prediksi', function (Blueprint $table) {
            $table->dropColumn('data_prediksi');
        });
    }
}
