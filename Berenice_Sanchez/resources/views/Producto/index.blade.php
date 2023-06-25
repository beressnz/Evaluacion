@extends('layouts.app')
@section('content')

<div class="card border-primary mb-3 mx-auto" style="max-width: 90%">
    <div class="card-header">Productos</div>
    <div class="card-body text-primary">
    
        <div class="d-flex justify-content-end">
            <a href="{{route('producto.create')}}" class="btn btn-primary">Agregar producto</a>
        </div>

        <h5 class="card-title">Lista productos</h5>

        <br>

        <table id="mytable" class="table table-bordered">
                                <thead>
                                <th>Sku</th>
                                <th>Precio en dolares</th>
                                <th>Precio en pesos</th>
                                <th>Puntos</th>
                                <th>Activo</th>
                                <th>Show</th>
                                <th>Editar</th>
                                <th>Activar/Desactivar</th>
                                <th>Eliminar</th>
                                </thead>
                                <tbody>
                                @if($productos->count())
                                    @foreach($productos as $producto)
                                        <tr>
                                            <td>{{$producto->sku}}</td>
                                            <td>{{$producto->precioDolares}}</td>
                                            <td>{{$producto->precioPesos}}</td>
                                            <td>{{$producto->puntos}}</td>
                                          
                                            @if($producto->activo ===1 )
                                                <td class="text-success text-center"> <b>Si</b></td>
                                            @else
                                                <td class="text-danger text-center"> <b>No</b></td>
                                            @endif
                                            
                                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('producto.show', ['producto' => $producto->id]) }}" >Ver</a></td>
                                                                                       
                                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('producto.edit', ['producto' => $producto->id]) }}" >Editar</a></td>
                                            @if($producto->activo ===1 )
                                            <td class="text-center">
                                            <form action="{{ route('productos.activar', ['id' => $producto->id]) }}" method="get">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="ACTIVAR">

                                                    <button class="btn btn-danger btn-sm" type="submit">Desactivar</button>

                                                </form>
                                            </td>
                                            @else
                                            <td class="text-center">
                                            <form action="{{ route('productos.activar', ['id' => $producto->id]) }}" method="get">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="ACTIVAR">

                                                    <button class="btn btn-success btn-sm" type="submit">Activar</span></button>

                                                </form>
                                               
                                            </td>
                                            @endif

                                            
                                            <td class="text-center">
                                                
                                                <form action="{{ route('producto.destroy', ['producto' => $producto->id]) }}" method="POST" id="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete()" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12">No hay productos  !!</td>
                                    </tr>
                                @endif
                                </tbody>

                            </table>
    </div>

    
 
</div>




@endsection

<script>
    function confirmDelete() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer',
        icon: 'delete',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        confirmButtonClass: 'btn btn-danger ',
        buttonsStyling: false,
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-secondary',
    }).then((result) => {
        if (result.isConfirmed) {
            // El usuario ha confirmado la eliminación
            document.getElementById('delete-form').submit();
        }
    });
}
</script>