


<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'COMPRAR')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<br><br><br><br>
<center>
<h1>COMPRAR</h1>
<img class="logo_banner"src="../../img/icono.jpg" alt="Image 2">
</center>



<div class="container ">

     

                
                   
<style>
        /* Personaliza los estilos aquí */
        .product-container {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 20px;
            text-align: center;
        }
        .product-image {
            max-width: 100%;
        }
    </style>
<div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="product-container">
                    <img src="../{{$datos['imgproduct']}}" alt="Pastel de Chocolate" class="product-image witimg">
                    <h2>{{$datos->nameproduct}}</h2>
                    <p>Precio: ${{$datos->price}}</p>
                    <p>Descripción: {{$datos['description']}}</p>
                    <form method="POST" action="{{route('trolley.store')}}"enctype="multipart/form-data">
                    @csrf
                    <?php  $user = session('user') ?>
                         <div class="form-group">
                         <input type="hidden" id="id_product" name="id_product" class="form-control" value="{{$datos->id}}"required style="display: none;"readonly>
                         
                            <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php if(empty(!$user)) {echo $user->__get('id');}?>"required style="display: none;"readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Compar(Añadir a Carrito)</button>
                        </form>
                </div>
            </div>
        </div>
    </div>



</div>


@endsection
