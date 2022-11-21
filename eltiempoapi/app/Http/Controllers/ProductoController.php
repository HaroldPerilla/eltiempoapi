<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller{
    
    Public function index(){

        //$datosProducto = Producto::all();
        $datosProducto = Producto::all()->where('activo','1');
        if($datosProducto){
            return response()->json($datosProducto);
        }else{
            $mensaje='No se encontraron productos';
            return response()->json($mensaje);
        }
        
    }

    Public function guardar(Request $request){
        $mensaje='';
        $datosProducto = new Producto;
        $datosProducto->nombre = $request->nombre;
        $datosProducto->cantidad = $request->cantidad;
        $datosProducto->precio = $request->precio;
        $datosProducto->activo = 1;
        if($datosProducto->save()){
            $mensaje = 'Se ha creado el producto correctamente';
        }else{
            $mensaje = 'Ha ocurrido un error';
        }
        
        return response()->json($mensaje);
    }

    Public function mostrar(Request $request){
        if($request->input('id')){
            $datosProducto = new Producto;
            $datosEncontrados = $datosProducto->find($request->input('id'));
            if($datosEncontrados){
                return response()->json($datosEncontrados);
            }else{
                $mensaje = 'Producto no encontrado';
                return response()->json($mensaje);
            }
        }else{
            $mensaje='Ha ocurrido un error con los datos recibidos';
            return response()->json($mensaje);
        }    
        
    }

    Public function eliminar(Request $request){
        $mensaje='';
        if($request->input('id')){
            $datosProducto = Producto::find($request->input('id'));
            if($datosProducto){
                $datosProducto->activo = 0;
                if($datosProducto->save()){
                    $mensaje='Se ha eliminado el producto: '.$datosProducto->nombre;
                }else{
                    $mensaje='Ha ocurrido un error';
                }
                
            }else{
                $mensaje='Ha ocurrido un error al buscar el producto';
            }
        }else{
            $mensaje='Ha ocurrido un error con los datos recibidos';
        }    
        return response()->json($mensaje);
    }

    Public function actualizar(Request $request){
        $mensaje='';
        if($request->input('id')){
            $datosProducto = Producto::find($request->input('id'));
            if($datosProducto){
                if($request->input('nombre')){
                    $datosProducto->nombre=$request->input('nombre');           
                }
                if($request->input('cantidad')){
                    $datosProducto->cantidad=$request->input('cantidad');           
                }
                if($request->input('precio')){
                    $datosProducto->precio=$request->input('precio');           
                }
                if($datosProducto->save()){
                    $mensaje='Se ha actualizado el producto: '.$datosProducto->nombre;
                }else{
                    $mensaje='Ha ocurrido un error';
                }
            }else{
                $mensaje='Ha ocurrido un error al buscar el producto';
            }
        }else{
            $mensaje='Ha ocurrido un error con los datos recibidos';
        }         
        return response()->json($mensaje);
    }

}