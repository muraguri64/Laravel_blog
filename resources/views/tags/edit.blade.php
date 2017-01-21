@extends('main')

@section('title',"| Edit $tag->name")

@section('content')
<div class="row">

{!!Form::model($tag,['route'=>['tags.update',$tag->id],'method'=>'PUT'])!!}
				
				{{Form::label('name','Name:')}}
				{{Form::text('name',null,["class"=>'form-control input-lg'])}}
				<br>
				{{Form::submit('save changes',array('class'=>'btn btn-success btn-block'))}}
{!!Form::close()!!}

</div><!--end of row tag-->
@endsection