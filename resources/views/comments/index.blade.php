<tbody>
@foreach($comments as $comment)
	<tr>
		<td>{{$comment->name}}</td>
		<td>{{$comment->email}}</td>
		<td>{{$comment->comment}}</td>
		<td>
		<a href="{{route('comments.edit',$comment->id)}}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>								
		</td>
		<td>
			<button id ="mybtn" class="btn btn-danger btn-block" data-token="{{ csrf_token() }}"
			data-id="{{$comment->id}}">Delete</button>	
        </td>
	</tr>
@endforeach
</tbody>
