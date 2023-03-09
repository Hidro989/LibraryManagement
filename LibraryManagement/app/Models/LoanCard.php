<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCard extends Model
{
    use HasFactory;
    public $table = "loancards";
    public $timestamps = false;
}
