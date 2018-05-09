<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cliente()
    {

        return hasOne('App\Cliente');
        
    }

    public function boletos()
    {
        
        return $this->hasMany('App\Boletos');

    }
    public function roles()
    {
        return belongsToMany('Caffeinated\Shinobi\Models\Role');
    }
}
