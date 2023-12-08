


<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'EDITAR CARRITO')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<br><br><br><br>
<center>
<h1>EDITAR CARRITO</h1>
<img class="logo_banner"src="../../img/icono.jpg" alt="Image 2">
</center>


@if(session('user')->roles=='Administrador' )
<div class="container ">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>

                        @endif

                            <form method="post" action="{{ route('product.update',$datos->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="id" value="{{$datos->id}}">
                            <div class="form-group">
                                <label for="nameproduct">Nombre del Producto</label>
                                <input type="text" name="nameproduct" id="nameproduct" class="form-control"  value="{{$datos->nameproduct}}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion del Producto</label>
                                <input type="text" name="description" id="description" class="form-control" value="{{$datos->description}}">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock del Producto</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="{{$datos->stock}}" required>
                            </div>
                            <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" step="0.01" class="form-control"value="{{$datos->price}}" >
                            </div>
                            <div class="form-group">
                            <label for="imgproduct">Imagen del Producto</label>
                              <input type="file" name="imgproduct" id="imgproduct" class="form-control">
                         </div>
                         <?php  $user = session('user') ?>
                         <div class="form-group">

                            <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo $user->__get('id');?>"required style="display: none;"readonly>
                            </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">EDITAR</button>
                            </div>
                            </form>
                        <a href="{{route('product.index')}}" class="btn btn-defaul">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




  </tbody>
</table>
</div>
</div>
@endif


@endsection
