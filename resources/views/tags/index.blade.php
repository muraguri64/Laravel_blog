@extends('main')

@section('title','| All Tags')

@section('scripts')
<script type="text/javascript">	
	$(document).ready(function(){
		$("form#ajax").submit(function(){
			var url = $(this).attr('action');
			var type = $(this).attr('method');
			var data = {};

			var button     = $(this).find('input[type="submit"], button');
			var button_val = $(this).find('input[type="submit"], button').val();
			button.attr('disabled','disabled').val('Submitting...');

			$(this).find('[name]').each(function(index,value){
				 var name = $(this).attr('name');
				 var value = $(this).val();

				 data[name] = value ;

			});
			var dialog = bootbox.dialog({
			    message: '<p class="text-center"><i class="fa fa-spin fa-spinner"></i> Adding Tag...</p>',
			    closeButton: false
			});


			$.ajax({

     		       type:type,
     		       url: url,
     		       cache: false,
     		       data: data,
     		       dataType: "JSON",
     		       success:function(data)
     		       {
     		       	  
     		       	  if(data.success){     
     		       	  button.removeAttr('disabled').val(button_val);

     		       	  	dialog.modal('hide');
     		       	  	$("div.table-responsive").replaceWith(data.view);
     		       	  	bootbox.dialog({ message: "<div class='text-center' style='color:#006400;'>"+
     		       	  		"<i class='fa fa-check' aria-hidden='true'></i> Tag added succesfully</div>" });


     		       	  }     		       	  
     		           
     		       },
     		       error: function(xhr, status, error)
     		       {
     		       	   if(xhr.status == 422){
     		       	   		button.removeAttr('disabled').val(button_val);
     		       	   		dialog.modal('hide');
     		       	   		var responses = xhr.responseJSON;
     		       	   		
     		       	   		//empty array for items
     		       	   		var items = "<p><strong><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Error:</strong></p>";

     		       	   		for(x in responses){

     		       	   			items += '"' + responses[x] + '"' + "<br>" 
     		       	   			console.log(responses[x]);
     		       	   		}


     		       	   		bootbox.dialog({ message: "<div style='color:red;'>" + items + "</div>" });
     		       	   		

     		       	   		
     		       	   		   	
     		       	   }    		    
     		       	   else{
     		       	   	button.removeAttr('disabled').val(button_val);
     		       	   	dialog.modal('hide');	
     		       	   	console.log(xhr);
     		       	   	bootbox.dialog({ message: "<div class='text-center' style='color:red;'>" + 
     		       	   		"<i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Error Ocurred</div>" });
     		       	   }   	  
     		       	 
     		       	  	 		       	   
     		       	              
     		       }
     		   });

		    return false;
		});
		
	});
</script>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
		@if($tags!=='')
			<h1>Tags</h1>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($tags as $tag)
							<tr>
								<th>{{$tag->id}}</th>
								<td>{{$tag->name}}</td>
								<td><a href="{{route('tags.show',$tag->id)}}" class="btn btn-default btn-sm">View</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class ="text-center">
					{!!$tags->links()!!}
				</div>
			</div>
		@else
			<h2>No Categories available</h2>
		@endif		
		</div><!--end of column md-8-->

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'tags.store','method'=>'POST','id'=>'ajax']) !!}
				<h2>New Tag</h2>
				{{Form::label('name','Name:')}}	
				 {{Form::text('name',null,array('class'=>'form-control','maxlength'=>'255'))}}
				 <br/>

				 <div id ="submit">	
				  {{Form::submit('Create New Tag',array('class'=>'btn btn-primary btn-lg btn-block'))}}
				  	
				 <div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>

@endsection