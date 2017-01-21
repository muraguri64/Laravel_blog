@extends('main')
@section('title','| Edit post')

@section('stylesheet')
<link href="/css/Select2.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".select2-multi").select2();
	 	$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds())!!}).trigger("change");
});
	 		
</script>
@endsection

@section('content')
	@if($post!='')
		<div class="row">
		{!!Form::model($post,['route'=>['posts.update',$post->id],'method'=>'PUT','files'=>TRUE])!!}
			<div class="col-md-8">
				{{Form::label('title','Title:')}}
				{{Form::text('title',null,["class"=>'form-control input-lg'])}}

					<br/>
				{{Form::label('image','Upload Featured Image:')}}
				{{Form::file('image')}}


				{{Form::label('body',"Body:",['class'=>'form-spacing-top'])}}
				{{Form::textarea('body',null,['class'=>'form-control'])}}

				 {{Form::label('category_id','Category:')}}
				 {{Form::select('category_id',$cats,null,['class'=>'form-control'])}}


				 {{Form::label('tags','Tags:')}}
				 {{Form::select('tags[]',$tags,null,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}
				<br/>
				<br/>
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

					<hr>
					<div class="row">

						<div class="col-sm-6">
							<br/>
							{!!Html::linkRoute('posts.show','Cancel',array($post->id),array('class'=>'btn btn-danger btn-block'))!!}		
						</div>
						<div class="col-sm-6">
							<br/>
							{{Form::submit('save changes',array('class'=>'btn btn-success btn-block'))}}
							
						</div>
					</div>
				</div>
			</div>
			{!!Form::close()!!}
		</div><!--End of .row form-->

	@else
		<h1>No post available</h1>
	@endif
@stop
