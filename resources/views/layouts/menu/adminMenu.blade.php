<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Rol del Usuario: {{ Auth::user()->roles->role_name }}</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-home"></i> Principal <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('dashboard')}}">Dashboard</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-exchange"></i> Transacciones <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('transactions')}}">Buscar Transacciones Por Fecha</a></li>
          <li><a href="{{route('trxId')}}">Buscar Transaccion Por Codigo de Barra o ID</a></li>
          <li><a href="{{route('searchTrxReaderBranch')}}">Buscar Transacicon Por Lector y Sucursal</a></li>
          <li><a href="{{route('customSearch')}}">Busqueda de Transacciones Personalizada</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-product-hunt"></i> Productos <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('products')}}">Listado de Productos</a></li>
          <li><a href="{{route('newProd')}}">Alta de Productos</a></li>
          <li><a href="{{route('editProducts')}}">Modificar Productos</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-barcode"></i> Lectores <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('readers')}}">Listar Verificadores</a></li>
          <li><a href="{{route('newVDP')}}">Dar de Alta un Lector</a></li>
          <li><a href="{{route('editReaders')}}">Modificar Lectores</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-building-o"></i> Sucursales <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('branchs')}}">Listar Sucursales</a></li>
          <li><a href="{{route('newBranch')}}">Dar de Alta una Sucursal</a></li>
          <li><a href="{{route('editBranchs')}}">Editar una Sucursal</a></li>
             <li><a><i class="fas fa-industry"></i> Sectores <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                  <li><a href="{{route('sectors')}}">Listar sectores</a></li>
                  <li><a href="{{route('newSector')}}">Crear un sector</a></li>
                  <li><a href="{{route('editSector')}}">Editar un sector</a></li>
              </ul>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Crear un Usuario</a></li>
          <li><a href="#">Editar un Usuario</a></li>
          <li><a href="#">Buscar un Usuario</a></li>
          <li><a href="#">Listar Usuarios</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-cogs"></i>Configurar Publicidades <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de alta una Publicidad</a></li>
          <li><a href="#">Editar una Publicidad</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-cogs"></i>Menu Primer Bit <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="#">Dar de alta un Comercio</a></li>
          <li><a href="#">Editar un Comercio</a></li>
          <li><a href="#">Dar de alta un Merchant</a></li>
          <li><a href="#">Editar un Merchant</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
