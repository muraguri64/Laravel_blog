@extends('main')
@section('title','| Contact')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">		    
		    <div class="panel-body">
		     	{!! Form::open(['url' => 'contact']) !!}
					<center><h2>Get in touch below</h2></center><hr>

					{{Form::label('name','Your name:',array('class' => 'form-spacing-top'))}}<span><i> (required)</i></span>
					{{Form::text('name',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}

					{{Form::label('email','Email:',array('class' => 'form-spacing-top'))}}<span><i> (required)</i></span>
					{{Form::email('email',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}

					{{Form::label('subject','Subject:',array('class' => 'form-spacing-top'))}}<span><i> (required)</i></span>
					{{Form::text('subject',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}

					{{Form::label('message_send','Message',array('class' => 'form-spacing-top'))}}<span><i> (required)</i></span>
					{{Form::textarea('message_send',null,array('class'=>'form-control','required'=>'','rows'=>'5'))}}

					 <br/>
					  {{Form::submit('Submit',array('class'=>'btn btn-primary btn-lg btn-block'))}}

				{!!Form::close()!!}	
			</div><!--end of panel body-->
		</div><!--end of panel default-->
	</div>
</div>
@endsection