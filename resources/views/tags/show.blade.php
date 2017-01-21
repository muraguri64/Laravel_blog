@extends('main')

@section('title')
| {{ $tag->name }}Tag
@endsection

@section('stylesheet')
<style>
	[v-cloak]{
		display:none;
	}
</style>
@endsection

@section('content')
<div id ="app">
	<div  v-if="viewed" v-cloak>
		<div class='alert alert-danger'>
			<a href='#' v-on:click='linkclose' class='close'>&times;</a>
			@{{message}}
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<h1>{{$tag->name}} Tag<small>->({{$tag->posts->count()}} posts)</small></h1>
			<hr>
		</div>
		<div class="col-md-2 ">
			<br>
			<a href="{{route('tags.edit',$tag->id)}}" class="btn btn-primary btn-block">Edit</a>
		</div>

		<div class="col-md-2">
			<br>	
				<button id ="mybtn" class="btn btn-danger btn-block" @click="ajax" data-token="{{ csrf_token() }}">Delete</button>		
		</div>
		<br>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="overlay"><div class="loader"></div></div>
		@if($tag->posts->count()>0)
			<div class="table-responsive">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
					<th></th>
				</thead>
				<tbody>
				@foreach($tag->posts as $post)
				<tr>
					<th>{{$post->id}}</th>
					<td>{{$post->title}}</td>
					<td>@foreach($post->tags as $tag)
							<span class="label label-default">{{$tag->name}}</span>
						@endforeach
					</td>
					<td><a href="{{route('posts.show',$post->id)}}" class="btn btn-default btn-sm">View</a></td>
			    </td>		
			    </tr>
				@endforeach

				</tbody>
			</table>
			</div>
		@else
		<p class="lead" >No posts are assigned to this tag</p>
		@endif	
		</div>
	</div>
</div>
<script src="/js/vue.js"></script>
<script type="text/javascript">	
	var app = new Vue({
	  el: '#app',
	  data:{
	  	token:'',
	  	message:'',
	  	viewed:false
	  },
	  methods:{
	  	ajax:function(event){
	  		document.getElementById("overlay").style.display = "block";
	  		var app = this;
	  		app.token = event.target.getAttribute('data-token');

 			$.ajax({

 		       type:'DELETE',
 		       url: "{{route('tags.destroy',$tag->id)}}",
 		       data: {
	                       		                       
	                    "_token": app.token
	                 },
 		       dataType: "JSON",
 		       success:function(data)
 		       {
 		       	   document.getElementById("overlay").style.display = "none";
 		       	   location.replace("{{route('tags.index')}}");
 		           
 		       },
 		       error: function(xhr, status, error)
 		       {
 		       	   document.getElementById("overlay").style.display = "none";
 		       	   app.message = "Error ocurred";		 		       	   
 		       	   app.viewed  = true;	           
 		       }
 		   });
	  	},
	  	linkclose:function(){
			var app =this;
			app.viewed = false;  		  		

	  	}
	  }
	});	

</script>
@endsection