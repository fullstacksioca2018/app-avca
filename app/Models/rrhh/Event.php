<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $fillable = ['title', 'color', 'start', 'end'];
}
