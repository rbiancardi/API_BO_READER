@extends('layouts.main')
@section('title')
 Editar de Sector
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
        
            <div class="col-md-12 col-sm-12 col-xs-12" >
                    <div class="x_title">
                        <h2>Estado actual del Sector - {{ $sector->sector_name}}  </h2>
                          </br></br>
                          </div>
        <div class="form-group col-md-12">

                          
                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('sector_name', 'Nombre del Sector') !!}</br>
                    {!! Form::text('sector_name', $sector->sector_name , array('id'=>'sector_name','class' => 'form-control','readonly' => 'true')) !!}
                          
                  </div>


                <div class="form-group col-md-3 ">
                    
                {!! Form::label('description', 'Descripcion ') !!}</br>
                {!! Form::text('description', $sector->sector_description , array('id'=>'description','class' => 'form-control','readonly' => 'true')) !!}

                  </div>

                  <div class="form-group col-md-3 ">
                    
                    {!! Form::label('enable', 'Estado') !!}</br>
                    {!! Form::text('enable', $sector->enable , array('id'=>'enable','class' => 'form-control','readonly' => 'true')) !!}
    
                 </div>               
                 
                 <div class="form-group col-md-3 ">
                    
                    {!! Form::label('enable', 'Sucursal/es') !!}</br>
                   
                    <select class="form-control branch" disabled name="branch[]" multiple="multiple">
                      
                        @foreach($branchOffices as $branchOffice)
                            <option value="{{$branchOffice->id}}" selected>{{$branchOffice->branch_id}}</option>
                        @endforeach        
                      </select>

                 </div>   

                </div>          

            
             </div>
                        
       </div>

<hr><hr> 
    <div class="row"> 
        @include('layouts.partials.requestErrors')
        @include('layouts.partials.success')
           
       <div class="col-md-12 col-sm-12 col-xs-12" >
               <div class="x_title">
                     <h2>Actualizar Sector - {{ $sector->sector_name}}  </h2>
                                     </br></br>
                                  </div>
             <div class="form-group col-md-12">
     
                     {{ Form::open(array('id' => 'updateSector', 'class' => 'form-group' , 'action' => 'BranchSectorController@sectorUpdate', 'method' => 'put')) }}
     
                                      
                     <div class="form-group col-md-3 ">
                         
                         {!! Form::label('sectorName', 'Ingrese el nombre del Sector') !!}</br>
                         {!! Form::text('sectorName', $sector->sector_name , array('id'=>'sectorName','class' => 'form-control')) !!}
                         <input type="hidden" name="sector_id" id="sector_id" value="{{$sector->id}}">             
                       </div>


                    <div class="form-group col-md-3 ">
                         
                        {!! Form::label('sector_description', 'Ingrese la Descripcion del Sector') !!}</br>
                        {!! Form::text('sector_description', $sector->sector_description , array('id'=>'sector_description','class' => 'form-control')) !!}
                        
                    </div>
     
     
                     <div class="form-group col-md-3 ">
                         
                     {!! Form::label('allbranchs', 'Seleccione la/s Sucursal/es') !!}</br>
                     <select class="form-control allbranchs"  name="allbranchs[]" multiple="multiple">
                        
                     @foreach($allBranchs as $branch)
                         <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                     @endforeach 
                      </select> 
     
                       </div>


                  <div class="form-group col-md-3 ">
                    
                    {!! Form::label('enable', 'Estado') !!}</br>
                   
                    <select class="form-control"  name="enable">
                        <option value="1">Habilitado</option>
                         <option value="0">Deshabilitado</option>
                      </select>
    
                </div>    
                    
                <div class="form-group col-md-4">
                    <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Actualizar Sector</button>
                    
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
        
        $('.branch').select2();
        $('.allbranchs').select2();
    });
    
</script>








@endsection