
<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'USUARIOS')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style ">
  <br>  <br>  <br>  <br>
<center>
<h1>USUARIOS</h1>
<img class="logo_banner"src="img/donuuts.ico" alt="Image 2">
</center>
</div>
<br>
<form method="POST"  action="{{route('buscarus')}}" >
    @csrf
    <div class="form-group">

        <input type="text" name="filtro_nombre" placeholder="Correo" class="form-control" >
    </div>
    @if(session('user')->roles=='Administrador' )
    <!-- Agrega más campos de filtro según tus necesidades -->
    <button type="submit" class="btn btn-info">Buscar</button>
</form>

<a href="{{route('usuarios.create')}} " class="btn btn-primary">Crear Usuario</a>

<button onclick="imprimirDiv()" class="btn btn-success">Imprimir</button>


<div class="container scrollable-div"id="reportid">
<table class="table boder_bar btn_modulos">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Usuario</th>
      <th>Rol</th>
      <th>Cedula</th>
      <th>Telefono</th>
      <th>Direccion</th>
      <th>Cuenta de banco</th>
      <th>Img</th>
      <th>Fecha</th>
      <th>Editar</th>
     <th>Eliminar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datos as $dato)
    
    <tr>
      <td>{{ $dato['id'] }}</td>
      <td>{{ $dato['nombre_apellido'] }}</td>
      <td>{{ $dato['correo'] }}</td>
      <td>{{ $dato['usuario'] }}</td>
      <td>{{ $dato['roles'] }}</td>
      <td>{{ $dato['dni'] }}</td>
      <td>{{ $dato['phones'] }}</td>
      <td>{{ $dato['address'] }}</td>
      <td>{{ $dato['account'] }}</td>
      <td> <img src="{{$dato['imgprofile']}}" alt="avatar"
              class="rounded-circle img-fluid  perfil" ></td>
      <td>{{ $dato['created_at'] }}</td>
      </td>
      <td><a  class="btn btn-primary" href="{{route('usuarios.edit',$dato['id'])}}">Editar</a></td>

      <td>
        <form class="deleteForm" action="{{route('usuarios.destroy',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
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
