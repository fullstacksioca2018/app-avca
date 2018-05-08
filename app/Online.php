<?php

namespace App;

use App\Notifications\OnlineResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Online extends Authenticatable
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new OnlineResetPassword($token));
    }

    public function cliente()
    {

        return hasOne('App\Model\Online\Cliente');
        
    }

    public function boletos()
    {
        
        return $this->hasMany('App\Model\Online\Boletos');

    }
}
