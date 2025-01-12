<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // تعريف العلاقة مع التعليم
    public function educations()
    {
        return $this->hasMany(Education::class);
    }


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function experiences()
    {
        return $this->hasMany(Education::class);
    }
    public function skills()
    {
        return $this->hasMany(Education::class);
    }

    public function projects()
    {
        return $this->hasMany(Education::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function templateSettings()
    {
        return $this->hasMany(UserTemplateSetting::class);
    }
}
