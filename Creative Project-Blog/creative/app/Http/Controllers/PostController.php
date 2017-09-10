<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //store all the posts distract from the database
        //$posts = Post::all();//get all the posts form post table
        $posts = Post::orderBy('created_at', 'desc')->get();
        //return $posts;
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
    }
  public function newcreate()
    {
        $categories = Category::all();
        return view('posts.newcreate')->withCategories($categories);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'heading'=>'required|max:255',
            'category_id' => 'required|integer',
            'content'=>'required'
            
            ));

        //store in the database
        $post = new Post;
        $post->heading = $request->heading;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id();
        $post->writer = Auth::user()->name;
        $post->save();

        Session::flash('Success','The post blog has saved.');
        //redirect to another page
        return redirect()->route('posts.show', $post->id);
        //posts.show is the route name, action is go to PostController@show
        //url is posts/{posts} id number is the second parameter.
    } 

       public function newstore(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'heading'=>'required|max:255',
            'content'=>'required'
            ));

        //store in the database
        $post = new Post;
        $post->heading = $request->heading;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->writer = 'anonymous';
        $post->save();

        Session::flash('Success','The post blog has saved.');
        //redirect to another page
        //
        return redirect()->route('posts.show', $post->id);
        //return redirect()->route('posts.show', $post->id);
        //posts.show is the route name, action is go to PostController@show
        //url is posts/{posts} id number is the second parameter.
    } 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);//find primary id
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post
        $post = Post::find($id);
        $categories = Category::all();
        $temp = array();
        foreach ($categories as $category) {
        $temp[$category->id] = $category->name;
        }
        return view('posts.edit')->withPost($post)->withCategories($temp);
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
        //validate ->save ->redirect to posts.show
        $this->validate($request, array(
            'heading'=>'required|max:255',
            'category_id' => 'required|integer',
            'content'=>'required'
            ));

        $post = Post::find($id);
        $post->heading = $request->input('heading');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category_id');
        $post->save();

        Session::flash('Success','The post blog has saved.');

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
        $post = Post::find($id);
        $post->delete();
        Session::flash('Success','The post blog has deleted.');
        return redirect()->route('posts.index');
    }
}
