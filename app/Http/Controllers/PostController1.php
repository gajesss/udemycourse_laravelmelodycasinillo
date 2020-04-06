<?php

namespace App\Http\Controllers;
use App\BlogPost;
use App\Http\Requests\StorePost;

use Illuminate\Http\Request;

class PostController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index',['posts'=>BlogPost::all()]);
    }

    public function create()
    {
        return view('posts.create');
    }

    
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $blogPost =  BlogPost::create($validatedData);
        $request->session()->flash('status','Blog post was created');
        return redirect()->route('posts.show',['post'=>$blogPost->id]);
    }

     public function show(Request $request, $id)
     {
         return view('posts.show',['post'=>BlogPost::FindOrFail($id)]);
         //$request->session()->reflash;
         
     }

     public function edit($id)
     {
         $post=BlogPost::findOrFail($id); 
        return view('posts.edit');
     }
     public function update()
     { 
       
     }
   
   
}
