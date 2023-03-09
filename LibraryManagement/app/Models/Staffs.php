<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name', 'username', 'password', 'gender', 'phone', 'address'
    ];

    protected $hidden = [
        'password'
    ];
}
