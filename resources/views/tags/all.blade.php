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