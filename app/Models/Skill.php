<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill_ar', 'skill_en', 'level_ar', 'level_en', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
