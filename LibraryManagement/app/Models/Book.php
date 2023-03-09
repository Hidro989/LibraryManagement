<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $primaryKey = 'isbn';
    public $timestamps = false;
=======
    public $timestamps = false;

    protected $fillable = [
        'isbn', 'name', 'idStaff', 'idTypeBook', 'author', 'publisher', 'publishingYear', 'status'
    ];
>>>>>>> d5805f675130db0dd31faffff9d64a936a542807
}
