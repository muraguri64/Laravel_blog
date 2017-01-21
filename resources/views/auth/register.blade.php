@extends('main')

@section('title',"| Register")

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@if (Session::has('sent'))
				<div class="alert alert-success">
				  <strong>Success!</strong> {{Session::get('sent')}}
				</div>

			@endif
			<div class="text-center"><h2>Sign Up</h2></div>
			<div class="panel panel-default">
			  <div class="panel-body">
			    	{!! Form::open(['url' => '/register']) !!}
			    		
			    		<div class="form-group">
			    			{{Form::label('name','Username:')}}
			    			<div class="input-group">
			    			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
		    				{{Form::text('name',null,['class'=>'form-control','required'=>'','placeholder'=>'your Username','aria-describedby'=>'basic-addon1'])}}
			    			</div>
			    		</div>

			    		<div class="form-group">
			    			{{Form::label('email','Email Address:')}}
			    			<div class="input-group">
			    			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i></span>
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
			    		<div class="form-group">
			    			{{Form::label('password_confirmation','Confirm Password:')}}
			    			<div class="input-group">
			    				<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
			    				{{Form::password('password_confirmation',['class'=>'form-control','required'=>'','placeholder'=>'Confirm Password','aria-describedby'=>'basic-addon1'])}}
			    			</div>
		    				
			    		</div>	
			    		
			    		<div class="checkbox">
			    			<label>{{ Form::checkbox('agree_to_terms') }}I agree to the <a href="#">Terms of Service</a></label>
			    		</div>		    		


			    		{{Form::submit('Register',array('class'=>'btn btn-primary btn-lg btn-block'))}}
			    		
			    	{!! Form::close() !!}
			  </div>
			</div>
		</div>
	</div>
	@endsection