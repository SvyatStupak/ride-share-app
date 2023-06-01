<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $quarded = [];

    protected $fillable = [
        'name',
        'phone',
        'login_code',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'login_code',
        'remember_token',
    ];

    public function routeNotificationForTwilio()
    {
        return $this->phone;
    }

    /**
     * driver
     *
     * @return void
     */
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    /**
     * trips
     *
     * @return void
     */
    public function trips() {
        return $this->hasMany(Trip::class);
    }

}
