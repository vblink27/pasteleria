<html>
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../img/SWEET-DONUTS.png" rel="icon">
  <link href="../../img/donuuts.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="ruta-a/font-awesome/css/all.min.css">
 
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  
</head>

    <body>
    <style>
    /* Estilos para el icono del carrito */
    .cart-icon {
      position: relative;
      display: inline-block;
      font-size: 24px; /* Tamaño del icono */
    }

    .cart-count {
      position: absolute;
      top: -8px; /* Ajusta la posición vertical según tu diseño */
      right: -8px; /* Ajusta la posición horizontal según tu diseño */
      background-color: red; /* Color del fondo del número de pedidos */
      color: white; /* Color del texto del número de pedidos */
      border-radius: 50%; /* Para hacer un círculo alrededor del número */
      padding: 4px 8px; /* Ajusta el espaciado según tu diseño */
    }
  </style>


 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 style="font-family:'Time Rome'">Sweet and Donuts<span>.</span></h1>
      </a>

    <nav id="navbar" class="navbar">
        <ul>
        <li>
        <?php  echo session('trolleryCount');?>
        <a href="{{route('trolley.index')}}"> <img src="../../img/cart.svg" alt=""> </a>
        </li>
          <li><a href="{{route('home')}}">HOME</a></li>
          <?php if(!empty( session('user'))) {?>
          <li><a href="{{route('dashboard')}}">PROFILE</a></li>
          <li><a href="{{route('salir')}}">GET OUT</a></li>
          <?php } else{  ?>
          <li><a href="{{route('login')}}">LOGIN</a></li>
          <li><a href="{{route('register')}}">REGISTER</a></li>
          <?php }  ?>
          
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->



<style>
      .scrollable-div {
  max-height: 700px; /* Establece la altura máxima deseada */
  overflow-y: auto; /* Habilita la barra de desplazamiento vertical */
}
.logo_banner{
  width: 100px;
  height: 100px;
}

.btn_comprar{
  width:30%;
}
.witimg{
  width:200px;
  height: 200px;
}
.w-5{
    display:none;
}



</style>
  </section><!-- End Stats Counter Section -->


          
            @yield('content')
       




    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>Aprenda más acerca <span>de nosotros</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(img/doonas.jpg) ;" data-aos="fade-up" data-aos-delay="150">
          <div class="call-us position-absolute">
          <br><br>
              <h4>Llamanos</h4>
              <p>+593-986288962</p>
            </div>
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
             <strong> Sweet and Donuts: El Rincón Más Dulce de Esmeraldas</strong>
              </p>
             
              <p>
              ¡Bienvenidos a Sweet and Donuts, la pastelería que ha conquistado el corazón de la ciudad de Esmeraldas! En nuestro acogedor rincón, te esperan los pasteles y donuts más deliciosos de la provincia. Sumérgete en una experiencia de sabor única y descubre por qué somos el lugar favorito de los amantes del dulce en Esmeraldas.
              </p>

              <div class="position-relative mt-4">
                <img src="img/pasteel.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=nXn4k9VdvWk" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


 

 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">

<div class="container">
  <div class="row gy-3">
    <div class="col-lg-3 col-md-6 d-flex">
      <i class="bi bi-geo-alt icon"></i>
      <div>
        <h4>Dirección</h4>
        <p>
        Colon entre Piedrahita y 9 de octubre<br>
        </p>
      </div>

    </div>

    <div class="col-lg-3 col-md-6 footer-links d-flex">
      <i class="bi bi-telephone icon"></i>
      <div>
        <h4>Reservas</h4>
        <p>
          <strong>Phone:</strong> +593-0986288962<br>
          <strong>Email:</strong> info@example.com<br>
        </p>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 footer-links d-flex">
      <i class="bi bi-clock icon"></i>
      <div>
        <h4>Horario de apertura</h4>
        <p>
          <strong>Lun-Vie: 10:00.AM</strong> - 20:00PM<br>
          <strong>Sab: 10:30.AM</strong> - 17:30.PM<br>
          <strong>Dom: 9:00.AM</strong> - 14:00PM<br>
        </p>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 footer-links">
      <h4>Follow Us</h4>
      <div class="social-links d-flex">
          <!--  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <!--  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>-->
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <!--  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>-->
      </div>
    </div>

  </div>
</div>



</footer><!-- End Footer -->
<!-- End Footer -->



<!-- Vendor JS Files -->
<script src="{{ asset('../../../vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('../../../vendor/aos/aos.js ') }}"></script>
<script src="{{ asset('../../../vendor/glightbox/js/glightbox.min.js ') }}"></script>
<script src="{{ asset('../../../vendor/purecounter/purecounter_vanilla.js ') }}"></script>
<script src="{{ asset('../../../vendor/swiper/swiper-bundle.min.js ') }}"></script>
<script src="{{ asset('../../../vendor/php-email-form/validate.js ') }}"></script>

<script src="../../../js/main.js"></script>

      <script src="{{ asset('../../../js/jquery.min.js')}}"></script>
    
    <script src="{{ asset('../../../js/index.js')}}"></script>

<!-- Template Main JS File -->

    <!-- JAVASCRIPT FILES -->
   <!-- <script src="{{ asset('js/jquery.min.js')}}"></script>-->
   
            <script>
            function confirmDelete(event) {
          /*  event.preventDefault();

            if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {

            document.getElementById(this).submit();
            }*/
            }
            </script>

<script>
    function imprimirDiv() {
       var contenidoDiv = document.getElementById("reportid").innerHTML;
       var ventanaImpresion = window.open('', '', 'width=800,height=600');
        ventanaImpresion.document.write('<html><head><title>Imprimir Div</title></head><body>');
      ventanaImpresion.document.write(contenidoDiv);
       ventanaImpresion.document.write('</body></html>');
       ventanaImpresion.document.close();
       ventanaImpresion.print();
     }
     /*
     Eliminar();
     function Eliminar() {
        $(document).on('submit', '.deleteForm', function(event) {
            event.preventDefault();
            let id = $(this).attr('id_eliminar'); // Encerrar el nombre del atributo en comillas

            if (confirm('¿Estás seguro de que deseas eliminar este elemento? id->' + id)) {
                this.submit();// Utilizar jQuery para enviar el formulario
            }
        });
    }
    */
  </script>

  
    </body>
</html>
