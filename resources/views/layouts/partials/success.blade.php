@if(Session::has('success'))
	<div class="alert alert-success alert-dismissible" role="alert">
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
          <strong>{{Session::get('success')}}
          
  	</div>
@endif
 {{-- Muestro los mensajes Success--}}