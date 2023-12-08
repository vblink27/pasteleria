<!-- DESPLEGANDO TODA LA PLATILLA REALIZADA--->
@extends('layouts.app')

<!-- DESPLEGANDO EL TITULO DE ESTA PAGINA-->
@section('title', 'HOME')

<!-- DESPLEGANDO TODO EL CONTENIDO DE ESTA PAGINA--->
@section('content')

<!-- ======= Hero Section ======= -->

<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">¡Descubre el Sabor de Esmeraldas <br>en Cada Bocado!</h2>
          <p data-aos="fade-up" data-aos-delay="100">Bienvenido a la página web de Delicias Esmeraldas, tu destino virtual para deleitarte con los pasteles y postres más exquisitos de la provincia de Esmeraldas. ¿Estás listo para un viaje de sabor inigualable? ¡No busques más!</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            
            <a href="https://www.youtube.com/watch?v=yKoI1ZBS4Ss" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="../../img/pastekes.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

<div class="containe  page_style">

<center>



    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nuestra Menu</h2>
          <p>Consulta nuestro <span>delicioso menú</span></p>
        

        <form method="POST"  action="{{route('buscarproductohome')}}" >
    @csrf
    <div class="form-group">

        <input type="text" name="filtro_nombre" placeholder="Nombre" class="form-control" >

        <p>Categorias</p>
           <div class="form-group">
                            <h2 for="filtro_nombre2">Selecciona una Categoria:</h2>
                            <br><br>
                            <select name="filtro_nombre2" id="filtro_nombre2" class="form-control">
                            <option value="">Selecciona..... </option>
                            <option value="Pastel Tradicional"> Pastel Tradicional</option>
                            <option value="Pastel"> Pastel</option>
                            <option value="Postres"> Postres</option>
                            <option value="Copas Heladas"> Copas Heladas</option>
                            <option value="Cupcakes"> Cupcakes</option>
                            <option value="Donas"> Donas</option>
                            <option value="Dulces de Mesa"> Dulces de Mesa</option>
                            <option value="Promociones"> Promociones</option>
                            </select>
                            </div>
    </div>
    </div>
    <!-- Agrega más campos de filtro según tus necesidades -->
    <button type="submit" class="btn btn-info">Buscar</button>
    <br><br>
</form>
        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">

            <div class="row gy-5">
            @foreach($datos as $dato)
    
              <div class="col-lg-4 menu-item">
                <a href=" {{$dato['imgproduct']}}" class="glightbox"><img src="{{$dato['imgproduct']}}" class="menu-img img-fluid " alt=""></a>
                <h4>{{ $dato['nameproduct'] }}</h4>
                <p class="ingredients">
                {{ $dato['description'] }}
                </p>
                <p class="price">
                  ${{ $dato['price'] }}
                </p>
                <a href=" {{ route('showprt', ['id' => $dato['id']]) }}" class="btn btn-primary btn_comprar" >COMPRAR</a>
              </div><!-- Menu Item -->
          
              @endforeach
            
            

             
            

           
          </div><!-- End Starter Menu Content -->

       
          </div><!-- End Breakfast Menu Content -->


        </div>

      </div>
    </section><!-- End Menu Section -->

</center>

</div>
{{ $datos->links() }}
  
   
@endsection
