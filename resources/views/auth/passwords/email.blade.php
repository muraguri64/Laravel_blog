@extends('main')

@section('title',"| Reset Password")



@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="text-center"><h2>Forgot Password?</h2><p>Enter your email below to get a password reset link</p></div>
			<div class="panel panel-default">
			  <div class="panel-body">	
			  
			  		<!--Open up the form-->		  
			    	{!! Form::open(['url' => '/password/email']) !!}
			    		<div class="form-group">
			    			{{Form::label('email','Email Address:')}}
			    			<div class="input-group">
				    			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
			    				{{Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=>'your Email','aria-describedby'=>'basic-addon1'])}}
			    			</div>
			    		</div>

			    	

			    		{{Form::submit('Send',array('class'=>'btn btn-primary btn-lg btn-block'))}}
			    	
			    	<!--close the form-->	
			    	{!! Form::close() !!}
			  </div><!--End of panel body class-->
			</div><!--End of panel-default class-->

		</div>
	</div>
@endsection	
