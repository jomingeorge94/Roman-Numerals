<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegerConversion extends Model
{
    protected $table = "integer_conversion";
    protected $primaryKey = 'id';
    protected $fillable = [
        'integer',
        'roman_numeral',
        'number_of_times_converted'
    ];

}
