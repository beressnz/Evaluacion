@extends('layouts.app')
@section('content')

<div class="card border-primary mb-3 mx-auto" style="max-width: 90%">
    <div class="card-header">Producto</div>
    <div class="card-body text-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Editar producto  </h3>

            <div class="row">
        <section class="content">
            <div class="">
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
                    
                    <div class="panel-body">
                        <div class="table-container">
                        @foreach($productos as $productos)
                            <form method="POST" action="{{ route('producto.update',$productos->id) }}"  role="form">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">

                                <div  class="row mb-4">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Sku</label>
                                           <input type="number" name="sku" id="sku" class="form-control input-sm" placeholder="sku" value="{{old('sku',$productos->sku)}}" readonly>       
                                        </div>
                                        
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre" value="{{old('nombre',$productos->nombre)}}">
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
                                           <input type="text" name="descripcion_corta" id="descripcion_corta" class="form-control input-sm" placeholder="Descripcion corta" value="{{old('descripcion_corta',$productos->descripcion_corta)}}" >       
                                        </div>
                                        
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="disabledTextInput">Descripcion larga</label>
                                            <input type="text" name="descripcion_larga" id="descripcion_larga" class="form-control input-sm" placeholder="Descripcion larga" value="{{old('descripcion_larga',$productos->descripcion_larga)}}">
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
                                                    <input type="number" name="precioDolares" id="precioDolares" class="form-control input-sm" placeholder="precio en dDolares" value="{{old('precioDolares',$productos->precioDolares)}}">
                                                    @if ($errors->has('precioDolares'))
                                                        <span class="alert-danger">
                                                            <strong>{{ $errors->first('precioDolares') }}</strong>
                                                        </span>
                                                    @endif

                                                    <span class="alert-danger" id="dolarInvalido">
                                                        <strong> </strong>
                                                    </span>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <button class=" btn btn-success btn  btn-block" id="validarMoneda" type="button" >Agregar en pesos</button >
                                                </div>

                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                    <input type="text" name="precioPesos" id="precioPesos" class="form-control input-sm" placeholder="precio en pesos" value="{{old('precioPesos',$productos->precioPesos)}}" readonly>
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
                                        <div class="form-group">
                                            <input type="number" name="puntos" id="puntos" class="form-control input-sm" placeholder="Puntos" value="{{old('puntos',$productos->puntos)}}" >
                                            @if ($errors->has('puntos'))
                                                <span class="alert-danger">
                                                    <strong>{{ $errors->first('puntos') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                       
                                       <div class="form-check">
                                           <input type="checkbox" name="activo" id="activo" class="form-check-input" value="1" value="{{old('activo',$productos->activo)}}"
                                                   {{$productos->activo == 1 ? 'checked' : ''}}>
                                           <label class="form-check-label" for="exampleCheck1">Activo</label>
                                       </div>
                                           
                                   </div>

                                </div>


                               
                                <br>
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                        <a href="{{ route('producto.index') }}" class="btn btn-secondary btn-block" >Atrás</a>
                                    </div>

                                </div>
                            </form>
                        @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </section>

        
        </div>
    </div>
</div>
@endsection


<script type="text/javascript">

            $(document).on('click','#validarMoneda', function(){      
                var moneda = $('#precioDolares').val();
                $.ajax({
                type: "GET",
                url:"{{ url('/moneda/empleado') }}"+'/'+moneda,
                
                success : function (response)
                {   
                    
                    if(response.cambio===true){
                        
                    $("#precioPesos").val(response.data); 
                   
                    }
                    
                    
                }
                });  
            });

   
        </script>