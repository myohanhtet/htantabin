<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'lucky_no',
        'amount',
        'mtl_value',
        'mtl',
        'donor',
        'address',
        'times',
        'number',
        'invoice_number',
        'user_id'
    ];


    public function setAmountAttribute($value){
        $this->attributes['amount']  = mm_number($value);
    }

    public function setMtlValueAttribute($value){
        $this->attributes['mtl_value']  = mm_number($value);
    }

    public function setLuckyNoAttribute($value){
        $this->attributes['lucky_no']  = mm_number($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        //create Auto Increment Invoice number with Times;
        static::creating(function ($model){
            $model->number = Invoice::where('times',setting('times'))
                ->max('number') + 1;
            $model->invoice_number = setting('times') .'-'. str_pad($model->number,5,0,STR_PAD_LEFT);
        });

    }
}
