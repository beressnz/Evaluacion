<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Productos</title>

         <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        
        <!-- <script src="{{ asset('js/chart.js') }}"></script> -->

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        
</head>
<div class="card border-primary mb-3 mt-5 mx-auto" style="max-width: 90%">
@foreach($productos as $producto)
    <div class="card-header">Producto</div>
    <div class="card-body text-primary">
    <div class="panel-heading">
        <h5 class="panel-title"><b>{{$producto->nombre}}</b></h5>
         
            <input type="number" name="id" id="id" step="any" class="form-control input-sm" value="{{$producto->id}}" hidden>
                    
            <div class="row mb-2">
               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label for="disabledTextInput">Sku</label>
                        <input type="number" name="precioPesos" id="precioPesos" step="any" class="form-control input-sm" value="{{$producto->sku}}" readonly>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label for="disabledTextInput">Puntos</label>
                        <input type="number" name="puntos" id="puntos" step="any" class="form-control input-sm" value="{{$producto->puntos}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Descipcion Corta</label>
                        <input type="text" name="precioDolares" id="precioDolares" step="any" class="form-control input-sm" value="{{ $producto->descripcion_corta }}" readonly>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label for="disabledTextInput">Descripcion larga</label>
                        <input type="text" name="precioPesos" id="precioPesos" step="any" class="form-control input-sm" value="{{$producto->descripcion_larga}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label for="disabledTextInput">Precio en dolares</label>
                        <input type="number" name="precioDolares" id="precioDolares" step="any" class="form-control input-sm" value="{{$producto->precioDolares}}" readonly>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Precio en pesos</label>
                        <input type="text" name="precioPesos" id="precioPesos" step="any" class="form-control input-sm" value="{{ $producto->precioPesos }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Estatus</label>
                        <div>
                        @if($producto->activo ===1 )
                            <p class="text-success"><b>Activado</b></p>
                           
                        @else
                            <p class="text-danger"><b>Desactivado</b></p>
                           
                        @endif
                        </div>
                    </div>
                </div>
            </div>

           
        @endforeach
    </div>
    </div>

    
    <div class="text-center">
        <h6><b>Proyección de incremento</b></h6>
    </div>
    <canvas id="myChart"></canvas>

   
    <div class="mx-3">
        <a href="{{ route('productos.index') }}" class="btn  btn-secondary">Atrás</a>
    </div>
   <br>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('myChart');
    var ctx = canvas.getContext('2d');
    var id = $('#id').val();
    
    fetch('proyeccion/producto/'+id) 
        
    .then(response => response.json())
    .then(data => {
        
        // Datos recibidos del servicio
        var labels = data.labels;
        var dolar = data.dolar;
        var pesos = data.pesos;

        // Datos en dolar y pesos 
        var chartData = {
            labels: labels,
            datasets: [
                {
                label: 'Dolares',
                data: dolar,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
                },
                {
                label: 'Pesos',
                data: pesos,
                backgroundColor: 'rgba(192, 75, 192, 0.2)',
                borderColor: 'rgba(192, 75, 192, 1)',
                borderWidth: 1
                }
            ]
            };

        // Opciones del gráfico de barras
        var options = {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        };

        // genera grafica de barras 
        var chart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: options
        });
        })
        .catch(error => {
        console.error('Error al obtener los datos del servicio:', error);
        });
    });

</script>

