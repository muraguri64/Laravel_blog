<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class CategoryController extends Controller
{

    //protect this controller from unregisterd users.
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //contains a listing of all categories        
        $categories =Category::all();
        if($categories->isEmpty()){

           //display a view with no category results     
           return view('categories.index')->with('categories',''); 
        }
        else{
        //display form to create category with results 
        return view('categories.index')->with('categories',$categories);
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
        //store created categories
        //redirect to index

        //use local timezone
        date_default_timezone_set('Africa/Nairobi');
        
        //validate data
        $this->validate($request,array(
            'name'=>'required|max:255',            
            ));

        //store it
        $category =new Category;
        $category->name = $request->name;
        $category->save();

         //flash message session
        Session::flash('success','The Category was successfully saved!');
        //redirect to another page
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
