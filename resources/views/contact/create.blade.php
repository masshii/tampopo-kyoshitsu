<x-guest-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-yellow-50 h-screen">
    <div class="mx-4 sm:p-8">
      <h1 class="font-semibold text-gray-700 text-lg hover:underline">
        お問い合わせ
      </h1>
      
      <x-input-error class="mb-4" :messages="$errors->all()" />

      <x-message :message="session('message')" />

      <form method="post" action="{{route('contact.store')}}" enctype="multipart/form-data">
      @csrf
        <div class="md:flex items-center mt-8">
          <div class="w-full flex flex-col">
            <x-input-label for="title" :value="__('件名')" />
              <input type="text" name="title" class="w-auto py-2 my-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="Enter Title" autofocus>
          </div>
        </div>

        <div class="w-full flex flex-col">
          <x-input-label for="body" :value="__('本文')" />
          <textarea name="body" class="w-auto py-2 my-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body')}}</textarea>
        </div>

        <div class="md:flex items-center">
          <div class="w-full flex flex-col">
            <x-input-label for="email" :value="__('メールアドレス')" />
              <input type="text" name="email" class="w-auto py-2 mt-2 placeholder-gray-300 border border-gray-300 rounded-md" id="email" value="{{old('email')}}" placeholder="Enter Email">
          </div>
        </div>
        <x-primary-button class="mt-4">
          送信する
        </x-primary-button>
      </form>
    </div>
  </div>
</x-guest-layout>