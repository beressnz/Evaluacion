<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;


class ProductosHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $buscar = null)
    {
        //
        $productos = DB::table('productos')
        ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
        ->select('productos.*', 'producto_traducciones.*')
        ->where('productos.eliminado', '=', 0);
    
        if ($request->has('nombre')) {
            $productos->where('productos.nombre', 'LIKE', "%{$request->has('nombre')}%");
        }

        if ($buscar) {
            $productos->orWhere('productos.sku', 'LIKE', "%{$buscar}%");
        }

        $productos = $productos->orderBy('producto_traducciones.nombre')->get();

        
        return view('welcome', compact('productos'));

    }

    public function buscar(Request $request)
    {
        
        $busqueda = $request->input('buscar');

        $productos = DB::table('productos')
            ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
            ->select('productos.*', 'producto_traducciones.*')
            ->where('productos.eliminado', '=', 0);

        if ($busqueda) {
           
            $productos->Where('producto_traducciones.nombre', 'LIKE', "%{$busqueda}%")
            ->orWhere('productos.sku', 'LIKE', "%{$busqueda}%");
        }

        $productos = $productos->orderBy('producto_traducciones.nombre')->get();
        
        return view('welcome', compact('productos'));
    }

    public function orderPrecio($opc)
    {
        
        $productos = DB::table('productos')
            ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
            ->select('productos.*', 'producto_traducciones.*')
            ->where('productos.eliminado', '=', 0);

        if($opc == 1){
            $productos = $productos->orderBy('precioPesos', 'desc')->get();

        }

        if($opc == 2){
            $productos = $productos->orderBy('precioPesos', 'desc')->get();

        }
        
        return view('welcome', compact('productos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        //
        $productos= DB::table('productos')
        ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
        ->select('productos.*', 'producto_traducciones.*')
        ->where('producto_traducciones.url', '=', $url)
        ->get();

        return view('showProducto',compact('productos'));
    }


    public function mostrarGrafica($id)
    {
        $precioDolares = Productos::select('precioDolares')
                 ->where('id', $id)
                 ->first()
                 ->precioDolares;
        $precioPesos = Productos::select('precioPesos')
                 ->where('id', $id)
                 ->first()
                 ->precioPesos;
       
        
        $precioDolares  = floatval($precioDolares);
        $precioPesos     = floatval($precioPesos);
        $porcentajeIncremento = 2;
        
        for ($i = 0; $i < 6; $i++) {
            $factorIncremento = 1 + ($porcentajeIncremento / 100); // Calcular el factor de aumento
            $precioDolares *= $factorIncremento; // incremento en dolares
            $valoresCalculadosDolares[] = number_format($precioDolares,2); // almacena el valor dolares
            $precioPesos *= $factorIncremento; // incremento en pesos
            $valoresCalculadosPesos[] = number_format($precioPesos,2); // almacena el valor pesos
            $porcentajeIncremento += 2;
        }

        $labels =['mes 1','mes 2','mes 3','mes 4','mes 5','mes 6'];
        
        return response()->json(['labels' =>  $labels, 'dolar'=>$valoresCalculadosDolares,'pesos'=>$valoresCalculadosPesos]);
        
    }

}
