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
        <h2>Estado actual del Producto - {{ $product->description}} - </h2>
                
                <div class="clearfix"></div>
              </div>
        
    <div class="row"> 
        
            <div class="col-md-12 col-sm-12 col-xs-12" >

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group')) }}

                <div class="form-group col-md-3 ">
                    
                  {!! Form::label('barcode', 'Codigo de Barras') !!}</br>
                  {!! Form::text('barcode', $product->barcode, array('id'=>'barcode','class' => 'form-control', 'readonly' => 'true')) !!}
                        
                </div>
             
                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('description', 'Descripcion del Producto') !!}</br>
                    {!! Form::text('description', $product->description, array('id'=>'description','class' => 'form-control', 'readonly' => 'true')) !!}
                          
                  </div>


                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('currency', 'Moneda') !!}</br>
                    
                 <select class="form-control currency" disabled name="currency[]" multiple="multiple">
                      
                  @foreach($currencies as $currency)
                      <option value="{{$currency->id}}" selected>{{$currency->iso_4712}} - {{$currency->currency_name}} </option>
                  @endforeach        
                </select>
                  </div>

                            
                  <div class="form-group col-md-3">
                        {!! Form::label('price', 'Precio') !!}
                        {!! Form::text('price', $product->price, array('id'=>'price','class' => 'form-control', 'readonly' => 'true')) !!}
                  </div>



                <div class="form-group col-md-12">
            <div class="row">

            <div class="form-group col-md-3">
                {!! Form::label('merchants', 'Merchants') !!}</br>
                    
                  <select class="form-control currency"  disabled name="merchants[]" multiple="multiple">
                    
                @foreach($merchants as $merchant)
                    <option value="{{$merchant->id}}" selected>{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
                @endforeach    
                 </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('branchs', 'Sucursales') !!}</br>
                        
                      <select class="form-control branchs" disabled  name="branchs[]" multiple="multiple">
                @foreach($branchOffices as $branch)
                    <option value="{{$branch->id}}"  selected>{{$branch->branch_id}}</option>
                @endforeach  
                     </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('sectors', 'Sectores') !!}</br>
                        
                      <select class="form-control sectors" disabled name="sectors[]" multiple="multiple">
                    @foreach($branchSectors as $sector)
                        <option value="{{$sector->id}}" selected>{{$sector->sector_name}}</option>
                    @endforeach  
                     </select>
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('enable', 'Estado') !!}
                {!! Form::text('enable', $product->enable, array('id'=>'enable','class' => 'form-control', 'readonly' => 'true')) !!}
          </div>           
        
            </div>
                </div>
                
                
             
       {!! Form::close() !!}
      
                  
                      </div>
    </div>{{-- Fin Row--}}

<hr>
    <div class="x_title">

            <h2>Modificar el Producto - {{ $product->description}} - <small>**Se deben reingresar todos los campos para poder realizar la actualización</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>

    <div class="row"> 
        
        @include('layouts.partials.requestErrors')
        @include('layouts.partials.success')


            <div class="col-md-12 col-sm-12 col-xs-12" >

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group' , 'action' => 'ProductController@ProductUpdate', 'method' => 'put')) }}

                <div class="form-group col-md-3 ">
                    
                  {!! Form::label('barcode', 'Ingrese el Codigo de Barras') !!}</br>
                  {!! Form::text('barcode', $product->barcode, array('id'=>'barcode','class' => 'form-control')) !!}
                  <input type="hidden" name="prodId" id="prodId" value="{{$product->id}}">     
                </div>
             
                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('description', 'Ingrese la descripcion del Producto') !!}</br>
                    {!! Form::text('description', $product->description, array('id'=>'description','class' => 'form-control')) !!}
                          
                  </div>


                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('currency', 'Seleccione la/s moneda/s') !!}</br>
                    
                 <select class="form-control currency"  name="currency[]" multiple="multiple">
                      
                  @foreach($allCurrencies as $currency)
                      <option value="{{$currency->id}}">{{$currency->iso_4712}} - {{$currency->currency_name}} </option>
                  @endforeach        
                </select>
                  </div>

                            
                  <div class="form-group col-md-1">
                        {!! Form::label('price', 'Precio') !!}
                        {!! Form::text('price', $product->price, array('id'=>'price','class' => 'form-control')) !!}
                  </div>

                  <div class="form-group col-md-2">
                    {!! Form::label('enable', 'Estado') !!}</br>
                        
                      <select class="form-control"  name="enable">
                        <option value="1">Habilitado</option>
                        <option value="0">Deshabilitado</option>
                     </select>
                </div>


                <div class="form-group col-md-12">
            <div class="row">

            <div class="form-group col-md-3">
                {!! Form::label('merchants', 'Seleccione el o los Merchants') !!}</br>
                    
                  <select class="form-control currency"  name="merchants[]" multiple="multiple">
                    
                @foreach($allMerchants as $merchant)
                    <option value="{{$merchant->id}}" >{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
                @endforeach    
                 </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('branchs', 'Seleccione la o las Sucursales') !!}</br>
                        
                      <select class="form-control branchs"  name="branchs[]" multiple="multiple">
                     @foreach($allBranchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                @endforeach  
                     </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('sectors', 'Seleccione el o los Sectores') !!}</br>
                        
                      <select class="form-control sectors"  name="sectors[]" multiple="multiple">
                     @foreach($allSectors as $sector)
                        <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
                    @endforeach  
                     </select>
            </div>

                    <div class="form-group col-md-3">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Actualizar</button>
                        
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