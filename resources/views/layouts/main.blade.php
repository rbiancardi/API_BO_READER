<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="primerBit/images/favicon.ico" type="image/ico" />

    <title>Primer Bit | @yield('title')</title>

   @include('layouts.partials.styles')
   @yield('stylesheets')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('dashboard')}}" class="site_title"><img src="{{asset('primerBit/img/logo_t.jpg')}}" alt="Siempre es Mejor ser el Primero" 
                height="34" width="34"></i> <span>Barcode Reader</span></a>
            </div>

           

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}} {{Auth::user()->last_name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
         
            @include('layouts.menu.adminMenu')

            <!-- /sidebar menu -->
            
          </div>
        </div> 

        <!-- top navigation -->
        
        @include('layouts.menu.topMenu')

        <!-- /top navigation -->

        <!-- page content -->
       @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        @include('layouts.partials.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    @include('layouts.partials.scripts')
	@yield('scripts')
  </body>
</html>
