<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userClass = app(config('wallet.user_model', 'App\User'));

        Schema::create('wallets', function (Blueprint $table) use ($userClass) {
            $table->increments('id');
            $table->unsignedInteger($userClass->getForeignKey())->nullable();

            $table->bigInteger('balance');

            $table->timestamps();

            $table->foreign($userClass->getForeignKey())
                ->references($userClass->getKeyName())
                ->on($userClass->getTable())
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
