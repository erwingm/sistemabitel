<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    //protected $table = 'categorias';

    protected $table = ['nombre', 'descripcion','condicion'];

    public function articulos(){
        return $this->hasMany('App\Articulo');
    }

}
