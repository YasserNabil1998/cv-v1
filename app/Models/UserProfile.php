<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'user_id',
        'name_en',
        'job_title_ar',
        'job_title_en',
        'bio_ar',
        'bio_en',
        'profile_picture',
        'email',
        'phone',
        'gender_ar',
        'gender_en',
        'marital_status_ar',
        'marital_status_en',
        'dob',
        'personal_link',
        'city_ar',
        'city_en',
        'country_ar',
        'country_en',
        'nationality_ar',
        'nationality_en',
        'additional_info_ar',
        'additional_info_en',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }



}



