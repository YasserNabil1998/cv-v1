<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','national_address_ar', 'national_address_en'
    ];


    public function address()
    {
        return $this->belongsTo(User::class);
    }

}
