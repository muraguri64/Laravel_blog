@extends('main')
@section('title','| View post')

@section('scripts')
<script type="text/javascript">	
	$(document).ready(function(){

		var comment_id;
		
		$('tr').on("click",'button#delete', function(){
		    comment_id = $(this).data("id");
		    var token  = $(this).data("token");

	      var dialog = bootbox.dialog({
	          message: '<p class="text-center"><i class="fa fa-spin fa-spinner"></i> Deleting...</p>',
	          closeButton: false
	      });

	      	setTimeout(ajaxfunc, 4000);

	      	function ajaxfunc()
	      	{
	      		$.ajax({

     		       type:'DELETE',
     		       url: "/comments/"+comment_id,
     		       cache: false,
     		       data: {
    	                       		                       
    	                    "_token": token
    	                 },
     		       dataType: "JSON",
     		       success:function(data)
     		       {
     		       	  
     		       	  if(data.success){

     		       	  	$("tr#"+comment_id).remove();
     		       	  	dialog.modal('hide');
     		       	  	bootbox.dialog({ message: "<div class='text-center' style='color:#006400;'>"+
     		       	  		"<i class='fa fa-check' aria-hidden='true'></i> Comment Deleted succesfully</div>" });
     		       	  	     		       	  	
     		       	  }     		       	  
     		           
     		       },
     		       error: function(xhr, status, error)
     		       {
     		       	   
     		       	  //console.log(error);
     		       	  //$("#response").text("error ocurred");
     		       	  dialog.modal('hide');
     		       	 bootbox.dialog({ message: "<div class='text-center' style='color:red;'>" + 
     		       	      		       	   		"<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Error Ocurred</div>" });
     		       	  //$("#message").show();		 		       	   
     		       	              
     		       }
     		   });

	      	}

     			
		});

		$("#linkclose").on("click",function(){
			$("#message").hide();
		});
	});
</script>
@endsection

@section('content')
<div id ="app">
		
		<div id="message" class='alert alert-danger collapse'><a href='#' id='linkclose' class='close'>&times;</a>
		   <p id="response"></p>
		</div>
		
	@if($post!='')
		<div class="row">
			<div class="col-md-8">
				<h1>{{$post->title}}</h1><hr/>
				<p class="lead">{{ $post->body }}</p>
				<hr>
				<div class="tags">					    
					    
					@if(!empty($post->tags))    
						@foreach($post->tags as $tag)
						  <span class="label label-default">{{ $tag->name }}</span>
						@endforeach
					@endif
					
				</div>

				<div id="backend comments" style="margin-top:30px;">
					<h3>Comments <small>({{$post->comments->count()}} total)</small></h3>

					@if($post->comments->count()>0)
					<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Comment</th>
								<th></th>
								<th></th>
							</tr>
						</thead>						
						<tbody>
						  <?php $comments = $post->comments()->paginate(3);?>
						  	  						  	
							  @foreach($comments as $comment)
								<tr id="{{$comment->id}}">
									<td>{{$comment->name}}</td>
									<td>{{$comment->email}}</td>
									<td>{{$comment->comment}}</td>
									<td>
									<a href="{{route('comments.edit',$comment->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>								
									</td>
									<td>
										<button id ="delete" class="btn btn-danger btn-block" data-token="{{ csrf_token() }}"
										data-id="{{$comment->id}}">Delete</button>	
	                                </td>
								</tr>
							 @endforeach									 
						</tbody>																		
					</table>
					<div class ="text-center">
						{!!$comments->links()!!}
					</div>						
					</div>
					
					@endif
				</div>

			</div>
			<div class="col-md-4">
				<div class="well">
					<dl class="dl-horizontal">
						<dt>Created At:</dt>
						<dd>{{date('j M, Y h:ia',strtotime($post->created_at))}}</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>Last Updated:</dt>
						<dd>{{date('j M, Y h:ia',strtotime($post->updated_at))}}</dd>
					</dl>

					<dl class="dl-horizontal">
						<dt>Category:</dt>
						@if(empty($post->category->name))
							<dd>None</dd>
						@else
							<dd>{{$post->category->name}}</dd>
						@endif
					</dl>

					<hr>
					<div class="row">

						<div class="col-sm-6">
							<br/>
							{!!Html::linkRoute('posts.edit','Edit',array($post->id),array('class'=>'btn btn-primary btn-block'))!!}		
						</div>
						<div class="col-sm-6">
							<br/>
							{!!Form::open(['route'=>['posts.destroy',$post->id],'method'=>'DELETE'])!!}
							
							{!!Form::submit('Delete',['class'=>'btn btn-danger btn-block'])!!}

							{!!Form::close()!!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{!!Html::linkRoute('posts.index','<<See all posts',[],array('class'=>'btn btn-default btn-block btn-h1-spacing'))!!}		
						</div>
					</div>
				</div>
			</div>
		</div>

	@else
		<h1>No post available</h1>
	@endif
</div>	
<script type="text/javascript">	
	
@endsection