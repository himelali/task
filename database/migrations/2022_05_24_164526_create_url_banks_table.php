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
        Schema::create('url_banks', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->unique()->index();
            $table->string('hash', 15)->unique()->index();
            $table->unsignedBigInteger('traffic')->default(0);
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('url_banks');
    }
};
