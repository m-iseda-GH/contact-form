<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {

            $table->id();

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('first_name', 8);

            $table->string('last_name', 8);

            $table->tinyInteger('gender');

            $table->string('email')->unique();

            $table->string('tel', 15);

            $table->string('address', 255);

            $table->string('building', 255)->nullable();

            $table->text('detail');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
