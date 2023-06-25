<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\ProductosTraducciones;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    protected $productos;
    public function __construct(Productos $productos)
    {
        $this->productos = $productos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productos = Productos::orderBy('id','Desc')->where('eliminado', 0)->paginate(8);
        return view('producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        if($this->validate(
                            $request,['sku'=>'required | unique:productos',
                                    'precioDolares'=>'required|numeric|min:0|not_in:0',
                                    'precioPesos'=>'required|numeric|min:0|not_in:0',
                                    'puntos'=>'required|numeric|min:0|not_in:0',
                                    'nombre'=>'required | regex:/[a-zA-Z\s]+$/',
                                    'descripcion_corta'=>'required|max:120',
                                    ]
                        )
        ){
           

            $product = Productos::create(
            ['sku' => $request->get('sku'),
            'precioDolares' => $request->get('precioDolares'),
            'precioPesos' => $request->get('precioPesos'),
            'puntos' => $request->get('puntos'),
            'activo' => $request->has('activo')? $request->get('activo'):0,
            'eliminado' => $request->has('eliminado')? $request->get('eliminado'):0]
            );

            $id = $product->id;
            $url = Str::slug($request->get('nombre'), '_');
            ProductosTraducciones::create(
                ['producto_id' => $id,
                'nombre' => $request->get('nombre'),
                'descripcion_corta' => $request->get('descripcion_corta'),
                'descripcion_larga' => $request->get('descripcion_larga'),
                'url' =>$url,
                'idioma' => 'es',
               
                ]
                );

            return redirect()->route('producto.index') -> with ('success','Registro creado correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $productos= DB::table('productos')
        ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
        ->select('productos.*', 'producto_traducciones.*')
        ->where('productos.id', '=', $id)
        ->get();

    
        //$productos = Productos::find($id);
        return view('producto.show',compact('productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //$productos = Productos::find($id);
        $productos= DB::table('productos')
        ->join('producto_traducciones', 'productos.id', '=', 'producto_traducciones.producto_id')
        ->select('productos.*', 'producto_traducciones.*')
        ->where('productos.id', '=', $id)
        ->get();
        return view('producto.edit',compact('productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($this->validate(
            $request,[
                        'sku'=>'required',
                        'precioDolares'=>'required|numeric|min:0|not_in:0',
                        'precioPesos'=>'required|numeric|min:0|not_in:0',
                        'puntos'=>'required|numeric|min:0|not_in:0',
                        'nombre'=>'required | regex:/[a-zA-Z\s]+$/',
                        'descripcion_corta'=>'required|max:120',    
                    ]
        )
        ){
           
           
        Productos::find($id)->update(
            [
                'sku' => $request->get('sku'),
                'precioDolares' => $request->get('precioDolares'),
                'precioPesos' => $request->get('precioPesos'),
                'puntos' => $request->get('puntos'),
                'activo' => $request->has('activo')? $request->get('activo'):0,
                'eliminado' => $request->has('eliminado')? $request->get('eliminado'):0
            ]
        );
        $url = Str::slug($request->get('nombre'), '_');
        ProductosTraducciones::where('producto_id', $id)
        ->update([
        'nombre' => $request->get('nombre'),
        'descripcion_corta' => $request->get('descripcion_corta'),
        'descripcion_larga' => $request->get('descripcion_larga'),
        'url' => $url,
        'idioma' => 'es'
    ]);

        
        return redirect()->route('producto.index') -> with ('success','Registro actualizado correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Productos::where('id', $id)->update(array('eliminado' => 1));
        return redirect()->route('producto.index')->with('success','Registro eliminado correctamente');
    }


    public function activar($id)
    {
        //
        $valor = Productos::select('activo')
                 ->where('id', $id)
                 ->first()
                 ->activo;

        if($valor ===0){
            Productos::where('id', $id)->update(array('activo' => 1));
            return redirect()->route('producto.index')->with('success','Producto activado correctamente');
        }else{
            Productos::where('id', $id)->update(array('activo' => 0));
            return redirect()->route('producto.index')->with('success','Producto desactivado correctamente');
        }       
        
    }

    public function moneda($moneda){

        $client = new HttpClient([
            'base_uri' => 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/'
        ]);
        $response = $client->request('GET','https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno?token=e1ed9e0da3c7e5cad379c4e6db5fbc341c0eed36bf81a27a2d778543ccbe0d7b', 
        [
            'verify' => false,
            'timeout' => 20, 
            'connect_timeout' => 20, 
        ]);

        $respuesta = ((array)json_decode($response->getBody())->bmx->series[0]->datos[0]->dato);
        
        $valor=$respuesta[0];
        
        $precio = (float)$valor;
        $cambio=$moneda*$precio;
        $cambio = round($cambio, 2);
        return response()->json(['data' =>  $cambio, 'cambio'=>true]);
        

        
    }
}
