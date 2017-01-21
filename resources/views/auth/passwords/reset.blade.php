@extends('main')

@section('title',"| Reset")



@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">

				<div class="panel panel-default">
				  <div class="panel-body">
				    	{!! Form::open(['url' => '/password/reset']) !!}
				    	
				    		<div class="form-group">
				    			{{Form::label('email','Email Address:')}}
				    			<div class="input-group">
				    			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope"></i></span>
			    				{{Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=>'your Email','aria-describedby'=>'basic-addon1'])}}
				    			</div>
				    		</div>

				    		<input name="token" type="hidden" value="{{$token}}">


				    		<div class="form-group">
				    			{{Form::label('password','New Password:')}}
				    			<div class="input-group">
				    				<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
				    				{{Form::password('password',['class'=>'form-control','required'=>'','placeholder'=>'Password','aria-describedby'=>'basic-addon1'])}}
				    			</div>
			    				
				    		</div>
				    		<div class="form-group">
				    			{{Form::label('password_confirmation','Confirm New Password:')}}
				    			<div class="input-group">
				    				<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
				    				{{Form::password('password_confirmation',['class'=>'form-control','required'=>'','placeholder'=>'Confirm Password','aria-describedby'=>'basic-addon1'])}}
				    			</div>
			    				
				    		</div>				    		
				    		   		


				    		{{Form::submit('Reset',array('class'=>'btn btn-primary btn-lg btn-block'))}}
				    		
				    	{!! Form::close() !!}
				  </div>
				</div>

			
		</div>
	</div>
@endsection