<x-app-layout>
  <x-slot name="header">    
    <h2 class="font-semibold text-gray-700 leading-tight">
      お知らせ一覧
    </h2>
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @foreach($posts as $post)
      <div class="mx-4 sm:p-8">
        <div class="mt-4">
          <div class="bg-white w-full rounded-2xl px-8 py-4 shadow-lg hover:shadow-2xl transition duration-500">
            <div class="mt-4">
              <div class="text-sm font-semibold pb-4 cursor-pointer">
                @if($reads->where('post_id', $post->id)->count() >0)
                <a href="{{route('post.show', $post)}}">
                <span class="text-gray-500  hover:underline">{{ $post->created_at->format('Y/m/d') }}</span>
                <span class="text-xs font-semibold bg-pink-500 text-white ml-4 py-1 px-3 rounded-2xl">お知らせ</span>
                </a>
                @else
                <a href="{{route('post.show', $post)}}">
                <span class="text-gray-900  hover:underline">{{ $post->created_at->format('Y/m/d') }}</span>
                <span class="text-xs font-semibold bg-pink-500 text-white ml-4 py-1 px-3 rounded-2xl">お知らせ</span>
                </a>
                @endif
              </div>
              @if($reads->where('post_id', $post->id)->count() >0)  
              <h1 class="text-lg text-gray-500 font-semibold hover:underline cursor-pointer">
                <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
              @else
              <h1 class="text-lg text-gray-900 font-semibold hover:underline cursor-pointer">
                <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
              @endif
                <hr class="w-full border-yellow-400">
              </h1>
              <div class="mt-4 flex flex-row-reverse">
                @if($post->comments->count())      
                  <span class="badge">
                    返信{{ $post->comments->count() }}件
                  </span>
                @else
                <span>コメントはまだありません</span> 
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach  
  </div>

  {{ $posts->links('vendor.pagination.tailwind2') }}
  
</x-app-layout>