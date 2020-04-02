<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">    
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="{{URL::asset('imglogo/logoClinica.png')}}"/>
  <title>Pelos & Patas|Clinica Veterinária</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicon -->
  <link href=" {{ asset('bell/img/favicon.ico') }}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ asset('bell/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{ asset('bell/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href=" {{ asset('bell/css/style.css') }}" rel="stylesheet">


  <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

  <!-- =======================================================
    Theme Name: Bell
    Theme URL: https://bootstrapmade.com/bell-free-bootstrap-4-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <style type="text/css">
    .responsive {
      width: 100%;
      max-width: 400px;
      height: auto;
    }

  </style>
  <!-- Page Content
    ================================================== -->
  <!-- Hero -->

  <section class="hero ">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          
        </div>
      </div>

      <div class="col-md-12">
        <h1>
            Pelos & Patas
          </h1>

        <p class="tagline">
          Clinica Veterinária
        </p>
        <a class="btn btn-full" href="#about">Inicio</a>
      </div>
    </div>

  </section>
  <!-- /Hero -->

  <!-- Header -->
  <header id="header">
    <div class="container">

      <div id="" class="pull-left">

        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Bell</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
              <li class="list-inline-item">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    @else
                        <a class="nav-link js-scroll-trigger" href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
                        
                    @endauth
                </div>
                @endif
              </li>
          <li><a href="#about">Sobre nós</a></li>
          <li><a href="#features">Recursos</a></li>
          <!--
          <li><a href="#portfolio">Portfólio</a></li>
          <li><a href="#team">Equipe</a></li>
        -->
          <li><a href="#contact">Contate-Nos</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#contact"><i class="fa fa-envelope"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->

  <!-- About -->

  <section class="about" id="about">
    <div class="container text-center">
      <h2>
          Sobre Pelos & Patas
        </h2>

      <p>
       A clínica veterinária Pelos & Patas oferece os melhores serviços para cuidar do seu pet. É fundamental uma visita regular para manter a saúde do seu amigo.
      </p>

      <div class="row stats-row">
        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">1,053</span> Clientes satisfeitos
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">247</span> Emergências
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">10,463</span> Horas de Suporte
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">20</span> Trabalhadores
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /About -->
  <!-- Parallax -->

  <div class="block bg-primary block-pd-lg block-bg-overlay text-center" data-bg-img="{{asset('bell/img/parallax-bg.jpg')}}" data-settings='{"stellar-background-ratio": 0.6}' data-toggle="parallax-bg">
    <h2>
       <!-- Welcome to a perfect theme-->
      </h2>

    <p>
      <!--This is the most powerful theme with thousands of options that you have never seen before.-->
    </p>
    <img alt="Bell - A perfect theme" class="gadgets-img hidden-md-down responsive" src=" {{ asset('imglogo/pp.jpg') }}">
  </div>
  <!-- /Parallax -->
  <!-- Features -->

  <section class="features" id="features">
    <div class="container">
      <h2 class="text-center">
          Recursos
        </h2>

      <div class="row">
        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-ambulance"></span>
              </div>
            </div>

            <div>
              <h3>
                  Emergências
                </h3>

              <p>
                Garantimos assistência em todos casos de emergência.
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-stethoscope"></span>
              </div>
            </div>

            <div>
              <h3>
                  Exames
                </h3>

              <p>
                Realizamos vários tipos de exames..
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-bell"></span>
              </div>
            </div>

            <div>
              <h3>
                  Alertas
                </h3>

              <p>
                Estamos atentos e aptos a informá-lo sobre a saúde de seu amigo.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-bath"></span>
              </div>
            </div>

            <div>
              <h3>
                  Banhos
                </h3>

              <p>
                Realizamos todos tipo de banho.
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-cutlery"></span>
              </div>
            </div>

            <div>
              <h3>
                  Alimentos
                </h3>

              <p>
                Temos disponível uma vasta gama de alimentos. Ração..
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fa fa-bed"></span>
              </div>
            </div>

            <div>
              <h3>
                  Internamento
                </h3>

              <p>
                Temos condições adequadas para internação.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Features -->

  <!-- Portfolio -->
<!--
  <section class="portfolio" id="portfolio">
    <div class="container text-center">
      <h2>
          Portfólio
        </h2>

      <p>
       Voluptua scripserit per ad, laudem viderer sit ex. Ex alia corrumpit voluptatibus usu, sed unum convenire id. Ut cum nisl moderatius, Per nihil dicant commodo an.
      </p>
    </div>

    <div class="portfolio-grid">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-1.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-2.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-3.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-4.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-5.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-6.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-7.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="{{asset('bell/img/porf-8.jpg')}}">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>
      </div>
    </div>
  </section>
