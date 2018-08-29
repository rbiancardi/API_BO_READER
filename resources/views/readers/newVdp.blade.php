@extends('layouts.main')
@section('title')
 Alta de Verificadores
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



            <div class="col-md-12 col-sm-12 col-xs-12" >
                <div class="x_title">
                      <h2>Alta de Verificadores de Precios (VDP'S) </h2>
                    </br></br>
                    </div>
                {{ Form::open(array('id' => 'createVdp', 'class' => 'form-group' , 'action' => 'ReaderController@store')) }}

                <div class="form-group col-md-4 ">
                    
                  {!! Form::label('reader_name', 'Ingrese el Nombre del VDP') !!}</br>
                  {!! Form::text('reader_name', '', array('id'=>'reader_name','class' => 'form-control')) !!}
                        
                </div>
             

                  <div class="form-group col-md-4">
                    {!! Form::label('merchant_id', 'Seleccione el Merchant Id') !!}</br>
                        
                      <select class="form-control merchant_id"  name="merchant_id" >
                        <option value=""  selected disabled hidden></option>
                    @foreach($merchants as $merchant)
                        <option value="{{$merchant->id}}">{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
                    @endforeach    
                     </select>
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('branch_id', 'Seleccione la Sucursal') !!}</br>
                        
                      <select class="form-control branch_id"  name="branch_id">
                        <option value="" selected disabled hidden></option>

                @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                @endforeach  
                     </select>
            </div>
               
                 
                <div class="form-group col-md-12 ">

                 <div class="form-group col-md-1 ">
                 
                     {{--Reservado para alineacion --}}

                </div>

            <div class="form-group col-md-3 ">
                    {!! Form::label('branchSector_id', 'Seleccione el o los Sectores') !!}</br>
                        
                      <select class="form-control branchSector_id"  name="branchSector_id">
                        <option value="" selected disabled hidden></option>

                    @foreach($sectors as $sector)
                        <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
                    @endforeach  
                     </select>
            </div>


            <div class="form-group col-md-3">
                    
                {!! Form::label('reader_ip', 'Ingrese La direccion IP del VDP') !!}</br>
                {!! Form::text('reader_ip', '', array('id'=>'reader_ip','class' => 'form-control')) !!}
                      
              </div>

                    <div class="form-group col-md-3 ">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Crear Verificador de Precios</button>
                        
                    </div>
                           
            </div>
                </div>
                
                
             
       {!! Form::close() !!}
      
                  
                      </div>
    </div>{{-- Fin Row--}}

</div>
</div>

@endsection


@section('scripts')


{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/dt_pb/jquery.dataTables.js') !!}
{!!Html::script('primerBit/js/select2.min.js') !!}

<script type="text/javascript">
    $(document).ready(function() {
        $('.branch_id').select2();
        $('.merchant_id').select2();
        $('.branchSector_id').select2();
    });
</script>




@endsection