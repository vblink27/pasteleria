
<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'PRODUCTOS')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style ">
<br>  <br>  <br>  <br>
<center>
<h1>PRODUCTOS</h1>
<img class="logo_banner"src="img/donuuts.ico" alt="Image 2">
</center>
</div>
<br>
<form method="POST"  action="{{route('buscarproducto')}}" >
    @csrf
    <div class="form-group">

        <input type="text" name="filtro_nombre" placeholder="Nombre" class="form-control" >
    </div>
    @if(session('user')->roles=='Administrador' )
    <!-- Agrega más campos de filtro según tus necesidades -->
    <button type="submit" class="btn btn-info">Buscar</button>
</form>

<a href="{{route('product.create')}} " class="btn btn-primary">Añadir Producto</a>

<button onclick="imprimirDiv()" class="btn btn-success">Imprimir</button>

<div class="container scrollable-div"id="reportid">
<table class="table boder_bar btn_modulos">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Stock</th>
      <th>Imagen</th>
      <th>Precio</th>
      <th>Fecha</th>
      <th>Editar</th>
     <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datos as $dato)
    
    <tr>
      <td>{{ $dato['id'] }}</td>
      <td>{{ $dato['nameproduct'] }}</td>
      <td>{{ $dato['description'] }}</td>
      <td>{{ $dato['stock'] }}</td>
    
      <td> <img src="{{$dato['imgproduct']}}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td>
      <td>{{ $dato['price'] }}</td>
      <td>{{ $dato['created_at'] }}</td>
     
      <td><a  class="btn btn-primary" href="{{route('product.edit',$dato['id'])}}">Editar</a></td>

      <td>
        <form class="deleteForm" action="{{route('product.destroy',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
     </td>
    </tr>
   
    @endforeach
  </tbody>
</table>
{{ $datos->links() }}
</div>

@endif


@endsection
