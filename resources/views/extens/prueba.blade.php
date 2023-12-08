{{$user}}

<a href="/distritos/index" class="btn btn-primary">Crear Usuario</a>
@if(session('roles')->codigo_rol>=0)
<div class="container ">
<table class="table boder_bar">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Usuario</th>
      <th>Rol</th>
      <th>Clave</th>
      <th>Clave</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datos as $dato)
    <tr>
      <td>{{ $dato['id'] }}</td>
      <td>{{ $dato['nombre_apellido'] }}</td>
      <td>{{ $dato['correo'] }}</td>
      <td>{{ $dato['usuario'] }}</td>
      <td>{{ $dato['rol'] }}</td>
      <td>{{ $dato['clave'] }}</td>
      <td>{{ $dato['clave'] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>

@endsection
@endif
