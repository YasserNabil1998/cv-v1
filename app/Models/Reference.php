<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name_ar', 'name_en', 'email', 'phone', 'bio_en', 'bio_ar'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
