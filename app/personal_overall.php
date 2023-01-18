<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal_overall extends Model
{
    protected $fillable = [
        'user_id',
        'date'
      ,
        'time',
        'percentage_attendance',
        'num_of_performers',
        'num_of_attendance',
        'percentage_performance',
        'percentage_attendance',
    ];
    use HasFactory;
}
