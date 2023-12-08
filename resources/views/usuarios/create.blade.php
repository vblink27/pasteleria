<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'CREAR USUARIOS')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<br><br><br><br>
    <center>
        <h1>CREAR USUARIOS</h1>
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

                        <form method="POST" action="{{route('usuarios.store')}}"enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nombre_apellido">Nombres y Apellidos</label>
                                <input type="text" name="nombre_apellido" id="nombre_apellido" class="form-control" placeholder="" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Nombre de Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="correo">Email</label>
                                <input type="email" id="correo" name="correo" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="clave">Password</label>
                                <input type="password" id="clave" name="clave" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <label for="roles">Selecciona un Rol:</label>
                            <select name="roles" id="roles" class="form-control">
                            <option value="Cliente"> Cliente</option>
                            <option value="Repartidor"> Repartidor</option>
                            <option value="Administrador"> Administrador</option>
                            </select>
                            </div>
                            <div class="form-group">
                            <label for="dni">CI</label>
                            <input type="text" name="dni" id="dni" class="form-control" maxlength="10" min="10" max="10" >
                            </div>
                            <div class="form-group">
                            <label for="phones">Phones</label>
                            <input type="text" name="phones" id="phones" class="form-control" maxlength="10" min="10" max="10">
                            </div>
                            <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control" >
                            </div>


                            <div class="form-group">
                            <label for="account">Account</label>
                            <input type="text" name="account" id="account" class="form-control"  maxlength="10" min="10" max="10">
                            </div>
                            <div class="form-group">
                            <label for="imgprofile">Imgprofile</label>
                              <input type="file" name="imgprofile" id="imgprofile" class="form-control" value="">
                         </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                        <a href="{{route('usuarios.index')}}" class="btn btn-defaul">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
