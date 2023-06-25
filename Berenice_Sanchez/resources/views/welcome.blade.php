<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Productos</title>

         <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        
    </head>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            @if (Route::has('login'))
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home </a>
                </li>
                       
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
               
                
                <li class="nav-item dropdown">
                <select class="form-select" >
                    <option value="es">Español</option>
                    <option value="en">Ingles</option>
                    
                </select>
                
                </li>
            
            </ul>
            @endif
            
        </div>
    </nav>
    <body class="antialiased">

    <div class="mb-3 mt-5 mx-auto" style="max-width: 90%">
        
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6">
                
            <div class="input-group mb-3">
                <form action="{{ route('productos.orderPrecio', ['opc' => 1]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">Ordenar por dolar</button>
                </form>
                <form action="{{ route('productos.orderPrecio', ['opc' => 2]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">Ordenar por pesos</button>
                </form>
                    
            </div>
                    
               
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
            <form action="{{ route('productos.buscar') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="buscar" id="buscar" placeholder="Buscar SKU/Nombre" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    <a class="btn btn-outline-secondary" href="{{ route('productos.index')}}" >Limpiar</a>
                    </div>
                </div>
              
            </form>
            
                
            </div>
        </div>
    </div>
    
    <div class="mt-5 mx-auto" style="max-width: 90%">
       
        <div class="row">
            @foreach ($productos as $producto)
            <div class="col-sm-4 mb-3">
                <div class="card card bg-light shadow">
                <div class="card-body">
                    <h5 class="card-title">{{$producto->nombre}}</h5>
                    <p class="card-text">{{$producto->descripcion_corta}}</p>
                    <a href="{{ route('productos.show', ['url' => $producto->url]) }}" class="btn btn-primary">Ver más</a>
                </div>
                </div>
            </div>
        
        @endforeach
            
        </div>

    </div>

    
       
    </body>
</html>


<script>
   function buscar() {
    var valor = document.getElementById('buscar').value;
    var url = "{{ route('productos.index', '') }}/" + valor;
    window.location.href = url;
}

</script>

