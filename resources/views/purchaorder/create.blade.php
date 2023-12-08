<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'AÑADIR PEDIDO')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
    <br><br><br><br>
    <center>
        <h1>AÑADIR PEDIDO</h1>
        <h2>Cuenta de banco,Pichincha,Corriente: 22xxxxxx</h2>
        <h3>Pasteleria Sweet and Donuts</h3>
        <img class="logo_banner" src="../../img/icono.jpg" alt="Image 2">
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

                        <form method="POST" action="{{route('purchaorder.store')}}"enctype="multipart/form-data">
                            @csrf
                          
                          
                                @php
                                $precioOriginal = $matriz['datos']['Product']->price;
                                $stockOriginal = $matriz['datos']['Product']->stock;
                                $iva = 0.12; // IVA del 12%
                                $precioConIva = $precioOriginal + ($precioOriginal * $iva);
                                @endphp
                               <p id="disponibles" valosapagar="{{ $stockOriginal }}"></p>
                                Valor original: ${{ $precioOriginal }}/
                              <br>  IVA del 12%: $<p id="precioiva" valosapagar="{{ $precioOriginal * $iva }}">{{ $precioOriginal * $iva }}</p>/
                            Valor total a pagar: $ <p id="preciotal" valosapagar="{{ $precioConIva }}"> {{ $precioConIva }}</p>
              

                            <div class="form-group">
                                <label for="status">Estado de la Order:</label>
                                <select class="form-control" id="status" name="status">
                                   
                                    <option value="Order">Order</option>
                                    @if(session('user')->roles=='Administrador' )
                                    <option value="Sent">Sent</option>
                                    <option value="Completed">Completed</option>
                                    <option value="repayment">repayment</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="address">Direccion de Entrga</label>
                                <input type="text" id="address" name="address" class="form-control" required>
                            </div>
                            <div class="form-group">
                            <label for="units">Unidades</label>
                            <input type="number" name="units" id="units" class="form-control" >
                             </div>

                       
                            <div class="form-group">
                                <label for="id_personals_conductor">Selecciona Repartidor:</label>
                                <select class="form-control" id="id_repartidor" name="id_repartidor">
                                    @foreach($matriz['repartidor'] as $dato)
                                    <option value="{{ $dato->id }}">{{ $dato->nombre_apellido}}</option>
                                    @endforeach
                                </select>
                            </div>
                         
                         
                            <div class="form-group">
                            <label for="img_pago">Imagen del Pago</label>
                              <input type="file" name="img_pago" id="img_pago" class="form-control" value=""required>
                          </div>

                         </div>

                         <div class="form-group">
                               
                                <input type="hidden" name="pricetotal" id="pricetotal" class="form-control" value="{{ $precioConIva }}"  required autofocus>
                            </div>
                            <?php  $user = session('user') ?>
                            <div class="form-group">
    
                                <input type="hidden" id="id_cliente" name="id_cliente"class="form-control"  value="<?php echo $user->__get('id');?>" required>
                            </div>

                            <div class="form-group">
                               
                                <input type="hidden" id="id_trolley" name="id_trolley"class="form-control"  value="{{$matriz['datos']->id}}"  required>
                            </div>
                        
                         <div class="form-group">

                            <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo $user->__get('id');?>"required style="display: none;"readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </form>

             
                        <script>
    // Obtener el elemento de entrada y el elemento donde se mostrará el valor total
    var unitsInput = document.getElementById("units");
    var precioTotalElement = document.getElementById("preciotal");
    var pricetotalElement = document.getElementById("pricetotal");
    var precioivalElement = document.getElementById("precioiva");
    var stickvalElement = document.getElementById("disponibles");

    // Obtener el valor original y el IVA del elemento de datos PHP
    var precioOriginal = parseFloat("{{ $precioOriginal }}");
    var stockOriginal = parseFloat("{{ $stockOriginal }}");
    var iva = 0.12;

    // Función para actualizar el valor total
    function actualizarValorTotal() {
        // Obtener el número de unidades del campo de entrada
        var unidades = parseFloat(unitsInput.value) || 0;
if( unidades>stockOriginal){
    stickvalElement.innerHTML='<h2 style="color:red">PRODUCTO LIMITADO</h2>';
    unitsInput.value=stockOriginal;
}else{
  // Calcular el valor total
  var valorTotal = (precioOriginal + (precioOriginal * iva)) * unidades;
        precioivalElement.innerHTML = (precioOriginal * iva)* unidades;
        // Actualizar el valor en el elemento HTML
        precioTotalElement.innerHTML = valorTotal.toFixed(2);
        stickvalElement.innerHTML='<h2 style="color:red"></h2>';
        pricetotalElement.value=valorTotal;
}
if(unidades<0){
    stickvalElement.innerHTML='<h2 style="color:red">Ninguna Unidad</h2>';
    unitsInput.value=0;

}
      
    }

    // Escuchar cambios en el campo de entrada
    unitsInput.addEventListener("input", actualizarValorTotal);

    // Llamar a la función inicialmente para establecer el valor inicial
    actualizarValorTotal();
</script>

                        <a href="{{route('purchaorder.index')}}" class="btn btn-defaul">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
