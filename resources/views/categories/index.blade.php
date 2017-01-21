@extends('main')

@section('title','| All Categories')

@section('content')
	<div class="row">
		<div class="col-md-8">
		@if($categories!=='')
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<th>{{$category->id}}</th>
							<td>{{$category->name}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<h2>No Categories available</h2>
		@endif		
		</div><!--end of column md-8-->

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'categories.store','method'=>'POST']) !!}
				<h2>New Category</h2>
				{{Form::label('name','Name:')}}	
				 {{Form::text('name',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}
				 <br/>
				  {{Form::submit('Create New Category',array('class'=>'btn btn-primary btn-lg btn-block'))}}

				{!!Form::close()!!}
			</div>
		</div>
	</div>

@endsection