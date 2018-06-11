<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $primaryKey = "sucursal_id";
    protected $fillable = ['tipo_sucursal', 'nombre', 'estatus', 'ciudad'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empleado_id', 'sucursal_id');
    }
}
