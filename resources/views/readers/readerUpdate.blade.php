@extends('layouts.main')
@section('title')
 Editar Producto
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

        <div class="x_title">
        <h2>Estado actual del Verificador - {{ $vdp->reader_name}} - </h2>
                
                <div class="clearfix"></div>
              </div>
<div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12" >
                    
                    {{ Form::open(array('id' => 'updateVdp', 'class' => 'form-group')) }}
    
                    <div class="form-group col-md-4 ">
                        
                      {!! Form::label('reader_name', 'Nombre del VDP') !!}</br>
                      {!! Form::text('reader_name', $vdp->reader_name, array('id'=>'reader_name','class' => 'form-control','readonly' => 'true')) !!}
                            
                    </div>
                 
    
                      <div class="form-group col-md-4">
                        {!! Form::label('merchant_id', 'Merchant Id') !!}</br>
                        {!! Form::text('merchant_id', $vdp->vdpMerchantName, array('id'=>'merchant_id','class' => 'form-control','readonly' => 'true')) !!}    
                        
                    </div>
    
                    <div class="form-group col-md-4">
                        {!! Form::label('branch_id', 'Sucursal') !!}</br>
                        {!! Form::text('branch_id', $vdp->vdpBranchName, array('id'=>'branch_id','class' => 'form-control','readonly' => 'true')) !!}
                          
                </div>
                   
                     
            <div class="form-group col-md-12 ">

                <div class="form-group col-md-4 ">
                        {!! Form::label('branchSector_id', 'Sector del VDP') !!}</br>
                        {!! Form::text('branchSector_id', $vdp->vdpSectorName, array('id'=>'branchSector_id','class' => 'form-control','readonly' => 'true')) !!}    
                        
                </div>
    
    
                <div class="form-group col-md-4">
                        
                    {!! Form::label('reader_ip', 'Direccion IP del VDP') !!}</br>
                    {!! Form::text('reader_ip', $vdp->reader_ip, array('id'=>'reader_ip','class' => 'form-control','readonly' => 'true')) !!}
                          
                  </div>

                  <div class="form-group col-md-4">
                        
                        {!! Form::label('enable', 'Estado del VDP') !!}</br>
                        {!! Form::text('enable', $vdp->enable, array('id'=>'enable','class' => 'form-control','readonly' => 'true')) !!}
                              
                </div>
    
                                                     
                </div>
                    
                    
           {!! Form::close() !!}
                 </div>
        </div>{{-- Fin Row--}}

<hr>
    <div class="x_title">

            <h2>Modificar el Verificador - {{ $vdp->reader_name}} - <small>**Se deben reingresar todos los campos para poder realizar la actualización</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>

    <div class="row"> 
        
        @include('layouts.partials.requestErrors')
        @include('layouts.partials.success')


            <div class="col-md-12 col-sm-12 col-xs-12" >

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group' , 'action' => 'ReaderController@ReaderUpdate', 'method' => 'put')) }}

                <div class="form-group col-md-4 ">
                    
                  {!! Form::label('reader_name', 'Ingrese el Nombre del VDP') !!}</br>
                  {!! Form::text('reader_name', $vdp->reader_name, array('id'=>'reader_name','class' => 'form-control')) !!}
                  <input type="hidden" name="readerId" id="readerId" value="{{$vdp->id}}">     
                </div>
             
                <div class="form-group col-md-4 ">
                    
                    {!! Form::label('merchants', 'Seleccione el Merchant ID') !!}</br>
                    
                    <select class="form-control currency"  name="merchant_id">
                          <option value=""  selected disabled hidden></option>
                  @foreach($allMerchants as $merchant)
                      <option value="{{$merchant->id}}" >{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
                  @endforeach    
                   </select>
                          
                  </div>
                            
                  
                  <div class="form-group col-md-4">
                                           
                      {!! Form::label('branchs', 'Seleccione la Sucursal') !!}</br>
                      
                      <select class="form-control branchs"  name="branch_id">
                          <option value=""  selected disabled hidden></option>
                          @foreach($allBranchs as $branch)
                          <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                          @endforeach  
                      </select>
                 </div>


                <div class="form-group col-md-12">
            <div class="row">

            <div class="form-group col-md-3">
              
                {!! Form::label('sectors', 'Seleccione el o los Sectores') !!}</br>
                        
                <select class="form-control sectors" name="branchSector_id" >
                      <option value=""  selected disabled hidden></option>
               @foreach($allSectors as $sector)
                  <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
              @endforeach  
               </select>

            </div>

            <div class="form-group col-md-3">
                 
                    {!! Form::label('reader_ip', 'Ingrese la Direccion IP') !!}</br>
                    {!! Form::text('reader_ip', $vdp->reader_ip, array('id'=>'reader_ip','class' => 'form-control')) !!}
    
              </div>
    

            <div class="form-group col-md-3">

             {!! Form::label('enable', 'Estado') !!}</br>
                 <select class="form-control"  name="enable">
                   <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                 </select>
            </div>
                    <div class="form-group col-md-3">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Actualizar Verificador</button>
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
        $('.currency').select2();
        $('.branchs').select2();
        $('.merchants').select2();
        $('.sectors').select2();
    });
</script>




@endsection