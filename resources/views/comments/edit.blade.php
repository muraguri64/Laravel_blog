@extends('main')
@section('title','| Edit comment')
@section('scripts')
<script type="text/javascript" src="/js/jquery.history.js"></script>
<script>
	$(function() {
		var p;
		var count = 0 ;
			History.Adapter.bind(window, 'statechange', handleStateChange);
			p	= document.referrer;
			
			History.pushState(null, null, "?doc=1");		
		
		function handleStateChange() {
			count++;
			console.log(count);
			if(count>1){
			   if(document.referrer==''){
			   		window.history.back();
			   }
			   else{
			   		location.replace(p);
			   }
				
			}
			
		}
	});
	</script>
@endsection


@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Edit Comment</h3>
			<hr>
			{!!Form::model($comment,['route'=>['comments.update',$comment->id],'method'=>'PUT'])!!}

					{{Form::label('name','Name:')}}
					{{Form::text('name',null,["class"=>'form-control input-lg','disabled'=>'disabled'])}}

					{{Form::label('email','Email:')}}
					{{Form::email('email',null,["class"=>'form-control input-lg','disabled'=>'disabled'])}}

					{{Form::label('comment','Title:')}}
					{{Form::textarea('comment',null,["class"=>'form-control input-lg'])}}

				<br/>		
			{{Form::submit('Update Comment',array('class'=>'btn btn-success btn-block'))}}

			{!!Form::close()!!}
		</div>
	</div>

@endsection