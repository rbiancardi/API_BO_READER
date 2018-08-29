@extends('layouts.main')
@section('title')
 Alta de Producto
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
                            <h2>Alta de Productos </h2>
                          </br></br>
                          </div>

                {{ Form::open(array('id' => 'searchTrxId', 'class' => 'form-group' , 'action' => 'ProductController@store')) }}

                <div class="form-group col-md-3 ">
                    
                  {!! Form::label('barcode', 'Ingrese el Codigo de Barras') !!}</br>
                  {!! Form::text('barcode', '', array('id'=>'barcode','class' => 'form-control')) !!}
                        
                </div>
             
                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('description', 'Ingrese la descripcion del Producto') !!}</br>
                    {!! Form::text('description', '', array('id'=>'description','class' => 'form-control')) !!}
                          
                  </div>


                <div class="form-group col-md-3 ">
                    
                    {!! Form::label('currency', 'Seleccione la/s moneda/s') !!}</br>
                    
                 <select class="form-control "  name="currency[]" >
                      <option value=""  selected disabled hidden></option>
                      
                  @foreach($currencies as $currency)
                      <option value="{{$currency->id}}">{{$currency->iso_4712}} - {{$currency->currency_name}} </option>
                  @endforeach        
                </select>
                  </div>
               
                  <div class="form-group col-md-3">
                        {!! Form::label('price', 'Ingrese el Precio') !!}
                        {!! Form::text('price', '', array('id'=>'price','class' => 'form-control')) !!}
                  </div>



                <div class="form-group col-md-12">
            <div class="row">

            <div class="form-group col-md-3">
                {!! Form::label('merchants', 'Seleccione el o los Merchants') !!}</br>
                    
                  <select class="form-control currency"  name="merchants[]" multiple="multiple">
                    <option value=""  disabled hidden>Merchants</option>
                @foreach($merchants as $merchant)
                    <option value="{{$merchant->id}}">{{$merchant->merchant_id}} - {{$merchant->merchant_name}} </option>
                @endforeach    
                 </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('branchs', 'Seleccione la o las Sucursales') !!}</br>
                        
                      <select class="form-control branchs"  name="branchs[]" multiple="multiple">
                        <option value=""  disabled hidden>Sucursales</option>

                @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->branch_id}}</option>
                @endforeach  
                     </select>
            </div>

            <div class="form-group col-md-3">
                    {!! Form::label('sectors', 'Seleccione el o los Sectores') !!}</br>
                        
                      <select class="form-control sectors"  name="sectors[]" multiple="multiple">
                        <option value=""  disabled hidden>Sectores</option>

                    @foreach($sectors as $sector)
                        <option value="{{$sector->id}}">{{$sector->sector_name}}</option>
                    @endforeach  
                     </select>
            </div>

                    <div class="form-group col-md-3">
                        <button class=" btn btn-primary btn-md btn-block " style="margin-top:23px;" type="submit">Crear Producto</button>
                        
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