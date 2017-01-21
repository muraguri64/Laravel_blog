@extends('main')
@section('title')
{{$post->title}}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>{{$post->title}}</h2>
			<h5>Published:<i>{{date('j M, Y',strtotime($post->created_at))}}</i></h5>
			<hr>

			@if(isset($post->image))
				<img src="{{ asset('img/uploads/'.$post->image) }}" class="img-responsive" />
			@endif

			<br/><br/><br/>
			<p class="lead">{{$post->body}}</p>
		</div><br/>
		<div class ="text-center">
			<a href="{{route('blog.index')}}" class="btn btn-default">All Posts</a>
		</div>
	</div>

	@if($post->comments->count()>0)
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		   <center><h3><strong><span class="glyphicon glyphicon-comment"></span> {{$post->comments->count()}} comments</strong></h3></center><hr>
			@foreach($post->comments as $comment)
				<div class="comment">
					<div class="media">
						    <div class="media-left">
						        <a href="#">
						            <img src="/img/cool.ico" class="media-object img-circle" alt="Sample Image" height="50px" width="50px">
						        </a>
						    </div>
						    <div class="media-body">
						        <h4 class="media-heading"><strong>{{$comment->name}}</strong> <small><i>posted on{{$comment->created_at}}</i></small></h4>
						        <p>{{$comment->comment}}</p>
						    </div>
					</div><!--end of media div-->
				</div><br>
			@endforeach
		</div>
	</div>
	@endif

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<hr>
		<center><h3><strong>Add your comment below</strong></h3></center>
		
			<div id="comment-form">
				{!!Form::open(['route'=>['comments.store',$post->id],'method'=>'POST'])!!}
					<div class="row">
					    <div class="col-md-6">	
							{{Form::label('name','Name:')}}
							{{Form::text('name',null,array('class'=>'form-control','required'=>'','maxlength'=>'255','placeholder'=>'Your Name'))}}
						</div>
						
						<div class="col-md-6">
							{{Form::label('email','Email Address:')}}
							{{Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=>'your Email'])}}
						</div>

						<div class="col-md-12">
							{{Form::label('comment','Comment:')}}
							{{Form::textarea('comment',null,array('class'=>'form-control','required'=>'','placeholder'=>'Insert Your comment...'))}}
							<br>
							{{Form::submit('Submit',array('class'=>'btn btn-primary btn-lg btn-block'))}}
						</div>
					</div>	
				{!! Form::close() !!}<br><br>

			</div><!--end of comment form-->
		</div>
	</div>
@endsection
