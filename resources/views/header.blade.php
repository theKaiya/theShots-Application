<!DOCTYPE html>
<html lang="en" style="overflow: vissible;">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="theshots is a directory listing template.">
    <meta name="keywords" content="">

    <title id='title'>TheShots - @yield('title')</title>

    <!-- Styles -->
    <link href="/assets/css/app.min.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
    <link href="/assets/css/sweetalert.css" rel='stylesheet'>
    <link href="/assets/css/pace.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="/assets/img/favicon.ico">

    <script src="/assets/js/jquery.js"></script>

    <script>
      window.paceOptions = {
        document: true,
        eventLag: true,
        restartOnPushState: true,
        restartOnRequestAfter: true,
        ajax: {
          trackMethods: [ 'POST','GET']
        }
      };
    </script>

    <script src="/assets/js/sweetalert.min.js"></script>
    <script src="/assets/js/pace.min.js"></script>

    <script>
    var auth = {
      check: {{ Auth()->check() ? 1 : 0 }},
      id: {{ Auth()->check() ? u()->id : 'null' }}
    };

    var _route = "{{ Route::currentRouteName() }}";
    </script>
  </head>

  <body id='body' class="sticky-nav">

    <!-- Navigation bar -->
    <nav class="navbar">
      <div class="container">

        <!-- Logo and navigation links -->
        <div class="pull-left">
          <a class="navbar-toggle" href="{{ Route('home') }}" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo">
            <a href="{{ Route('home')  }}"><img src="/assets/img/logo.png" alt="logo"></a>
          </div>

          <ul class="nav-menu">
            <li>
              <a href="{{ Route('home')  }}">Home</a>
            </li>
            <li>
              <a href="{{ Route('shots')  }}">Shots</a>
              <ul>
                <li><a href="{{ Route('shots')  }}?act=recent">Recent</a></li>
                <li><a href="{{ Route('shots')  }}?act=popular">Popular</a></li>
                @if(u())
                  <li><a href="{{ Route('shots')  }}?act=followings">Followings</a></li>
                @endif
              </ul>
            </li>
            <li>
              <a href="{{ Route('page', 'about-us')  }}">About</a>
            </li>
            <li>
              <a href="{{ Route('page', 'terms')  }}">Terms</a>
            </li>
          </ul>
        </div>
        <!-- END Logo and navigation links -->

        <!-- User account and action buttons -->
        <div class="pull-right">

          @if(Auth()->check())
          <a class="btn-navbar search-opener" href="#"><i class="ti-search"></i></a>
          <a class="btn-navbar" href="{{ Route('shot_create')  }}"><i class="ti-plus"></i></a>

          <div class="dropdown user-account">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
              <img src="{{ u()->avatar }}" alt="avatar">
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="{{ u()->link }}">Profile</a></li>
              <li><a href="/#">Settings</a></li>
              <li><a href="/logout">Logout</a></li>
            </ul>
          </div>
          @else
          <ul class="quick-links">
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          </ul>
          @endif

        </div>
        <!-- END User account and action buttons -->

        <!-- Search screen -->
        <div class="search-screen closed">
          <button class="search-closer"><i class="ti-close"></i></button>
          <form class="search-form" action="{{ Route('search')  }}" method="GET">
            <input type="text" name="query" autocomplete="off" placeholder="Type to search..." value="{{ request()->get('query')  }}">
          </form>
        </div>
        <!-- END Search screen -->

      </div>
    </nav>
    <!-- END Navigation bar -->


    <!-- Main container -->
    <main>
      @yield('main')
    </main>
    <!-- END Main container -->


    <!-- Site footer -->
    <footer class="site-footer">

      <!-- Top section -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-5">
            <h6>About</h6>
            <p class="text-justify"><strong>TheShots</strong> is a powerful, responsive, and high-performance image listing template. It's based on Bootstrap and contains a lot of components to easily make an image listing website. This template comes with a simple yet beautiful design which focused on ease of use for users. Take a tour in the website and check our intensive <a href="http://shamsoft.net/theshots/docs" target="_blank">online documentation</a> before make a purchuse!</p>
          </div>

          <div class="col-xs-12 col-sm-4 col-md-2">
            <h6>Company</h6>
            <ul class="footer-links">
              <li><a href="page-about.html">About us</a></li>
              <li><a href="page-typography.html">How it works</a></li>
              <li><a href="page-typography.html">Terms of use</a></li>
              <li><a href="page-typography.html">Privacy policy</a></li>
              <li><a href="page-contact.html">Contact us</a></li>
            </ul>
          </div>

          <div class="col-xs-12 col-sm-4 col-md-2">
            <h6>Support</h6>
            <ul class="footer-links">
              <li><a href="page-faq.html">Help center</a></li>
              <li><a href="#">Tutorials</a></li>
              <li><a href="#">Forums</a></li>
              <li><a href="#">Official blog</a></li>
              <li><a href="#">Ask question</a></li>
            </ul>
          </div>

          <div class="col-xs-12 col-sm-4 col-md-3">
            <h6>Newsletter</h6>
            <p><strong>Subscribe</strong> to our newsletter to receive news, updates, and special offers:</p>
            <br>
            <input type="text" class="form-control" placeholder="Enter your email address">
            <button class="btn btn-primary btn-sm btn-block" type="button"><i class="fa fa-paper-plane"></i> Subscribe</button>
          </div>
        </div>

        <hr>
      </div>
      <!-- END Top section -->

      <!-- Bottom section -->
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyrights &copy; 2016 All Rights Reserved by <a href="http://themeforest.net/user/shamsoft">ShaMSofT</a>.</p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- END Bottom section -->

    </footer>
    <!-- END Site footer -->


    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->


    <!-- Shot description modal -->
    <div ng-controller="modalController">
      <div id="shot-modal" class="modal" tabindex="-1" role="dialog" closemodal>
        <div class="modal-dialog modal-lg" role="document">
          <a class="close-modal" data-dismiss="modal" href="#"><i class="ti-close"></i></a>
          <div class="modal-content">
             <div ng-if="isLoaded">
               @include('shot.modal')
             </div>

              <div ng-show='!isLoaded'>
             @include('components.spinner')
              </div>
          </div>
        </div>
      </div>

      <div ng-if='modal_open' class="modal-backdrop fade in" ng-cloak></div>
    </div>
    <!-- END Shot description modal -->


    <!-- Scripts -->

    <script src="/assets/js/app.min.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/moment.js"></script>
    <script src="/assets/js/helpers.js"></script>
    <script src="/assets/js/url.min.js"></script>
    <script src="/assets/js/angular.min.js"></script>
    <script src="/assets/js/angular-cookies.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/controllers/modalController.js"></script>
    @yield('footer')
  </body>
</html>
