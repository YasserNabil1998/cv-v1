<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserTemplateSetting extends Model
{
    use HasFactory;

    protected $table = 'user_template_settings';
    protected $fillable = [
        'user_id',
        'template_name',
        'font_family',
        'font_color',
        'heading_color',
        'background_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
