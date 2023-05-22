<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\category;
use App\Models\Image;
use App\Models\like;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  $posts=Post::with('image')->paginate(20);
        $categories=category::all();
     return view('posts',compact('posts','categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=category::all();
        return view('controlViews.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $image=new Image();
        $image->image=$request->validated('image')->store('posts_images','public');

        if(auth()->user()){

            auth()->user()->posts()->create([
                'title'=>$request->validated('title'),
                'body'=>$request->validated('body'),
                'category_id'=>$request->validated('category_id'),

            ])->image()->save($image);

        }
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        $categories=category::all();
  return view('postDetails',compact('post','categories'));
    }

    public function make_comment(Request $request,$id){
       $request->validate([
           'comment'=>'required'
       ]);
        if (Auth::check()) {
            post::find($id)->comments()->create([
             'text'=>Request('comment'),
                'user_id'=>auth()->user()->getAuthIdentifier(),
            ]);

        }
        return redirect('/');

    }
public function addLike($id){

        if(auth()->check()){

            if(! like::where('user_id',Auth::id())->where('post_id',$id)->exists())
            {
                Post::find($id)->likes()->create(['user_id'=>Auth::id()]);
            }
                            }
      return redirect('/');

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
