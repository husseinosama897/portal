<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attending_and_leaving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attending_time',
          'out_of_place',
          'project_id',
           'status',
           'attending_leaving',
           'time_difference',
           'leaving_image',
           'attending_image',
           'min'
    ];
}
