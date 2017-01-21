@extends('main')

@section('title',"| Login")



@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@if (Session::has('err'))
				<div class="alert alert-danger">
				  {{Session::get('err')}}
				</div>
			@endif
			<div class="text-center"><h2>Login</h2></div>
			<div class="panel panel-default">
			  <div class="panel-body">
			    	{!! Form::open(['url' => '/login']) !!}
			    		<div class="form-group">
			    			{{Form::label('email','Email Address:')}}
			    			<div class="input-group">
			    			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
		    				{{Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=>'your Email','aria-describedby'=>'basic-addon1'])}}
			    			</div>
			    		</div>

			    		<div class="form-group">
			    			{{Form::label('password','Password:')}}
			    			<div class="input-group">
			    				<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
			    				{{Form::password('password',['class'=>'form-control','required'=>'','placeholder'=>'Password','aria-describedby'=>'basic-addon1'])}}
			    			</div>
		    				
			    		</div>
			    		{{Form::submit('Login',array('class'=>'btn btn-primary btn-lg btn-block'))}}
			    		
			    	{!! Form::close() !!}
			  </div>
			</div>
		</div>
	</div>

@endsection

