<?php

namespace App;

use App\Notifications\OnlineResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;


class Online extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password', 'avatar'
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

    public function cliente($id){
        return DB::Table('clientes')->where('user_id',$id)->first();
    }

    public function boletos($id){
        return DB::Table('boletos')
            ->select('boletos.*')
            ->where('user_id',$id)
            ->join('vuelos','vuelos.id','boletos.vuelo_id')
            ->orderBy('vuelos.fecha_salida')
            ->get();
    }

    public function pasajeros($id){
        return DB::Table('boletos')
            ->where('user_id',$id)
            ->where('tipo_boleto','adulto')
            ->groupBy('boletos.documento')
            ->get();
    }
    public function pasajerosN($id){
        return DB::Table('boletos')
            ->where('user_id',$id)
            ->where('tipo_boleto','bebe en brazos')
            ->groupBy('boletos.documento')
            ->get();
    }
}
