   @extends('main')  
   @section('title','| Homepage')
   @section('content')
       <div class="row">
          <div class="col-md-12">         
              <div class="jumbotron">
                  <h1>Welcome to my blog!</h1>
                  <p>Thank you so much for visiting.Please read my popular posts</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Posts</a></p>
              </div>              
          </div>
       </div>
       <div class="row">
         <div class="col-md-8">
         
         @foreach($posts as $post)
           <div class="post">
             <h3>{{$post->title}}</h3>

             <p>{{substr($post->body,0,100)}} {{strlen($post->body)>100 ?"...":""}}</p>
             
             <a href="{{route('blog.single',$post->id)}}" class="btn btn-primary">Read More</a>             
           </div><!--end of post-->    
           <hr> 
           @endforeach

            </div>
         <div class="col-md-3 col-md-offset-1">
           <h2>sidebar</h2>
         </div>
       </div>
  @endsection

 