-->
  <!-- /Portfolio -->
  <!-- Team -->
<!--
  <section class="team" id="team">
    <div class="container">
      <h2 class="text-center">
          Meet our team
        </h2>

      <div class="row">
        <div class="col-sm-3 col-xs-6">
          <div class="card card-block">
            <a href="#"><img alt="" class="team-img" src="{{asset('bell/img/team-1.jpg')}}">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
            </nav>

            <p>
              Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
            </p>
          </div>
          </a>
        </div>
      </div>

      <div class="col-sm-3 col-xs-6">
        <div class="card card-block">
          <a href="#"><img alt="" class="team-img" src="{{asset('bell/img/team-2.jpg')}}">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
          </nav>

          <p>
            Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
          </p>
        </div>
        </a>
      </div>
    </div>

    <div class="col-sm-3 col-xs-6">
      <div class="card card-block">
        <a href="#"><img alt="" class="team-img" src="{{asset('bell/img/team-3.jpg')}}">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
        </nav>

        <p>
          Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
        </p>
      </div>
      </a>
    </div>
    </div>

    <div class="col-sm-3 col-xs-6">
      <div class="card card-block">
        <a href="#"><img alt="" class="team-img" src="{{asset('bell/img/team-4.jpg')}}">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
        </nav>

        <p>
          Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
        </p>
      </div>
      </a>
    </div>
    </div>
    </div>
    </div>
  </section>
-->
  <!-- /Team -->

  <!-- component: footer -->

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-title">Contate-Nos</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-4">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Bairro do Zimpeto<br>Av. de Moçambique, Maputo - Moçambique</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>pelosepatas@gmail.com<br>
              info@pataspelos.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+258 84 150 003 1<br>+258 82 150 003 1</p>
            </div>

          </div>
        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <div id="sendmessage">A sua messagem foi enviada com sucesso. Obrigado!</div>
            <div id="errormessage"></div>
            <form class="contactForm"  role="form" method="POST" id="contactForm"  enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome" data-rule="minlen:3" data-msg="Por favor itroduza 3 caracteres no minimo!!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" name="cell" id="cell" placeholder="Seu Contacto" data-rule="minlen:9"  data-msg="Por favor introduza telefone valido (Ex: 84111111)!!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email" data-rule="email" data-msg="Por favor introduza email valido!!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:8" data-msg="Por favor o seu assuntpo deve conter pelo menos 8 caracteres!!" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor escreva algo para nóS!! " placeholder="Messagem"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="bottom">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-xs-12 text-lg-left text-center">
            <p class="copyright-text">
              © Evidevi
            </p>
            <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bell
              -->
             Designed by <a href="malito:Nhacudimaemidio@gmail.com">Emidio Nhacudima</a> 
              <div>
              
              <p><i class="fa fa-phone"></i> +258 84 079 320 5<br><i class="fa fa-phone"></i> +258 87 344 058 6</p>
            </div>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12 text-lg-right text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    @else
                        <a class="nav-link js-scroll-trigger" href="{{ route('login') }}"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
                        
                    @endauth
                </div>
                @endif
              </li>

              <li class="list-inline-item">
                <a href="#about">Sobre nós</a>
              </li>

              <li class="list-inline-item">
                <a href="#features">Recursos</a>
              </li>
              <!--
              <li class="list-inline-item">
                <a href="#portfolio">Portfólio</a>
              </li>

              <li class="list-inline-item">
                <a href="#team">Equipe</a>
              </li>
              -->
              <li class="list-inline-item">
                <a href="#contact">Contate-Nos</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </footer>
  <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>


  <!-- Required JavaScript Libraries -->
  <script src="{{asset('bell/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{asset('bell/lib/jquery/jquery-migrate.min.js') }}"></script>
  <script src="{{asset('bell/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{asset('bell/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{asset('bell/lib/tether/js/tether.min.js')}}"></script>
  <script src="{{asset('bell/lib/stellar/stellar.min.js')}}"></script>
  <script src="{{asset('bell/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('bell/lib/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('bell/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('bell/lib/easing/easing.js')}}"></script>
  <script src="{{asset('bell/lib/stickyjs/sticky.js')}}"></script>
  <script src="{{asset('bell/lib/parallax/parallax.js')}}"></script>
  <script src="{{asset('bell/lib/lockfixed/lockfixed.min.js')}}"></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="{{asset('bell/js/custom.js')}}"></script>

  <script src="{{asset('bell/contactform/contactform.js')}}"></script>

</body>
</html>
