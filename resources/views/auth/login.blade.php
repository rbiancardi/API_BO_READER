<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Primer Bit - Barcode Reader Backoffice</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="primerBit/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        
        <div class="login-container">
            
             <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                   
                    <div class="login-title"><strong>Bienvenido</strong>, Por Favor Ingresa tus datos</div>
                    <form method="POST" class="form-horizontal" action="{{ route('login') }} "> 
                    

                      <div class="form-group">
                        <div class="col-md-12"> 
                            <label class="login-footer">Direccion de Correo</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Ingrese su Email" required autofocus>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="login-footer">Contraseña</label>
                           
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Ingrese su Contraseña" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                        </div>
                    </div>

                    <div class="row">

                            <div class="form-group">
                                    <div class="col-md-6">
                                          <label class="login-footer">
                                                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                              </label>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="pull-right">
                                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                                          {{ __('Forgot Your Password?') }}</a>
                                              </label>
                                              {{ csrf_field() }}
                                        </div></div>
                         </div>
                         <div class="col-12">
                            <button type="submit" class="btn btn-info btn-block">
                                    {{ __('Login') }}
                            </button>
                        </div>
        
                         </form>
                 </div> 
                   
              
                <div class="login-footer">
                    <div class="pull-left">
                        {{env('APP_NAME','Primer Bit Backoffice')}}   - &copy; <?php echo date("Y") ?> 
                    </div>
                    <div class="pull-right">
                        <a href="http://primerbit.com/" target="_blank">Contactenos</a> <!--|
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>-->
                    </div>
                </div>
            </div>
        </div>
       
    </body>
</html>
