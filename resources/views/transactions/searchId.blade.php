@extends('layouts.main')
@section('title')
 Buscar Transacciones x ID
@endsection
@section('stylesheets')

{!!Html::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css' ) !!}
{!!Html::style('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' ) !!}
{!!Html::style('https://cdn.datatables.net/1.10.16/css/dataTables.jqueryui.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/buttons/1.5.1/css/buttons.jqueryui.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css' ) !!}
{!!Html::style('https://cdn.datatables.net/buttons/1.5.1/css/buttons.bootstrap.min.css' ) !!}

@endsection

@section('content')
<div class="right_col" role="main">
        
    <div class="row"> 
        
        @include('layouts.partials.requestErrors')


            <div class="col-md-12 col-sm-12 col-xs-12" >

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group' , 'action' => 'TransactionController@trxId')) }}

                <div class="form-group col-md-6 ">
                  {!! Form::label('TransactionID', 'Ingrese el ID de la Transaccion') !!}
                  {!! Form::text('id', '', ['id '=> 'id','name'=> 'id','class' => 'form-control']) !!}
                </div>
             
                <div class="form-group col-md-6">
                    {!! Form::label('barcode', 'Ingrese el Código de Barras') !!}
                    {!! Form::text('barcode', '', ['id'=> 'barcode','name'=> 'barcode','class' => 'form-control']) !!}
                </div>

                <div class="form-group col-md-12">
            <div class="row">
                    <div class="form-group col-md-10">
                    {!! Form::label('rango', 'Buscar por Rango de Fecha') !!}
                    {!! Form::text('daterange', '', array('id'=>'date','class' => 'form-control')) !!}
                    </div>
                    
                    <div class="form-group col-md-2">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit"  >Buscar</button>
                        
                    </div>
        
            </div>
                </div>
                
                
             
             
       {!! Form::close() !!}
      
                  
                      </div>
    </div>{{-- Fin Row--}}

    @if(isset($trx_data))
        <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Busqueda de Transacciones</small></h2>
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
                          para el usuario <b>{{Auth::user()->name}} {{Auth::user()->last_name}}</b>. (Max 150 Registros por consulta)
                        </p>
                        <p>
                            <h4>Exportar Transacciones Listadas</h4>
                        </p>
            
                     <div class="table-responsive">
                    <!--   <table id="transactions" class="table table-striped table-bordered">-->
                       <table id="transactions" class="display nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th nowrap>ID</th>
                              <th nowrap>FECHA</th>
                              <th nowrap>NOMBRE DEL VDP</th>
                              <th nowrap>BARCODE</th>
                              <th nowrap>DESCRIPCION</th>
                              <th nowrap>MONEDA</th>
                              <th nowrap>PRECIO</th>
                              <th nowrap>MERCHANT ID</th>
                              <th nowrap>TIPO DE TRX</th>
                              <th nowrap>COD. RESPUESTA</th>
                              <th nowrap>COD. RESP. EXT.</th>
                              <th nowrap>SUCURSAL</th>
                              <th nowrap>SECTOR</th>
                              <th nowrap>VDP - DIR. IP</th>
                              <th nowrap>TRX - DIR. IP</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                     @foreach ($trx_data as $table)
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

{!!Html::script('https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js') !!}
{!!Html::script('https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js') !!}
{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/dataTables.buttons.min.js') !!}
{!!Html::script('primerBit/dt_pb/buttons.flash.min.js') !!}
{!!Html::script('primerBit/dt_pb/jszip.min.js') !!}
{!!Html::script('primerBit/dt_pb/pdfmake.min.js') !!}
{!!Html::script('primerBit/dt_pb/vfs_fonts.js') !!}
{!!Html::script('primerBit/dt_pb/buttons.html5.min.js') !!}
{!!Html::script('primerBit/dt_pb/buttons.print.min.js') !!}

{!!Html::script('text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js') !!}

<script type="text/javascript">
$(function() {


    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
              locale: {
          //format: 'DD-MM-YYYY HH:mm:ss',
          format: 'YYYY-MM-DD HH:mm:ss',
          separator: ' A ',
          applyLabel: 'Aplicar',
          cancelLabel: 'Cancelar',
          fromLabel: 'Desde',
          toLabel: 'Hasta',
          customRangeLabel: 'Personalizado',
          weekLabel: 'W',
          daysOfWeek: ['Do', 'Lu', 'Ma', 'Mie', 'Jue', 'Vie','Sa'],
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          firstDay: 1
        },
        ranges: { //Documentacion de momentjs ==> https://momentjs.com/docs/
          'Hoy': [moment().hours(00).minutes(00).seconds(00), moment().hours(23).minutes(59).seconds(59)],
          'Ayer': [moment().subtract(1, 'days').hours(00).minutes(00).seconds(00), moment().subtract(1, 'days').hours(23).minutes(59).seconds(59)],
          'Ultimos 7 Dias': [moment().subtract(6, 'days').hours(00).minutes(00).seconds(00), moment().hours(23).minutes(59).seconds(59)],
          'Ultimos 30 Dias': [moment().subtract(29, 'days').hours(00).minutes(00).seconds(00), moment().hours(23).minutes(59).seconds(59)],
          'Este Mes': [moment().startOf('month').hours(00).minutes(00).seconds(00), moment().endOf('month').hours(23).minutes(59).seconds(59)],
          'Ultimo Mes': [moment().subtract(1, 'month').startOf('month').hours(00).minutes(00).seconds(00), moment().subtract(1, 'month').endOf('month').hours(23).minutes(59).seconds(59)]
        }
    });
});


</script>


<script type="text/javascript">

    $(document).ready(function() {
        $('#transactions').DataTable( {
           
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            responsive: true,
            "order": [[ 0, "desc" ]]
        } );
    
        table.buttons().container()
            .insertBefore( '#transactions' );
    } );
    
    </script>
    
   

@endsection