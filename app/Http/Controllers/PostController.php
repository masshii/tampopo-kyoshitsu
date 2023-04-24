<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Nice;
use App\Models\Read;
use App\Models\User;
use App\Mail\PostForm;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $user = auth()->user();
        $reads = Read::where('user_id', auth()->user()->id)->get();
        $posts = Post::paginate(5);

        return view('post.index', compact('posts', 'user', 'reads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('admin');

        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        if (request('image')) {
            $name = request()->file('image')->getClientOriginalName();
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        if ($request->emailed == '1') {
            $post->emailed = 1;
            $title = $post->title;
            $emails = User::pluck('email');
            // dd($emails->toArray());
            Mail::to(config('mail.admin'))->bcc($emails->toArray())->send(new PostForm($title));
        }

        $post->save();

        return redirect()->route('post.create')->with('message', 'お知らせを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $nice = Nice::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();

        $read = Read::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();

        if (!$read) {
            $read = new Read();
            $read->post_id = $post->id;
            $read->user_id = auth()->user()->id;
            $read->save();
        }

        return view('post.show', compact('post', 'nice', 'read'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('admin');

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->body = $request->body;

        if (request('image')) {
            $name = request()->file('image')->getClientOriginalName();
            request()->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.show', $post)->with('message', 'お知らせを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();

        return redirect()->route('post.index')->with('message', 'お知らせを削除しました');
    }

    public function mycomment()
    {
        $user = auth()->user()->id;
        $comments = Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();

        return view('post.mycomment', compact('comments'));
    }
}
