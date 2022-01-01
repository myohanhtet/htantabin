<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathan extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount','material','mtl_value','donor','address','times','user_id'
    ];

    public function setAmountAttribute($value){
        $this->attributes['amount']  = mm_number($value);
    }

    public function setMtlValueAttribute($value){
        $this->attributes['mtl_value']  = mm_number($value);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
