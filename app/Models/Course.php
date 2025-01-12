<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    use HasFactory;
    protected $fillable = [
        'course_name_ar',
        'course_name_en',
        'institute_ar',
        'institute_en',
        'course_date',
        'course_description_ar',
        'course_description_en',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
