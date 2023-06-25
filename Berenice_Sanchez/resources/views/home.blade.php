@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="alerta" class="alert alert-success" role="alert">
                        Bienvenido al sistema.
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="width: 20rem; margin-left: 2rem; padding:1rem 1.5em">
                            <img style="max-height: 9rem;" src="https://cdn-icons-png.flaticon.com/512/1535/1535024.png" class="card-img-top mx-auto" alt="Imagen de Empresarios">
                            <div class="card-body">
                                
                                <div class="text-center">
                                <h5 class="card-title text-blue">Administrador de productos</h5>
                            <a href="{{route('producto.index')}}" class="btn btn-primary">Mostrar</a>
                        </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <br>

            </div>
        </div>
    </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var alerta = $('#alerta');

        // Ocultar la alerta después de 5 segundos
        setTimeout(function() {
            alerta.fadeOut();
        }, 5000);
    });
</script>