<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        //if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion')
            ->orderBy('productos.id','desc')->paginate(10);
        }
        else {

            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.precio_venta','productos.stock','productos.descripcion')
            ->where('productos.'.$criterio,'like', '%'.$buscar.'%')
            ->orderBy('productos.id','desc')->paginate(10);

           
        }
        return [
            'pagination' => [
                'total' => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page' => $productos->perPage(),
                'last_page' => $productos->lastPage(),
                'from' => $productos->firstItem(),
                'to' => $productos->lastItem(),
                
            ],

            'productos' => $productos
        ];
        //return $categorias;
    }



    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->condicion = '1';
        $producto->save();
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)    {
        //
        if(!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->nombre = $request->nombre;
        $producto->idcategoria = $request->idcategoria;
        $producto->codigo = $request->codigo;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->condicion = '1';
        $producto->save();
    }

    public function offcategoria(Request $request)    {
        //parecido a actualizar
        if(!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '0';
        $producto->save();
    }

    public function oncategoria(Request $request)    {
        //
        //parecido a actualizar
        if(!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '1';
        $producto->save();
    }

}
