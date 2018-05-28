<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class WallController extends Controller
{
    public function read(){
      $posts = Post::all();
      return view('read', ['posts' => $posts]);
    }

    public function write(Request $request){
      $post = new Post;
      $post->content = $request->post_content;
      $post->author = \Auth::id();
      $post->save();

      return redirect()->route('wall');
    }
}
