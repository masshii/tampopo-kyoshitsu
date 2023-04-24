<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-gray-800 leading-tight">
      お知らせ
    </h2>
    <x-message :message="session('message')" />    
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <div class="px-10 mt-4">
        <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
          <div class="mt-4">
            <div class="text-sm font-semibold text-center">
              <p>{{ $post->created_at->format('Y/m/d') }}
              </p>
            </div>
            <div class="text-center py-5">
              <span class="text-xs font-semibold bg-pink-500 text-white py-1 px-3 rounded-2xl">お知らせ</span>
            </div>
            <h1 class="text-lg text-gray-700 font-semibold text-center">
              {{ $post->title }}
            </h1>
            <div class="py-5">
              @if($post->image)
                <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px">
              @endif
            </div>
            <p class="mt-4 text-gray-600 py-4">{{ $post->body }}</p>

            <span class="flex">
              <img src="{{asset('logo/heart.png')}}" class="w-10">
              @if($nice)
                <x-primary-button class="bg-green-400 ml-2">
                <a href="{{ route('unnice', $post) }}">
                  いいね
                  <span>
                    {{ $post->nices->count() }}
                  </span>
                </a>
                </x-primary-button>
              @else
                <x-primary-button class="ml-2">
                <a href="{{ route('nice', $post) }}">
                  いいね
                  <span>
                    {{ $post->nices->count() }}
                  </span>
                </a>
                </x-primary-button>
              @endif 
            </span>

            @can('admin')
            <div class="flex justify-end mb-4">
              <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-teal-700 float-right">編集</x-primary-button></a>
              <form method="post" action="{{route('post.destroy', $post)}}">
                @csrf
                @method('delete')
                <x-primary-button class="bg-red-700 float-right ml-4" onclick="return confirm('本当に削除しますか？');">削除</x-primary-button>
              </form>
            </div>
            @endcan
          </div>
        </div>
        @foreach($post->comments as $comment)
        <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-8">
          {{ $comment->body }}
          <div class="text-sm font-semibold flex flex-row-reverse">
            <p class="float-left pt-4">{{ $comment->user->name??'削除されたユーザー' }} ● {{ $comment->created_at->diffForHumans() }}</p>
            <span class="rounded-full w-12 h-12">
              <img src="{{asset('storage/avatar/'.($comment->user->avatar??'default.jpg'))}}">
            </span>
          </div>
        </div>
        @endforeach
        <div class="mt-4 mb-12">
          <form method="post" action="{{route('comment.store')}}">
            @csrf
            <input type="hidden" name='post_id' value="{{ $post->id }}">
            <textarea name="body" class="bg-white w-full rounded-2xl px-4 mt-4 py-4 sahdow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください" autofocus>{{old('body')}}</textarea>
            <x-primary-button class="float-right mr-4 mb-12">コメントする</x-primary-button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>