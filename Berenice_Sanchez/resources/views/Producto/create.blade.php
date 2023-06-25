@extends('layouts.app')
@section('content')

<div class="card border-primary mb-3 mx-auto" style="max-width: 90%">
    <div class="card-header">Producto</div>
    <div class="card-body text-primary">

    <section class="content">
            <div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">Nuevo producto</h5>
                    </div>
                        
                        <form method="POST" action="{{ route('producto.store') }}"  role="form" >
                            {{ csrf_field() }}
                            @if(Session('success'))
                                <h6 class="alert alert-succes" >{{ Session('success') }}</h6>
                            @endif
                            <div  class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="disabledTextInput">Sku</label>
                                        <input type="number" name="sku" id="sku" class="form-control input-sm" placeholder="sku" value="{{old('sku')}}">
                                        @if ($errors->has('sku'))
                                            <span class="alert-danger">
                                                <strong>{{ $errors->first('sku') }}</strong>
                                            </span>
                                        @endif                                               
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="disabledTextInput">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre" value="{{old('nombre')}}">
                                        @if ($errors->has('nombre'))
                                            <span class="alert-danger">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif                                               
                                    </div>
                                </div>
                            </div>

                            <div  class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="disabledTextInput">Descripcion corta</label>
                                        <input type="text" name="descripcion_corta" id="descripcion_corta" class="form-control input-sm" placeholder="Descripcion corta" value="{{old('descripcion_corta')}}">
                                        @if ($errors->has('descripcion_corta'))
                                            <span class="alert-danger">
                                                <strong>{{ $errors->first('descripcion_corta') }}</strong>
                                            </span>
                                        @endif                                               
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="disabledTextInput">Descripcion larga</label>
                                        <input type="text" name="descripcion_larga" id="descripcion_larga" class="form-control input-sm" placeholder="Descripcion larga" value="{{old('descripcion_larga')}}">
                                        @if ($errors->has('descripcion_larga'))
                                            <span class="alert-danger">
                                                <strong>{{ $errors->first('descripcion_larga') }}</strong>
                                            </span>
                                        @endif                                               
                                    </div>
                                </div>
                            </div>

                            
                            <div  class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-8 col-md-8">
                                                <input type="number" step="0.01" name="precioDolares" id="precioDolares" step="any" class="form-control input-sm" placeholder="Precio en dolares" value="{{old('precioDolares')}}">
                                                @if ($errors->has('precioDolares'))
                                                    <span class="alert-danger">
                                                        <strong>{{ $errors->first('precioDolares') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <button class=" btn btn-success btn  btn-block" id="validarMoneda" type="button" >Agregar en pesos</button >
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="number" step="0.01" name="precioPesos" id="precioPesos" class="form-control input-sm" placeholder="Precio en pesos" value="{{old('precioPesos')}}" readonly>
                                        @if ($errors->has('precioPesos'))
                                            <span class="alert-danger">
                                                <strong>{{ $errors->first('precioPesos') }}</strong>
                                            </span>
                                        @endif
                                    
                                    </div>
                                </div>
                            </div>
                            
                            <div  class="row mb-4">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <input type="number" name="puntos" id="puntos" class="form-control input-sm" placeholder="Puntos" value="{{old('puntos')}}" >
                                    @if ($errors->has('puntos'))
                                        <span class="alert-danger">
                                            <strong>{{ $errors->first('puntos') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="activo" id="activo" class="form-check-input" value="1" >
                                        <label class="form-check-label" >Activar</label>
                                    </div>
                                        
                                </div>
                                
                            </div>

                            <br>
                            <div  class="row mb-4">

                                <div class="">
                                    <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                    <a href="{{ route('producto.index') }}" class="btn btn-secondary btn-block" >Atrás</a>
                                </div>

                            </div>
                        </form>
                      
                </div>
            </div>
        </section>
       
    </div>
 
</div>


<script type="text/javascript">

    $(document).on('click','#validarMoneda', function(){      
        var moneda = $('#precioDolares').val();
        
        $.ajax({
        type: "GET",
        url:"{{ url('/moneda/producto') }}"+'/'+moneda,
        
        success : function (response)
        {   
            
            if(response.cambio===true){
                
            $("#precioPesos").val(response.data); 
        
            }
            
        }
        });  
    });


 </script>

@endsection