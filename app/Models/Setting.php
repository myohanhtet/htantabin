<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table = 'settings';

    protected $fillable = ['key','value','type'];

    public static function getValue($key)
    {
        return self::where('key',$key)->first()->value;
    }

}
