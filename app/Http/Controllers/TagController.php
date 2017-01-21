<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use App\Post;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::paginate(5);

        if($tags->isEmpty()){
            return view('tags.index')->withTags('');
        }
        else{
            return view('tags.index')->withTags($tags);
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax())
        {
            //validate the incoming request
            $this->validate($request,array('name'=>'required|max:255','click'=>'required'));

            //create a new instance of tag
            $tag=new Tag;
            $tag->name=$request->name;
            $tag->save();

            $tags=Tag::paginate(5);

            //success message on creation of tag
            //Session::flash('success','The Tag was successfully created!');
            //return redirect()->route('tags.index');

            $view = view('tags.all')->withTags($tags)->render();
            return response()->json([
                   'success' => true,
                   'view'    => $view                  
               ]);

        }
       else{
         echo "Not an ajax request";
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find tag by id
        $tag =Tag::find($id);
         return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find tag by id
         $tag =Tag::find($id);
         return view('tags.edit')->withTag($tag);
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
        //find the tag by id
        $tag= Tag::find($id);

         //validate the incoming request
        $this->validate($request,array('name'=>'required|max:255'));
        $tag->name =$request->name;

        //save the update
        $tag->save();

        //success message on creation of tag
        Session::flash('success','The Tag was successfully updated!');
        return redirect()->route('tags.show',$tag->id);
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
        $tag =Tag::find($id);

        //detach all relationship before deleting
        $tag->posts()->detach();

        //delete the post
         $tag->delete();

        //success message on deletion of tag
        Session::flash('success','The Tag was successfully deleted!');

        return response()->json([
               'success' => 'tag has been deleted successfully!'
           ]);
    }
}
