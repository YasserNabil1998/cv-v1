<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name_ar'); // الاسم بالعربية
            $table->string('name_en'); // الاسم بالإنجليزية
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('bio_ar'); // النبذة بالعربية
            $table->text('bio_en'); // النبذة بالإنجليزية
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
