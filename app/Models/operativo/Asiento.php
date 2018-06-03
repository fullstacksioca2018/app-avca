<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    protected $table = "asientos";
    protected $fillable =[
        'puesto'
    ];
}
