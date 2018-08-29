@extends('layouts.main')
@section('title')
 Alta de Sectores
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
                            <h2>Alta de Sectores </h2>
                          </br></br>
                          </div>

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group' , 'action' => 'BranchSectorController@store')) }}

                <div class="form-group col-md-4 ">
                    
                  {!! Form::label('sector_name', 'Ingrese el Nombre del Sector') !!}</br>
                  {!! Form::text('sector_name', '', array('id'=>'sector_name','class' => 'form-control')) !!}
                        
                </div>
             
                <div class="form-group col-md-4 ">
                    
                    {!! Form::label('sector_description', 'Ingrese la descripcion del Sector') !!}</br>
                    {!! Form::text('sector_description', '', array('id'=>'sector_description','class' => 'form-control')) !!}
                          
                  </div>
               
                        
            <div class="form-group col-md-4">
                    {!! Form::label('branchs', 'Seleccione la o las Sucursales') !!}</br>
                        
                      <select class="form-control branchs"  name="branchs[]" multiple="multiple">
                        <option value=""  disabled hidden>Sucursales</option>

                @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                @endforeach  
                     </select>
            </div>

          
                    <div class="form-group col-md-6">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Crear Sector</button>
                        
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
        $('.branchs').select2();
        $('.merchants').select2();
    });
</script>




@endsection