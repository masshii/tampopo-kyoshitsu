<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Nice;

class NiceController extends Controller
{
    public function nice(Post $post)
    {
        $nice = new Nice();
        $nice->post_id = $post->id;
        $nice->user_id = auth()->user()->id;
        $nice->save();

        return back();
    }

    public function unnice(Post $post)
    {
        $user = auth()->user()->id;
        $nice = Nice::where('post_id', $post->id)->where('user_id', $user)->first();
        $nice->delete();

        return back();
    }
}
