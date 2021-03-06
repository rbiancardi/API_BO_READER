@extends('layouts.main')
@section('title')
 Nuevo Producto Creado
@endsection
@section('stylesheets')


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"type="text/css"/>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"type="text/css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css"type="text/css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.jqueryui.min.css"type="text/css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"type="text/css"/>

{!!Html::style('primerBit/css/select2.min.css' ) !!}

@endsection

@section('content')
<div class="right_col" role="main">
        
    <div class="row"> 
        
        @include('layouts.partials.requestErrors')
        @include('layouts.partials.success')

    </div>{{-- Fin Row--}}

    @if(isset($product_data))
    
    <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nuevo Producto Creado</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                            A continuacion se lista la informacion del producto que el usuario  <b>{{Auth::user()->name}} {{Auth::user()->last_name}}</b> Acaba de crear.
                        </p>
                        
                       
                        <div class="table-responsive">
                            <!--   <table id="transactions" class="table table-striped table-bordered">-->
                                <table id="transactions" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                             <th nowrap>FECHA DE CREACION</th>         
                             <th nowrap>ID DE PRODUCTO</th>         
                             <th nowrap>BARCODE</th>         
                             <th nowrap>DESCRIPCION</th>
                             <th nowrap>CREADO POR</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                   
                          <tr>
                              <td>{{$product_data['created_at']}}</td>
                              <td>{{$product_data['id']}}</td>
                              <td>{{$product_data['barcode']}}</td>
                              <td>{{$product_data['description']}}</td>
                              <td>{{$product_data['user_creator']}}</td>
                          </tr>
                   
                        </tbody>
                        
                    </table>
            
                        </div> 
            
                      </div>
                    </div>
  
            <!-- Fin Row Tabla-->
            </div>
          </div>
          @endif

</div>
</div>

@endsection


@section('scripts')

{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/js/select2.min.js') !!}

<script type="text/javascript">
    $(document).ready(function() {
        $('.currency').select2();
        $('.branchs').select2();
        $('.merchants').select2();
        $('.sectors').select2();
    });
</script>




@endsection