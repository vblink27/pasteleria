<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'AÑADIR PRODUCTO')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
    <br><br><br><br>
    <center>
        <h1>AÑADIR PRODUCTO</h1>
        <img class="logo_banner" src="../../img/donuuts.ico" alt="Image 2">
    </center>


<div class="container">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{route('product.store')}}"enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nameproduct">Nombre del Producto</label>
                                <input type="text" name="nameproduct" id="nameproduct" class="form-control"  required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion del Producto</label>
                                <input type="text" name="description" id="description" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock del Producto</label>
                                <input type="number" id="stock" name="stock" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" step="0.01" class="form-control" >
                            </div>
                            <div class="form-group">
                            <label for="imgproduct">Imagen del Producto</label>
                              <input type="file" name="imgproduct" id="imgproduct" class="form-control" value="">
                         </div>
                         <?php  $user = session('user') ?>
                         <div class="form-group">

                            <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo $user->__get('id');?>"required style="display: none;"readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </form>
                        <a href="{{route('product.index')}}" class="btn btn-defaul">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
