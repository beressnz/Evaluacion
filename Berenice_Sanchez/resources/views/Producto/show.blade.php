@extends('layouts.app')
@section('content')


<div class="card border-primary mb-3 mx-auto" style="max-width: 90%">
    <div class="card-header">Producto</div>
    <div class="card-body text-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Datos de producto  </h3>
        @foreach($productos as $producto)
            

            <div class="row mb-2">
               
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                    <label for="disabledTextInput">Sku</label>
                        <input type="number" name="precioPesos" id="precioPesos" step="any" class="form-control input-sm" value="{{$producto->sku}}" readonly>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Nombre</label>
                        <input type="text" name="precioDolares" id="precioDolares" step="any" class="form-control input-sm" value="{{ $producto->nombre }}" readonly>
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
                        <label for="disabledTextInput">Url</label>
                        <input type="text" name="precioDolares" id="precioDolares" step="any" class="form-control input-sm" value="{{ $producto->url }}" readonly>
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
                    <label for="disabledTextInput">Puntos</label>
                        <input type="number" name="puntos" id="puntos" step="any" class="form-control input-sm" value="{{$producto->puntos}}" readonly>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="disabledTextInput">Estatus</label>
                        <div>
                        @if($producto->activo ===1 )
                            <p class="text-success">.<b>Activado</b></p>
                           
                        @else
                            <p class="text-danger"><b>Desactivado</b></p>
                           
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 justify-content-end">
                <div class="text-right">
                    <a href="{{ route('producto.index') }}" class="btn  btn-secondary">Atrás</a>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</div>
@endsection