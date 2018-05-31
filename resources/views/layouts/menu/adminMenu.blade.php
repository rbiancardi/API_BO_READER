<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Rol del Usuario: {{ Auth::user()->roles->role_name }}</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-home"></i> Principal <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-exchange"></i> Transacciones <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Buscar Transacciones Por Fecha</a></li>
          <li><a href="#">Buscar Transaccion Por Codigo de Barra</a></li>
          <li><a href="#">Buscar Transacicon Por Lector y Sucursal</a></li>
          {{-- <li><a href="#">Busqueda de Transacciones Personalizada</a></li> --}}
        </ul>
      </li>
      <li><a><i class="fa fa-product-hunt"></i> Productos <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dashboard Productos</a></li>
          <li><a href="#">Alta de Productos</a></li>
          <li><a href="#">Modificar Productos</a></li>
          <!--<li><a href="{{--route('ListProducts')--}}">Modificar Productos</a></li> -->
          <li><a href="#">Eliminar Productos</a></li>
          <li><a href="#">Buscar un Producto</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-barcode"></i> Lectores <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de Alta un Lector</a></li>
          <li><a href="#">Editar un Lector</a></li>
          <li><a href="#">Elimianr un Lector</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-building-o"></i> Sucursales <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de Alta una Sucursal</a></li>
          <li><a href="#">Editar una Sucursal</a></li>
          <li><a href="#">Eliminar una Sucursal</a></li>
          <li><a href="#">Crear un sector</a></li>
          <li><a href="#">Editar un sector</a></li>
          <li><a href="#">Eliminar un sector</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Crear un Usuario</a></li>
          <li><a href="#">Editar un Usuario</a></li>
          <li><a href="#">Eliminar un Usuario</a></li>
          <li><a href="#">Buscar un Usuario</a></li>
          <li><a href="#">Listar Usuarios</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-cogs"></i>Configurar Publicidades <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de alta una Publicidad</a></li>
          <li><a href="#">Editar una Publicidad</a></li>
          <li><a href="#">Eliminar una Publicidad</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-cogs"></i>Menu Primer Bit <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de alta un Comercio</a></li>
          <li><a href="#">Editar un Comercio</a></li>
          <li><a href="#">Eliminar un Comercio</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
