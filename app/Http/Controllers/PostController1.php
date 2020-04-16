<?php

namespace App\Http\Controllers;
use App\BlogPost;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



// [
//     'show' => 'view',
//     'create' => 'create',
//     'store' => 'create',
//     'edit' => 'update',
//     'update' => 'update',
//     'destroy' => 'delete',
// ]
class PostController1 extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  DB::connection()->enableQueryLog();
      //  $posts=BlogPost::with('comments')->get();
      //  foreach ($posts as $post){
      //      foreach($post->comments as $comment){
        //        echo $comment->content;
       //     }
       // }
        //dd(DB::getQueryLog());
        return view(
            'posts.index',
            [
                'posts' => BlogPost::latest()->withCount('comments')->get(),
                'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    
    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        $blogPost =  BlogPost::create($validatedData);
        $request->session()->flash('status','Blog post was created');
        return redirect()->route('posts.show',['post'=>$blogPost->id]);
    
    }

     public function show( $id)
     {
         // return view('posts.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id),
        // ]);
         return view('posts.show',['post'=>BlogPost::with('comments')->FindOrFail($id,)]);
         //$request->session()->reflash;
         
     }

     public function edit($id)
     {
         $post=BlogPost::findOrFail($id); 
         //if (Gate::denies('update-post',$post)){
        //    abort(403, 'you cant edit po sorry');
       // }
      // $this->authorize('posts.update', $post);
      $this->authorize($post);

        return view('posts.edit',['post'=>$post]);
     }
     public function update(StorePost $request, $id)
     { 
        
        $post = BlogPost::findOrFail($id);

       
        
        // if (Gate::denies('update-post', $post)) {
        //     abort(403, "You can't edit this blog post!");
        // }
       // $this->authorize('posts.update', $post);
       $this->authorize($post);

        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();
        $request->session()->flash('status', 'Blog post was updated!');
        return redirect()->route('posts.show', ['post' => $post->id]);
       
     }
     public function destroy(Request $request,$id)
     {
        $post=BlogPost::findOrFail($id); 
        //$this->authorize('posts.delete', $post);
        $this->authorize($post);

        $post->delete();
        $request->session()->flash('status','Blog post was deleted');
        return redirect()->route('posts.index');
        $post->save();
     }
   
   
}
