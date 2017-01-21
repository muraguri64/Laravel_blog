@extends('main')

@section('title','| Delete Comment?')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>DELETE THIS COMMENT?</h2>
			<p>
				<strong>Name:</strong>{{$comment->name}}<br>
				<strong>Email:</strong>{{$comment->email}}<br>
				<strong>Comment:</strong>{{$comment->comment}}<br>

			</p>
			{!!Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE'])!!}
				{{Form::submit(' Yes Delete Comment',array('class'=>'btn btn-danger btn-block'))}}
			{!!Form::close()!!}
		</div>
	</div>
@endsection