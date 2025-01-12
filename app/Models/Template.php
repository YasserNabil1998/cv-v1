<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'template_name' , 'name' , 'url', 'password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
