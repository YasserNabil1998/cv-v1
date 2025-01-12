<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    // اسم الجدول المرتبط بالموديل
    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'institution_ar',
        'institution_en',
        'major_ar',
        'major_en',
        'degree',
        'graduation_date',
        'description_ar',
        'description_en',
    ];

     // تعريف العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
