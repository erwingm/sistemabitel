<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $fillable = ['nombre', 'apellidos','tipo_documento','num_documento','direccion','telefono','email'];
}
