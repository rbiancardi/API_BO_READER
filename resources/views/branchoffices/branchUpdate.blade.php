@extends('layouts.main')
@section('title')
 Editar de Sucursal
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
                        <h2>Estado actual de la Sucursal - {{ $branch->branch_name}}  </h2>
                          </br></br>
                          </div>
        <div class="form-group col-md-12">

             <div class="form-group col-md-3 ">
                    
                  {!! Form::label('branch_id', 'Ingrese el Identificador de la Sucursal') !!}</br>
                  {!! Form::text('branch_id', $branch->branch_id ,array('id'=>'branch_id','class' => 'form-control','readonly' => 'true')) !!}
                        
                </div>
             
                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('branch_name', 'Ingrese el nombre de la Sucursal') !!}</br>
                    {!! Form::text('branch_name', $branch->branch_name , array('id'=>'branch_name','class' => 'form-control','readonly' => 'true')) !!}
                          
                  </div>


                <div class="form-group col-md-3 ">
                    
                {!! Form::label('merchant_id', 'Seleccione el Merchant ID') !!}</br>
                {!! Form::text('merchant_id', $branch->merchant_id , array('id'=>'merchant_id','class' => 'form-control','readonly' => 'true')) !!}

                  </div>

                  <div class="form-group col-md-3 ">
                    
                    {!! Form::label('enable', 'Estado') !!}</br>
                    {!! Form::text('enable', $branch->enable , array('id'=>'enable','class' => 'form-control','readonly' => 'true')) !!}
    
                </div>               
                 

                </div>          

                <div class="form-group col-md-12">
            
                    <div class="form-group col-md-3 ">
                    
                        {!! Form::label('Country', 'Pais') !!}</br>
                        {!! Form::text('Country', $branch->branch_country ,array('class' => 'form-control','readonly' => 'true')) !!}
                              
                      </div>
                   
                      <div class="form-group col-md-3 ">
                          
                          {!! Form::label('province', 'Provincia') !!}</br>
                          {!! Form::text('province', $branch->branch_province , array('class' => 'form-control','readonly' => 'true')) !!}
                                
                        </div>
      
      
                      <div class="form-group col-md-3 ">
                          
                      {!! Form::label('county', 'Partido') !!}</br>
                      {!! Form::text('county', $branch->branch_county , array('class' => 'form-control','readonly' => 'true')) !!}
      
                        </div>
      
                        <div class="form-group col-md-3 ">
                          
                          {!! Form::label('localities', 'Localidad') !!}</br>
                          {!! Form::text('localities', $branch->branch_localities , array('class' => 'form-control','readonly' => 'true')) !!}
          
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
                     <h2>Actualizar Sucursal - {{ $branch->branch_name}}  </h2>
                                     </br></br>
                                  </div>
             <div class="form-group col-md-12">
     
                     {{ Form::open(array('id' => 'newBranch', 'class' => 'form-group' , 'action' => 'BranchOfficeController@branchUpdate', 'method' => 'put')) }}
     
                     <div class="form-group col-md-3 ">
                         
                       {!! Form::label('branch_id', 'Ingrese el Identificador de la Sucursal') !!}</br>
                       {!! Form::text('branch_id', $branch->branch_id ,array('id'=>'branch_id','class' => 'form-control')) !!}
                       <input type="hidden" name="branchId" id="branchId" value="{{$branch->id}}">     
                     </div>
                  
                     <div class="form-group col-md-3 ">
                         
                         {!! Form::label('branch_name', 'Ingrese el nombre de la Sucursal') !!}</br>
                         {!! Form::text('branch_name', $branch->branch_name , array('id'=>'branch_name','class' => 'form-control')) !!}
                               
                       </div>
     
     
                     <div class="form-group col-md-3 ">
                         
                     {!! Form::label('merchant_id', 'Seleccione el Merchant ID') !!}</br>
                     <select class="form-control merchants"  name="merchants">
                        <option value=""  disabled selected></option>
                     @foreach($merchants as $merchant)
                         <option value="{{$merchant->id}}">{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
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
                    
                      
     
                     </div>          
     
                     <div class="form-group col-md-12">
                 
     
                        <div class="form-group col-md-3">
                            {!! Form::label('country', 'Seleccione el País') !!}</br>
                                
                             <select name="country" id="country" class="form-control country" >
                                <option value=""  disabled selected></option>
        
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach  
                             </select>
                    </div>
        
        
                    <div class="form-group col-md-3">
                            {!! Form::label('prov', 'Seleccione la Provincia') !!}</br>
        
                            <select name="province" id="province" class="form-control province">    
                                <option value=""  disabled>Provincias</option>
                            </select> 
                   </div>
        
        
                   <div class="form-group col-md-3">
                            {!! Form::label('county', 'Seleccione el Partido') !!}</br>
                            <select class="form-control county" name="county" id="county">
                                <option value=""  disabled >Partido</option>
                            </select>
                   </div>
        
        
                    <div class="form-group col-md-3">
                            {!! Form::label('locality', 'Seleccione la Localidad') !!}</br>
                            
                            <select class="form-control locality" name="locality" id="locality">
                                <option value=""  disabled >Localidad</option>
                           </select>
                    </div>
     
     
                         <div class="form-group col-md-3">
                             <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Actualizar Sucursal</button>
                             
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
        
        $('.merchants').select2();
        $('.country').select2();
        $('.province').select2();
        $('.county').select2();
        $('.locality').select2();
    });
    
</script>




<script type="text/javascript">
   

$(document).ready(function(){

        $(document).on('change','.country',function(){
            //console.log("hmm its change");

            var country_id=$(this).val();
            var select = $(".province");
            // console.log(select);
            var op=" ";

            $.ajax({
                type:'get',
                url:'{{ URL::route('findProvince') }}',
                data:{'id':country_id},
                success:function(data){
                    //console.log(url);

                    //console.log(data);

                    //console.log(data.length);
                    op+='<option value="0" selected disabled>Selecciona La Provincia</option>';
                    for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    //console.log(op);
                }

                    select.html(op);
                        
                },
                error:function(){

                }
            });
        });

         $(document).on('change','.province',function(){
            //console.log("hmm its change");

            var province_Id=$(this).val();
            // console.log(country_id);
        // var select=$(this).parent();
           var select = $(".county");
            // console.log(select);
            var op=" ";

            $.ajax({
                type:'get',
                url:'{{ URL::route('findCounty') }}',
                data:{'id':province_Id},
                success:function(data){
                    //console.log(url);

                    //console.log(data);

                    //console.log(data.length);
                    op+='<option value="0" selected disabled>Selecciona El Partido</option>';
                    for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    //console.log(op);
                }

                    select.html(op);
                        
                },
                error:function(){

                }
            });
        });


        $(document).on('change','.county',function(){
            //console.log("hmm its change");

            var localityId=$(this).val();
       
           var select = $(".locality");
            // console.log(select);
            var op=" ";

            $.ajax({
                type:'get',
                url:'{{ URL::route('findLocality') }}',
                data:{'id':localityId},
                success:function(data){
                    //console.log(url);

                    //console.log(data);

                    //console.log(data.length);
                    op+='<option value="0" selected disabled>Selecciona La Localidad</option>';
                    for(var i=0;i<data.length;i++){
                    op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                    //console.log(op);
                }

                    select.html(op);
                        
                },
                error:function(){

                }
            });
        });


});
   
</script>


  



@endsection