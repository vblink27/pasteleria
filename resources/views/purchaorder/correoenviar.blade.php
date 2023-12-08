<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA DE CONFIRMACION</title>
</head>
<body>
    <center>
<div class="container">

        <h1>FACTURA DE CONFIRMACION REVISA LA FACTURA EN LA PAGINA </h1>
          <h2>Nombre de cliente:{{ $dato->cliente['nombre_apellido'] }}</h2>
        
     
           <h3>${{ $dato['pricetotal'] }}</h3>
            <h3>Sweet and Donuts</h3>
 
   <div class="container" >
            <h3> Fecha </h3>
            <h3><strong> {{ $dato['created_at'] }} </strong></h3>
            <h3><strong>Estado:</strong>  @if($dato['status']=="Order")  
                TU PEDIDO ESTA RECIEN CREADO, ESTA PENDIENTE A REVISION.
          @endif
          @if($dato['status']=="Sent")  
        TU PEDIDO VA EN CAMINO, YA FUE ENVIADO
  
        @endif
        @if($dato['status']=="Completed")  
       TU PEDIDO FUE ENTREGADO
        @endif
        @if($dato['status']=="repayment")  
      TU PEDIDIO ESTA CANCELADO
        @endif</h3>

            <div class="container">
                       <h3>Repartidor:</h3>
                        <h3>  <strong>{{$dato->repartido['nombre_apellido']}}</strong></h3>
                        <h3>{{ $dato->repartido['address'] }}</h3>
                        <h3>Email: {{ $dato->repartido['correo'] }}</h3>
                        <h3>Phone: {{ $dato->repartido['phones'] }}</h3>
        
                        <h3 >Cliente:</h3>
                        <h3> <strong>{{$dato->cliente['nombre_apellido']}}</strong></h3>
                        </h3>{{ $dato->cliente['address'] }}</h3>
                        <h3>Email: {{ $dato->cliente['correo'] }}</h3>
                        <h3>Phone: {{ $dato->cliente['phones'] }}</h3>
             </div>

                <div class="container">
            
                     <h2><strong>Precio Unitario</strong></h2>  
                             
                     <h3>${{ $dato->Trolley->product->price }}</h3>  
                               
                               
                                <strong>x{{ $dato['units'] }}</strong><br>
                                  
                                 @php
                              
                                $iva = 0.12; // IVA del 12%
                                $precioSinIva = $dato->Trolley->product->price *$dato['units'];
                                $ivacobrar= ($precioSinIva * $iva);
                                $precioConIva = $precioSinIva + ($precioSinIva * $iva);
                                @endphp
                                ${{$precioSinIva}}
                                IVA (12%)
                                ${{$ivacobrar}}
                                <h3> <strong>Total</strong></h3>
                                <h3>  <strong>${{$precioConIva}}</strong><h3>
                                    
                            
                </div>  

                    
    </div>
</div>

</center>
</body>
</html>