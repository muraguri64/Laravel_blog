<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>'store']);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$post_id)
    {
        //use local timezone
        date_default_timezone_set('Africa/Nairobi');
        
        //validate data
        $this->validate($request,array(
            'name'         =>'required|max:255',
            'email'        =>'required|email|max:255',
            'comment'      =>'required|min:5|max:2000'

            ));

        $post = Post::find($post_id);

        $comment = new Comment;
        $comment->name=$request->name;
        $comment->email=$request->email;
        $comment->comment=$request->comment;
        $comment->approved =TRUE;
        
        $comment->post()->associate($post);

        $comment->save();

        //set flash data with success message
          Session::flash('success','This comment was successfully submitted!');
        //redirect with flash data to posts.show
          return redirect()->route('blog.single',$post->id);
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment =Comment::find($id);

        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment =Comment::find($id);

        $this->validate($request,array('comment'=>'required'));

        $comment->comment =$request->comment;
        $comment->save();

        //set flash data with success message
          Session::flash('success','This comment was successfully updated!');
        //redirect with flash data to posts.show
          return redirect()->route('posts.show',$comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $post_id =$comment->post->id;
        $comment->delete();

       
        //set flash data with success message
         // Session::flash('success','This comment was successfully deleted!');
        //redirect with flash data to posts.show
        // return redirect()->route('posts.show',$post_id);
        return response()->json([
               'success' => true
           ]);

    }

    public function delete($id){
      
         $comment =Comment::find($id);
         return view('comments.delete')->withComment($comment);

    } 
}
