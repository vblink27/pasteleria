


<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'EDITAR USUARIO')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<br><br><br><br>
<center>
<h1>EDITAR USUARIO</h1>
<img class="logo_banner"src="../../img/donuuts.ico" alt="Image 2">
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

                        <form method="post" action="{{ route('usuarios.update',$datos->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                             @csrf

                             <input type="hidden" name="id" value="{{$datos->id}}">
        <div class="form-group">
            <label for="nombre_apellido">Nombres y Apellidos</label>
            <input type="text" name="nombre_apellido" id="nombre_apellido" class="form-control"  value="{{$datos->nombre_apellido}}">
        </div>
        <div class="form-group">
            <label for="usuario">Nombre de Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="{{$datos->usuario}}">
        </div>
    <div class="form-group">
            <label for="correo">Email</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{$datos->correo}}">
        </div>

        <div class="form-group">
            <label for="clave">Password</label>
            <input type="password" id="clave" name="clave" class="form-control" value="{{$datos->clave}}">
        </div>
        <div class="form-group">
            <label for="dni">CI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{$datos->dni}}"maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="phones">Phones</label>
            <input type="text" name="phones" id="phones" class="form-control"value="{{$datos->phones}}" maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{$datos->address}}">
        </div>
          <div class="form-group">
          <label for="roles">Selecciona un Rol:</label>
          <select name="roles" id="roles" class="form-control">
          <option value="{{$datos->roles}}"> {{$datos->roles}}</option>
          <option value="Repartidor">Repartidor</option>
          <option value="Cliente">Cliente</option>
          <option value="Administrador">Administrador</option>
     
          </select>
          </div>
                        
        <div class="form-group">
            <label for="account">Account</label>
            <input type="text" name="account" id="account" class="form-control" value="{{$datos->account}}"maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="imgprofile">Imgprofile</label>
            <input type="file" name="imgprofile" id="imgprofile" class="form-control" value="{{$datos->imgprofile}}">
        </div>
    
      
        <div class="form-group">
        <button type="submit" class="btn btn-primary">EDITAR</button>
        </div>
                        </form>
                        <a href="{{route('usuarios.index')}}" class="btn btn-defaul">Regresar</a>
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
