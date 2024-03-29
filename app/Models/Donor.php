<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donors';

    protected $fillable = [
        'name',
        'address',
        'material',
        'email',
        'phone',
        'times'
    ];
}
