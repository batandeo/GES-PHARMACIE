<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchetersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acheters', function (Blueprint $table) {
            $table->id('id');
            $table->integer('produit_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('quantite');
            $table->date('date_achat');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('produit_id')->references('')->on('produits');
            $table->foreign('user_id')->references('')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('acheters');
    }
}
