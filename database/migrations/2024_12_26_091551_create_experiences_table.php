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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // المفتاح الأجنبي
            $table->string('company_ar');
            $table->string('company_en');
            $table->string('job_title_ar');
            $table->string('job_title_en');
            $table->date('join_date');
            $table->date('leave_date')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->string('company_logo')->nullable(); // حفظ مسار الصورة
            $table->timestamps();

            // إضافة المفتاح الأجنبي
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }

};
