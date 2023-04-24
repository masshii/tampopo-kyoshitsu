<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-gray-700 leading-tight">
      お知らせ作成
    </h2>
    <x-validation-errors class="mb-4" :messages="$errors->all()" />
      
    <x-message :message="session('message')" />    
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mx-4 sm:p-8">
      <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
      @csrf  
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
          <x-input-label for="title" :value="__('タイトル')" />
          <input type="text" name="title" class="w-auto py-2 my-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="Enter Title" autofocus>
          </div>
        </div>

        <div class="w-full flex flex-col">
          <x-input-label for="body" :value="__('本文')" />
          <textarea name="body" class="w-auto py-2 mt-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body')}}</textarea>
        </div>

        <div class="w-full flex flex-col">
          <x-input-label for="image" :value="__('画像（1MBまで）')" class="my-2" />
          <div>
          <input id="image" type="file" name="image">
          </div>
        </div>

        <div class="mt-4 mb-2">
          <input id="emailed" value="1" type="checkbox" name="emailed" class="mr-2" @if (old('emailed') == 1) checked @endif>
          <label for="emailed" class="font-medium text-sm text-gray-700">メール送信</label>
        </div>

        <x-primary-button class="mt-4">
          送信する
        </x-primary-button>
          
      </form>
    </div>
  </div>
</x-app-layout>