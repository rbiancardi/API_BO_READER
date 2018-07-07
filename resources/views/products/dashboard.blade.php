@extends('layouts.main')
@section('title')
 Dashboard - Productos
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
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fas fa-store-alt"></i> Merchants</span>
        <div class="count green">{{$merchUsr}}</div>
        <span class="count_bottom">Comercios Disponibles</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fas fa-store-alt"></i> Productos Deshabilitados</span>
      <div class="count red">{{$productDisable}}</div>
      <span class="count_bottom"><i class="red">{{$productPercentage}}%</i> del Total</span>
      </div>
      
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fa fa-product-hunt"></i> Total de Productos</span>
      <div class="count red">{{$product}}</div>
        <span class="count_bottom">En sus <i class="green">{{$merchUsr}}</i> comercios</span>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fa fa-exchange"></i> Total de Transacciones</span>
        <div class="count">{{$trx}}</div>
        <span class="count_bottom">En sus <i class="green">{{$merchUsr}}</i> comercios</span>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fa fa-building-o"></i> Total de Sucursales</span>
      <div class="count">{{$branch}}</div>
        <span class="count_bottom">En sus <i class="green">{{$merchUsr}}</i> comercios</span>
      </div>
            
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" align="center">
        <span class="count_top"><i class="fa fa-barcode"></i> VDP'S Habilitados</span>
      <div class="count">{{$readers}}</div>
      <span class="count_bottom"><i class="red">{{$readerPercentage}}%</i> del Total</span>
      </div>
    </div>
    <!-- /top tiles -->


          <div class="row" align="center">

          <h2>Datos correspondientes a los ultimos 90 días. <small>({{$start}} - {{$end}})</small></h2>
         
            <div class="col-md-4 col-sm-4 col-xs-12">
              <h2>Transacciones OK vs NOK</h2>
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                  <div id="ok_nok"  style="height: 310px;" ></div>
              </div>
            </div>


            <div class="col-md-8 col-sm-8 col-xs-12">
                <h2>Ranking de Productos</h2>
              <div class="x_panel tile fixed_height_320">
                  <div id="rank_prod"  style="height: 310px;" ></div>
              </div>
            </div>

            
          </div>

          <div class="row" align="center">
             
              <div class="col-md-6 col-sm-6 col-xs-12">
              <h2>Ranking de Sucursales</h2>
              <div class="x_panel tile fixed_height_320">
                 
                  <div id="rank_suc"  style="height: 310px;" ></div>
              </div>
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12">
                <h2>Ranking de Verificadores</h2>
                <div class="x_panel tile fixed_height_320">
                   
                    <div id="rank_vdp"  style="height: 310px;" ></div>
                </div>
              </div>


          </div>

          <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Reporte de Transacciones <small>- (Ultimos 60 días) -</small></h2>
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
                        A continuacion se listas todas las transacciones que corresponden con todos los merchant_id que se encuentren habilitados en nuestra plataforma
                        para el usuario <b>{{Auth::user()->name}} {{Auth::user()->last_name}}</b>.
                      </p>
                      <p>
                          <h4>Exportar Transacciones Listadas</h4>
                      </p>
          
                   <div class="table-responsive">
                  <!--   <table id="transactions" class="table table-striped table-bordered">-->
                     <table id="transactions" class="display nowrap" cellspacing="0" width="50%">
                      <thead>
                          <tr>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>NOMBRE DEL VDP</th>
                            <th>BARCODE</th>
                            <th>DESCRIPCION</th>
                            <th>MONEDA</th>
                            <th>PRECIO</th>
                            <th>MERCHANT ID</th>
                            <th>TIPO DE TRX</th>
                            <th>COD. RESPUESTA</th>
                            <th>COD. RESP. EXT.</th>
                            <th>SUCURSAL</th>
                            <th>SECTOR</th>
                            <th>VDP - DIR. IP</th>
                            <th>TRX - DIR. IP</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                    @if(isset($trxProducts))    
                        @foreach ($trxTable as $table)
                        <tr>
                          <td>{{$table->id}}</td>
                          <td>{{$table->created_at}}</td>
                            <td>{{$table->reader_name}}</td>
                            <td>{{$table->barcode}}</td>
                            <td>{{$table->product_description}}</td>
                            <td>{{$table->product_currency}}</td>
                            <td>{{$table->product_price}}</td>
                            <td>{{$table->merchant_id}}</td>
                            <td>{{$table->transaction_type}}</td>
                            <td>{{$table->trx_result}}</td>
                            <td>{{$table->trx_result_extended}}</td>
                            <td>{{$table->branch_name}}</td>
                            <td>{{$table->sector_name}}</td>
                            <td>{{$table->reader_ip}}</td>
                            <td>{{$table->trx_ip}}</td>
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
    $('#transactions').DataTable( {
       
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        responsive: true,
    } );

    table.buttons().container()
        .insertBefore( '#transactions' );
} );

</script>
<!-- {!!Html::script('primerBit/js/actions.js') !!} -->




<script type="text/javascript">


  new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'rank_suc',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    
    @foreach ($topBranch as $branch)
    { suc: '{{$branch->branch_name}}', value: {{$branch->total}} },
    @endforeach
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'suc',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Trxs'],

  
});

</script>

<script type="text/javascript">
new Morris.Donut({
  element: 'ok_nok',
  data: [
    {label: "TRX. OK", value: {{$trxOk}}},
    {label: "TRX. NOK", value: {{$trxNOk}}}
    
  ],
  colors: [
    '#01DF01',
    '#FF0000'
    
],
});

</script>

<script type="text/javascript">

new Morris.Bar({
  element: 'rank_prod',
  data: [

    @foreach ($topEan as $ean)
    {x: '{{$ean->barcode}}', y: {{$ean->total}}},
    @endforeach

  ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['Cant. de Trx'],
  barColors: function (row, series, type) {
    if (type === 'bar') {
      var red = Math.ceil(255 * row.y / this.ymax);
      return 'rgb(' + red + ',0,0)';
    }
    else {
      return '#000';
    }
}

});

</script>

<script type="text/javascript">

  new Morris.Bar({
    element: 'rank_vdp',
    data: [
  
      @foreach ($topVdp as $vdp)
      {x: '{{$vdp->reader_name}}', y: {{$vdp->total}}},
      @endforeach
  
    ],
    xkey: 'x',
    ykeys: ['y'],
    labels: ['Cant. de Trx'],
    barColors: function (row, series, type) {
      if (type === 'bar') {
        var red = Math.ceil(255 * row.y / this.ymax);
        return 'rgb(' + red + ',0,0)';
      }
      else {
        return '#000';
      }
  }
  
  });
  
  </script>



@endsection