<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_ar',
        'company_en',
        'job_title_ar',
        'job_title_en',
        'join_date',
        'leave_date',
        'description_ar',
        'description_en',
        'company_logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
