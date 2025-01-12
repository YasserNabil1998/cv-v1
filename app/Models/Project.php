<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name_ar',
        'project_name_en',
        'project_link',
        'project_date',
        'project_desc_ar',
        'project_desc_en',
        'user_id',
    ];

    // العلاقة بين المشروع والمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
