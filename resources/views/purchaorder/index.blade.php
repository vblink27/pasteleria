
<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'ORDENES DE COMPRA')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style ">
<br>  <br>  <br>  <br>
<center>
<h1>ORDENES DE COMPRA</h1>
<img class="logo_banner"src="img/icono.jpg" alt="Image 2">
</center>
</div>
<br><!--
<form method="POST"  action="{{route('buscarordenecompras')}}" >
    @csrf
    <div class="form-group">

        <input type="text" name="filtro_correo" placeholder="Correo" class="form-control" >
    </div>
  
  
    <button type="submit" class="btn btn-info">Buscar</button>
</form>-->


<button onclick="imprimirDiv()" class="btn btn-success">Imprimir</button>
<style>
    .completed {
        background-color: green;
        border-radius:10px;
    }

    .repayment {
        background-color: red;
        border-radius:10px;
    }

    .sent {
        background-color: orange;
        border-radius:10px;
    }

    .order {
        background-color: blue;
        border-radius:10px;
    }
</style>
@if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
<div class="container scrollable-div"id="reportid">
<table class="table boder_bar btn_modulos">
  <thead>
    <tr>
      <th>ID</th>
      <th>Pedido</th>
      <th>Decripcion</th>
      <th>Disponibles</th>
      <th>Imagen del Porducto</th>
    
      <th>Unidades</th>
      <th>Nombre del Cliente</th>
      <th>Telefono del Cliente</th>
      <th>Correo del Cliente</th>
      <th>Direcion de Entrega</th>
      <th>Nombre del Repartidos</th>
      <th>Telefono del Repartido </th>
      <th>Precio a Pagar</th>
      <th>Comprobante del Pago</th>
      <th>Imagen de producto entregado</th>
      <th>Fecha</th>
     
     
      @if(session('user')->roles=='Administrador')
      <th></th>
      <th></th>
      <th></th>
      @endif
     @if(session('user')->roles=='Repartidor' || session('user')->roles=='Administrador')
     <th></th>
     @endif
     @if(session('user')->roles=='Cliente' || session('user')->roles=='Administrador')
     <th></th>
     @endif
    </tr>
  </thead>
  <tbody>
    @foreach( $matriz['datos'] as $dato)
    @if($dato->Usuario['id']==session('user')->id ||session('user')->roles=='Administrador' || $dato->repartido['id'] ==session('user')->id )
    <tr>
      <td>{{ $dato['id'] }}</td>
      <td>{{ $dato->Trolley->product->nameproduct }}</td>
        <td>{{ $dato->Trolley->product->description }}</td>
        <td>{{ $dato->Trolley->product->stock }}</td>
    
      <td> <img src="{{$dato->Trolley->product->imgproduct}}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td>
         
       <td>{{ $dato['units'] }}</td>
        <td>{{ $dato->cliente['nombre_apellido'] }}</td>
     
        <td>{{ $dato->cliente['phones'] }}</td>
        <td>{{ $dato->cliente['correo'] }}</td>
        <td>{{ $dato['address'] }}</td>
        
        <td>

        <form class="deleteForm" action="{{route('repartidores',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">  
                       @method('PUT')
                             @csrf
            <input type="hidden" name="id" value="{{$dato['id']}}">
                   <select name="id_repartidor" id="id_repartidor" class="form-control">
                                    @foreach ($matriz['repartidor'] as $datos)
                                   
                                        <option value="{{ $datos->id }}"
                                            {{ $dato->repartido['id']== $datos->id ? 'selected' : '' }}>
                                            {{ $datos->nombre_apellido}}
                                        </option>
                                       
                                    @endforeach
                                </select>
  
                                @if($dato['status']=="Order"&&session('user')->roles=='Administrador')
          <button type="submit" class="btn btn-primary">Enviar</button>
          @endif
          </form>
        </td>
        <td>{{ $dato->repartido['phones'] }}</td>
        <td>{{ $dato['pricetotal'] }}</td>
        <td> <img src="{{ $dato['img_pago'] }}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td>
              
        <td>  <?php if(!empty($dato->img_delivery)){  ?>
          <img src="{{$dato->img_delivery}}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" >
            <?php } ?>
              @if(session('user')->roles=='Administrador' || session('user')->roles=='Repartidor' && $dato['status']=="Sent")
              <form class="deleteForm" action="{{route('img_completar',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$dato['id']}}">
            <input type="file" name="img_delivery" id="img_delivery" class="form-control" >
            <button type="submit" class="btn btn-primary">Subir</button>
        </form>
        @endif
            </td>
              <td>
              @if($dato['status']=="Order")  
                <p  class="order">{{ $dato['created_at'] }}</p>
        @endif
        @if($dato['status']=="Sent")  
        <p  class="sent">{{ $dato['created_at'] }}</p>
  
        @endif
        @if($dato['status']=="Completed")  
        <p  class="completed">{{ $dato['created_at'] }}</p>
        @endif
        @if($dato['status']=="repayment")  
        <p  class="repayment">{{ $dato['created_at'] }}</p>
        @endif
       
        

              </td>
              <td><a  class="btn btn-primary" href="{{route('purchaorder.edit',$dato['id'])}}">VER</a></td>
              @if(session('user')->roles=='Administrador')
              <td><a  class="btn btn-primary" href="{{route('enviarcorreodestino',$dato['id'])}}">Enviar Correo</a></td>
              @endif
              <td > 
   <form class="deleteForm" action="{{route('enviarorden',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">  
   @csrf
            @method('POST')
   <select class="form-control" id="status" name="status">
       @if($dato['status']=="Order")  
       <option value="Order" style="background-color: orange; color: orange;" class="order">{{ $dato['status'] }}</option>
        @endif
        @if($dato['status']=="Sent")  
       <option value="Sent" style="background-color: blue;color: blue;" class="sent">{{ $dato['status'] }}</option>
        @endif
        @if($dato['status']=="Completed")  
       <option value="Completed" style="background-color: green; color: green;" class="completed">{{ $dato['status'] }} </option>
        @endif
        @if($dato['status']=="repayment")  
        <option value="repayment" class="repayment"style="background-color: red; color:red;">{{ $dato['status'] }} 
      </option>
     
        @endif @if(session('user')->roles=='Administrador' && $dato['status']!="Completed" && $dato['status']!="repayment" && $dato['status']!="Sent")
        <option value="Order" style="background-color: orange; color: orange;" class="order"> Order</option>
        @endif
                                   @if(session('user')->roles=='Administrador' && $dato['status']!="Completed" && $dato['status']!="repayment")
                                    <option value="Sent">Sent</option>
                                    @endif
                              
                                </select>
       

        

        @if(session('user')->roles=='Administrador' && $dato['status']!="Completed" && $dato['status']!="repayment" && $dato['status']!="Sent")
        
     <button type="submit" class="btn btn-primary">Enviar</button>
      @endif
      </form>
      </td>  
      @if($dato['status']=="Order" || session('user')->roles=='Administrador' && $dato['status']=="Sent")

<td>
   <form class="deleteForm" action="{{route('cancelar',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
       @csrf
       @method('POST')
       <button type="submit" class="btn btn-warning">Cancelar</button>
   </form>
</td>

@endif
     @if(session('user')->roles=='Administrador' && $dato['status']!="Completed" && $dato['status']!="Sent")
      <td>
        <form class="deleteForm" action="{{route('purchaorder.destroy',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
     </td>
     @endif


     @if(session('user')->roles=='Repartidor' && $dato['status']=="Sent" || session('user')->roles=='Administrador' && $dato['status']=="Sent" )
     
     <td>
     <form class="deleteForm" action="{{route('completar',$dato['id'])}}" id_eliminar="{{$dato['id']}}"method="POST">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-primary">Completar</button>
        </form>
    </td>
     @endif

  
    
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
{{$matriz['datos']->links() }}
</div>



@endsection
