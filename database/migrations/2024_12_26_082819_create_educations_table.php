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
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // مفتاح أجنبي للإشارة إلى المستخدم
        $table->string('institution_ar'); // الجهة التعليمية - بالعربية
        $table->string('institution_en'); // الجهة التعليمية - بالإنجليزية
        $table->string('major_ar'); // التخصص - بالعربية
        $table->string('major_en'); // التخصص - بالإنجليزية
        $table->string('degree'); // الدرجة العلمية (يمكن أن تكون موحدة بين اللغتين)
        $table->date('graduation_date'); // تاريخ التخرج
        $table->text('description_ar'); // وصف بسيط - بالعربية
        $table->text('description_en'); // وصف بسيط - بالإنجليزية
        $table->timestamps();

        // إضافة المفتاح الأجنبي
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
