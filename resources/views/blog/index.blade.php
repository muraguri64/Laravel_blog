@extends('main')

@section('title',"| Blog Posts")

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<center><h1>Blog</h1></center>
			<hr>
		</div>
	</div>

	@foreach($posts as $post)
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2>{{$post->title}}</h2>
				<h5><strong>Published: </strong><i>{{date('j M, Y',strtotime($post->created_at))}}</i></h5>
				<p>{{substr($post->body,0,100)}} {{strlen($post->body)>100 ?"...":""}}</p>
				<a href="{{route('blog.single',$post->id)}}">Read More</a>
				
			</div>
		</div>
	@endforeach
	<div class="row">
		<div class="col-md-12">
			<div class ="text-center">
				{{$posts->links()}}
			</div>
		</div>
	</div>
@endsection