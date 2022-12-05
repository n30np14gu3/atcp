<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepared_cache', function (Blueprint $table) {
            $table->id();
            $table->string('category_id', 20)->index('c_idx')->comment('ID категории из апи (хранить ид, как число, это, конечно, криннж)');
            $table->date('cache_date')->index('d_idx')->comment('Дата позиций');
            $table->bigInteger('position')->default(0)->comment('Позиция');
            $table->timestamps();
        });

        Schema::table('prepared_cache', function (Blueprint $table){
            $table->unique([
               'category_id',
               'cache_date'
            ], 'u_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prepared_cache');
    }
};
