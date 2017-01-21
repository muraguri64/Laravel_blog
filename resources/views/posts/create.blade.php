@extends('main')
@section('title','| Create New Post')

@section('stylesheet')
<link href="/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
<script src="/js/select2.min.js"></script>
<script type="text/javascript">	
	$(document).ready(function() {
	 	$(".select2-multi").select2();
	});	

</script>
@endsection

@section('content')
<div class ="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Create New Post</h1>
		<hr>
		{!! Form::open(['route' => 'posts.store','files'=>true]) !!}
		    {{Form::label('title','Title:')}}
		    {{Form::text('title',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}
		    	<br/>
		    {{Form::label('image','Upload Featured Image:')}}
		    {{Form::file('image')}}

		    {{Form::label('body','Post Body:')}}
		    {{Form::textarea('body',null,array('class'=>'form-control','required'=>''))}}

		    {{Form::label('category_id','Category:')}}
		    <select class="form-control" name="category_id">
		    	@foreach($categories as $category)
			    	<option value='{{$category->id}}'>{{$category->name}}</option>
		    	@endforeach
		    </select>

		     {{Form::label('tags','Tags:')}}
		    <select class="select2-multi form-control" name="tags[]" multiple="multiple">
		    	 @foreach($tags as $tag)
			    	<option value='{{$tag->id}}'>{{$tag->name}}</option>
		    	 @endforeach 

		    </select>
		    <br><br>

		    {{Form::submit('Create Post',array('class'=>'btn btn-success btn-lg btn-block'))}}

		{!! Form::close() !!}
	</div>
</div>
@endsection