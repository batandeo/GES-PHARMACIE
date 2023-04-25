<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id');
            $table->string('libelle');
            $table->string('code');
            $table->integer('qte_minimal');
            $table->integer('qte_init');
            $table->integer('qte_final');
            $table->float('prix_session');
            $table->float('prix_public');
            $table->date('date_peremp');
            $table->integer('qte_sortie');
            $table->integer('lot_id')->unsigned();
            $table->integer('categorie_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lot_id')->references('')->on('lots');
            $table->foreign('categorie_id')->references('')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produits');
    }
}
