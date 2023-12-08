<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'PROFILE')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<center>
<br> <br><br> <br>

<img class="logo_banner"src="img/donuuts.ico" alt="Image 2">
</center>
<style>
.square-button {
  display: inline-block;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  color: #000000;
  background-color: white;
  border: 1px solid #000000;
  border-radius: 0;
  cursor: pointer;
}
</style>

<div class="container">
  <div class="row">

  <?php  $user = session('user');
         $personal = session('personal');

  ?>
  
  <?php  if ($user->__get('roles') >= "Administrador"){?>

    <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">Bienvenidos a Sweet and Donuts</li>
          </ol>
        </nav>
      </div>
    </div>
    <style>
        .perfil {
            width: 100px; /* Ancho de la imagen */
            height: 100px; /* Altura de la imagen */
            border-radius: 50%; /* Hace que el borde sea circular */
            overflow: hidden; /* Oculta cualquier parte de la imagen que se salga del círculo */
        }
    </style>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="{{$user->imgprofile}}" alt="avatar"
              class="rounded-circle img-fluid  perfil" >
            <h5 class="my-3">{{$user->usuario}}</h5>
            <p class="text-muted mb-1">{{$user->nombre_apellido}}</p>
            <p class="text-muted mb-4">{{$user->correo}}</p>
            <div class="d-flex justify-content-center mb-2">
              <a href="{{route('trolley.index')}}" class="btn btn-primary">Carrito</a>
              <a href="{{route('purchaorder.index')}}"  class="btn btn-outline-primary ms-1">Compras</a>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning">CI:</i>
                <p class="mb-0">{{$user->dni}}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;">Phone:</i>
                <p class="mb-0">{{$user->phones}}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;">Account:</i>
                <p class="mb-0">{{$user->account}}</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;">Address:</i>
                <p class="mb-0">{{$user->address}}</p>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
           
          <div class="row">
             
              @if(session('user')->roles=='Administrador' )
              <div class="col-sm-3">
                <p class="mb-0">ADMINISTRAR LOS USUARIOS</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><a href="{{route('usuarios.index')}}">USUARIOS</a></p>
              </div>
              <div class="col-sm-3">
                <p class="mb-0">ADMINISTRAR LOS PRODUCTOS</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><a href="{{route('product.index')}}">PRODUCTOS</a></p>
              </div>
              @endif
            </div>
           
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              
               
              </div>
            </div>
          </div>
          <div class="col-md-6">
          <div class="card">

<div class="card-body">
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <h2>EDITAR</h2>
    <form method="POST" action="{{ route('editar_usuario',$user->id) }}" enctype="multipart/form-data">
    @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group">
            <label for="nombre_apellido">Nombres y Apellidos</label>
            <input type="text" name="nombre_apellido" id="nombre_apellido" class="form-control"  value="{{$user->nombre_apellido}}">
        </div>
        <div class="form-group">
            <label for="usuario">Nombre de Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="{{$user->usuario}}">
        </div>
     <!--   <div class="form-group">
            <label for="correo">Email</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{$user->correo}}">
        </div>-->

        <div class="form-group">
            <label for="clave">Clave</label>
            <input type="password" id="clave" name="clave" class="form-control" value="{{$user->clave}}">
        </div>
        <div class="form-group">
            <label for="dni">CI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{$user->dni}}"maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="phones">Telefono</label>
            <input type="text" name="phones" id="phones" class="form-control"value="{{$user->phones}}"maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="address">Direccion</label>
            <input type="text" name="address" id="address" class="form-control" value="{{$user->address}}">
        </div>
          <div class="form-group">
          <label for="roles">Selecciona un Rol:</label>
          <select name="roles" id="roles" class="form-control">
       
          <option value="{{$user->roles}}"> {{$user->roles}}</option>
      

          </select>
          </div>
                        
        <div class="form-group">
            <label for="account">Numero de Cuenta</label>
            <input type="text" name="account" id="account" class="form-control" value="{{$user->account}}"maxlength="10" min="10" max="10">
        </div>
        <div class="form-group">
            <label for="imgprofile">Imagen de Perfil</label>
            <input type="file" name="imgprofile" id="imgprofile" class="form-control" value="{{$user->imgprofile}}">
        </div>
    
      
        <div class="form-group">
        <button type="submit" class="btn btn-primary">EDITAR</button>
        </div>
    </form>
</div>
</div>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  
    <?php }?>
  </div>
</div>
</div>
@endsection



