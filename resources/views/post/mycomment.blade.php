<x-app-layout>
  <x-slot name="header">  
    <h2 class="font-semibold text-gray-700 leading-tight">
      コメントした投稿の一覧
    </h2>    
    <x-message :message="session('message')" />   
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if(count($comments) == 0)
    <p class="mt-4">
      まだコメントしていません。
    </p>
    @else
    @foreach($comments->unique('post_id') as $comment)
    @php
      $post = $comment->post;
    @endphp
    <div class="mx-4 sm:p-8">
      <div class="mt-4">
        <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <div class="text-sm font-semibold flex pb-4 cursor-pointer">
              <a href="{{route('post.show', $post)}}">
              <p class="hover:underline">{{ $comment->created_at->format('Y/m/d') }}</p>
              </a>
            </div>
            <div class="flex">
              <div class="rounded-full w-12 h-12">
                <img src="{{asset('storage/avatar/'.($comment->user->avatar??'default.jpg'))}}">
              </div>
              <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left pt-4">
                  <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
              </h1>
            </div>
            <hr class="w-full border-yellow-400">
            <div class="mt-4 flex flex-row-reverse">
            @if ($post->comments->count())
            <span class="badge">
                返信 {{$post->comments->count()}}件
            </span>
            @else
            <span>コメントはまだありません。</span>
            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</x-app-layout>