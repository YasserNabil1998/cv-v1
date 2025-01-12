<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // مفتاح أجنبي
        $table->string('name_ar');
        $table->string('name_en');
        $table->string('job_title_ar');
        $table->string('job_title_en');
        $table->text('bio_ar');
        $table->text('bio_en');
        $table->string('profile_picture')->nullable();
        $table->string('email')->unique();
        $table->string('phone');
        $table->enum('gender_ar', ['ذكر', 'أنثى']);
        $table->enum('gender_en', ['Male', 'Female']);
        $table->enum('marital_status_ar', ['أعزب', 'متزوج', 'مطلق']);
        $table->enum('marital_status_en', ['Single', 'Married', 'Divorced']);
        $table->date('dob');
        $table->string('personal_link')->nullable();
        $table->string('city_ar');
        $table->string('city_en');
        $table->string('country_ar');
        $table->string('country_en');
        $table->string('nationality_ar');
        $table->string('nationality_en');
        $table->text('additional_info_ar')->nullable();
        $table->text('additional_info_en')->nullable();
        $table->timestamps();

        // إضافة علاقة المفتاح الأجنبي
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
