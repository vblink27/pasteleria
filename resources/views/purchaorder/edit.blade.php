


<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'FACTURA')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')
<div class="containe  page_style">
<br><br><br><br>
<center>
<h1>FACTURA</h1>
<img class="logo_banner"src="../../img/icono.jpg" alt="Image 2">
</center>
<button onclick="imprimirPagina()"  class="btn btn-success">Imprimir</button>

<script>
    function imprimirPagina() {
        window.print();
    }
</script>


<div class="container "id="reportid">
<div class="panel invoice-list">
    <div class="list-group animate__animated animate__fadeInLeft">
      <a href="#" class="list-group-item list-group-item-action active">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">Nombre de cliente:{{ $dato->cliente['nombre_apellido'] }}</h5>
          <small>{{ $dato['created_at'] }}</small>
        </div>
        <p class="amount mb-0">${{ $dato['pricetotal'] }}</p>
        <div>Sweet and Donuts</div>
      </a>
     
    </div>
</div>

<div class="main" >
    <div class="container mt-3">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                Fecha
                <strong>{{ $dato['created_at'] }}</strong>
                <span class="float-right"> <strong>Estado:</strong>   @if($dato['status']=="Order")  
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
        @endif
        </span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">Repartidor:</h6>
                        <div> <td> <img src="../../{{ $dato->repartido['imgprofile'] }}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td></div>
                        <div>
                            <strong>{{$dato->repartido['nombre_apellido']}}</strong>
                        </div>
                        
                        <div>{{ $dato->repartido['address'] }}</div>
                        <div>Email: {{ $dato->repartido['correo'] }}</div>
                        <div>Phone: {{ $dato->repartido['phones'] }}</div>
                    </div>

                    <div class="col-6 col-md-6">
                        <h6 class="mb-2">Cliente:</h6>
                        <div> <td> <img src="../../{{ $dato->cliente['imgprofile'] }}" alt="avatar"
              class="rounded-circle img-fluid  logo_banner" ></td></div>
                        <div>
                            <strong>{{$dato->cliente['nombre_apellido']}}</strong>
                        </div>
                        
                        <div>{{ $dato->cliente['address'] }}</div>
                        <div>Email: {{ $dato->cliente['correo'] }}</div>
                        <div>Phone: {{ $dato->cliente['phones'] }}</div>
                    </div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th scope="col" width="2%" class="center">#</th>
                                <th scope="col" width="20%">Producto/Servicio</th>
                                <th scope="col" class="d-none d-sm-table-cell" width="50%">Descripción</th>

                                <th scope="col" width="10%" class="text-right">P. Unidad</th>
                                <th scope="col" width="8%" class="text-right">Num.</th>
                                <th scope="col" width="10%" class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">1</td>
                                <td class="item_name">{{ $dato->Trolley->product->nameproduct }}</td>
                                <td class="item_desc d-none d-sm-table-cell">{{ $dato->Trolley->product->description }}</td>

                                <td class="text-right">{{ $dato['units'] }}</td>
                                <td class="text-right">{{ $dato->Trolley->product->price }}</td>
                                <td class="text-right">${{ $dato['pricetotal'] }}</td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-sm table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Precio Unitario</strong>
                                    </td>
                                    <td class="text-right bg-light">${{ $dato->Trolley->product->price }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>x{{ $dato['units'] }}</strong>
                                    </td>
                                    <td class="text-right bg-light">  @php
                              
                                $iva = 0.12; // IVA del 12%
                                $precioSinIva = $dato->Trolley->product->price *$dato['units'];
                                $ivacobrar= ($precioSinIva * $iva);
                                $precioConIva = $precioSinIva + ($precioSinIva * $iva);
                                @endphp
                            ${{$precioSinIva}}
                            </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>IVA (12%)</strong>
                                    </td>
                                    <td class="text-right bg-light"> ${{$ivacobrar}}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right bg-light">
                                        <strong>${{$precioConIva}}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="footer container-fluid mt-3 bg-light">
    <div class="row">
        <div class="col footer-app">&copy; Todos los derechos reservados · <span class="brand-name"></span></div>
    </div>
</div>
</div>


@endsection
