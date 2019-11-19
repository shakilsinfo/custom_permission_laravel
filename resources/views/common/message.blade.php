@if(Session::has('flash_message'))
  	<div style="font-size: 18px;font-style: italic;margin-top:15px;font-weight: bold;" class="alert alert-{{ session('status_color') }}">
  		<span class="fa fa-check-square-o"></span><em> {!! session('flash_message') !!}</em>
  	</div>
@endif