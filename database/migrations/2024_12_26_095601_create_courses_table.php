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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name_ar');
            $table->string('course_name_en');
            $table->string('institute_ar');
            $table->string('institute_en');
            $table->date('course_date');
            $table->text('course_description_ar');
            $table->text('course_description_en');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // تعيين العلاقة بجدول المستخدمين
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
