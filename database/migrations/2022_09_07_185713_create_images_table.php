<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->uuid();
            $table->string('unsplash_id');
            $table->string('description')->nullable();
            $table->string('path');
            $table->timestamps();
        });
    }
};
