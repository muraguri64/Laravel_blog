<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Session;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
           //create a variable that will store all posts from the database with pagination
           $posts = Post::paginate(10);

           //return a view and pass in the above variables
           return view('posts.index')->with('posts',$posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =Category::all();
        $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //use local timezone
        date_default_timezone_set('Africa/Nairobi');
        
        //validate data
        $this->validate($request,array(
            'title'       =>'required|max:255',
            'body'        =>'required',
            'category_id' =>'required|integer',
            'image'       =>'sometimes|image'
            ));
            

        //store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->body  = $request->body;
        $post->category_id =$request->category_id;


        //save our image
        if($request->hasFile('image')){

             $image =$request->file('image');
             $filename =time().'.'.$image->getClientOriginalExtension();
             $location =public_path('img/uploads/'.$filename);
             Image::make($image)->resize(800, 400)->save($location);

             $post->image =$filename;
        }

        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags,FALSE);
        }

        

        //flash message session
        Session::flash('success','The blog post was successfully saved!');
        //redirect to another page
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        date_default_timezone_set('Africa/Nairobi');
        $post = Post::find($id);

        return view('posts.show')->with('post',$post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a variable
        $post =Post::find($id);

        $cats=[];
        //find all categories
        $categories =Category::all();
        
        foreach($categories as $category){
            
          $cats[strval($category->id)] = $category->name;
        }
        
        $tags =Tag::all();
        $tags2=[];

        foreach($tags as $tag){
            $tags2[$tag->id]=$tag->name;

        }

        //return a view and pass the variable we created
        return view('posts.edit')->with('post',$post)->withCats($cats)->withTags($tags2);
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
         //use local timezone
         date_default_timezone_set('Africa/Nairobi');
        //validate the data
          $this->validate($request,array(
            'title'      =>'required|max:255',
            'body'       =>'required',
            'category_id'=>'required|integer',
            'image'      =>'image' 

            ));

        //Resave the data to the database
          $post =Post::find($id);     
          $post->title       =$request->title;
          $post->body        =$request->body;
          $post->category_id =$request->category_id;

          if($request->hasFile('image'))
          {
               //add new photo 
               $image =$request->file('image');
               $filename =time().'.'.$image->getClientOriginalExtension();
               $location =public_path('img/uploads/'.$filename);
               Image::make($image)->resize(800, 400)->save($location);

               $originalPhoto =$post->image;
               
               //update the database
               $post->image =$filename;

               //delete the oldfile
               Storage::delete('uploads/'.$originalPhoto);
          }

          $post->save();
        
          if(isset($request->tags)){
            $post->tags()->sync($request->tags,TRUE);
        }
        else{
            $post->tags()->sync(array(),TRUE);   
        }

        //set flash data with success message
          Session::flash('success','This post was successfully Updated!');
        //redirect with flash data to posts.show
          return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the post in the database
        $post =Post::find($id);

        //detach all relationship before deleting
        $post->tags()->detach();

        //delete the oldfile
        Storage::delete('uploads/'.$post->image);

        //delete the post
        $post->delete();

        //show flash message and redirect
        Session::flash('success','The post was successfully Deleted!');
        return redirect()->route('posts.index');
    }
}
