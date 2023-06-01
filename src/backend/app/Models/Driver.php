<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    /**
     * quarded
     *
     * @var array
     */

     protected $fillable = [
        'user_id',
        'year',
        'make',
        'model',
        'color',
        'license_plate',
     ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

}
