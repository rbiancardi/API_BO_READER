@extends('layouts.main')
@section('title')
Lista de Sectores
@endsection
@section('stylesheets')
{!!Html::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css' ) !!}
{!!Html::style('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' ) !!}
{!!Html::style('https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/buttons/1.5.1/css/buttons.jqueryui.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap.min.css' ) !!}
{{-- CDN Morris.js--}}
{!!Html::style('//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css') !!}


@endsection
@section('content')
<div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">

    </div>

          <div class="row">
            @include('layouts.partials.requestErrors')
            @include('layouts.partials.success')
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Listado de los Sectores que se encuentran disponibles y habilitados </h2>
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
                       Sectores pertenecientes a todos los merchant_id que se encuentren habilitados en nuestra plataforma
                        para el usuario <b>{{Auth::user()->name}} {{Auth::user()->last_name}}</b>.
                      </p>
                      <p>
                          <h4>Exportar Todos los Sectores</h4>
                      </p>
          
                   <div class="table-responsive">
                  <!--   <table id="transactions" class="table table-striped table-bordered">-->
                     <table id="sectors" class="display nowrap" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                            <th nowrap>ID</th>
                            <th nowrap>NOMBRE</th>
                            <th nowrap>DESCRIPCION</th>
                            <th nowrap>FECHA DE CREACION</th>
                            <th nowrap>CREADO POR</th>
                            <th nowrap>ULTIMA ACTUALIZACION</th>
                            <th nowrap>ACTUALIZADO POR</th>
                          </tr>
                      </thead>
                      <tbody>

                         
                      @if(isset($sectors))   
                       
                        @foreach ($sectors as $sectors)
                        <tr>
                            <td>{{$sectors->id}}</td>
                            <td>{{$sectors->sector_name}}</td>
                            <td>{{$sectors->sector_description}}</td>
                            <td>{{$sectors->created_at}}</td>
                            <td>{{$sectors->user_creator}}</td>
                            <td>{{$sectors->updated_at}}</td>
                            <td>{{$sectors->updated_by}}</td>
                        </tr>
                      @endforeach
                    @endif     
                      </tbody>
                      
                  </table>
          
                      </div> 
          
                    </div>
                  </div>

          <!-- Fin Row Tabla-->
          </div>
        </div>
      </div>
    </div>

 
@endsection

@section('scripts')
{{-- CDN Morris.js--}}

{{-- {!!Html::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js') !!} --}}
{!!Html::script('//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') !!}
{!!Html::script('//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js') !!}

{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/dataTables.buttons.min.js') !!}


{!!Html::script('primerBit/dt_pb/buttons.flash.min.js') !!}
{!!Html::script('primerBit/dt_pb/jszip.min.js') !!}
{!!Html::script('primerBit/dt_pb/pdfmake.min.js') !!}
{!!Html::script('primerBit/dt_pb/vfs_fonts.js') !!}
{!!Html::script('primerBit/dt_pb/buttons.html5.min.js') !!}
{!!Html::script('primerBit/dt_pb/buttons.print.min.js') !!}

<script type="text/javascript">

$(document).ready(function() {
    $('#sectors').DataTable( {
       
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        responsive: true,
        "order": [[ 0, "desc" ]]
    } );

    table.buttons().container()
        .insertBefore( '#sectors' );
} );

</script>
<!-- {!!Html::script('primerBit/js/actions.js') !!} -->





@endsection