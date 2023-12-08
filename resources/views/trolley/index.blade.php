
<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'CARRITO DE COMPRAS')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style ">
<br>  <br>  <br>  <br>
<center>
<h1>CARRITO DE COMPRAS</h1>
<img class="logo_banner"src="img/icono.jpg" alt="Image 2">
</center>
</div>
<br><!--
<form method="POST"  action="{{route('buscarproducto')}}" >
    @csrf
    <div class="form-group">

        <input type="text" name="filtro_nombre" placeholder="Nombre" class="form-control" >
    </div>

   
    <button type="submit" class="btn btn-info">Buscar</button>
</form>

-->

<button onclick="imprimirDiv()" class="btn btn-success">Imprimir</button>


<div class="container scrollable-div"id="reportid">
<table class="table boder_bar btn_modulos">
  <thead>
    <tr>
      <th>ID</th>
      @if(session('user')->roles=='Administrador' )
      <th>Nombre del Cliente</th>
      @endif
      <th>Productos</th>
      <th>Imagenes</th>
      <th>Precio</th>
      <th>Disponible</th>
      <th>Ordenar</th>
      <th>Editar</th>
     <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datos as $dato)
    @if($dato->Usuario['id']==session('user')->id && $dato->status==0  )
    <tr>
      <td>{{ $dato['id'] }}</td>
      @if(session('user')->roles=='Administrador' )
      <td>{{ $dato->Usuario['nombre_apellido'] }}</td>
      @endif
      <td>{{ $dato->Product['nameproduct'] }}</td>
      <td> <img src="{{$dato->Product['imgproduct']}}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td>

       <td>${{ $dato->Product['price'] }}</td>
       @if($dato->Product['stock']==0 )
       <td style="color:red;">No disponible</td>
       @else
       <td>{{ $dato->Product['stock'] }}</td>
       @endif
      <td>{{ $dato['created_at'] }}</td>
      @if($dato->Product['stock']>0 )
      <td><a  class="btn btn-primary" href="{{route('ordertcreate',$dato['id'])}}">Generar Orden</a></td>
      @else
      <td><a  class="btn btn-secondary" >No disponible</a></td>
      @endif
      <td>
        <form class="deleteForm" action="{{route('trolley.destroy',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
     </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
{{ $datos->links() }}
</div>




@endsection
