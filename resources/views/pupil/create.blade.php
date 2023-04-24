<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-gray-700 leading-tight">
      生徒登録
    </h2>
    <x-input-error class="mb-4" :messages="$errors->all()" />

    <x-message :message="session('message')" />
  </x-slot>

  <div class="font-sans text-gray-900 antialiased">
    <div class="w-full md:w-1/2 mx-auto p-6">
      <form method="POST" action="{{ route('pupil.store') }}" enctype="multipart/form-data">
      @csrf
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus/>
        </div>

        <div class="mt-4">
          <x-input-label for="sex" :value="__('性別')" />
          <div class="mt-1">
            <input id="sex" type="radio" name="sex" value=1 checked>
            <label for="sex" class="font-medium text-sm text-gray-700 ml-1">男性</label>
            <input id="sex" type="radio" class="ml-5" name="sex" value=2>
            <label for="sex" class="font-medium text-sm text-gray-700 ml-1">女性</label>
          </div>
        </div>

        <div class="mt-4">
          <x-input-label for="birthday" :value="__('生年月日')" />
          <input id="birthday" type="date" class="mt-1" name="birthday" value="{{old('birthday')}}">
        </div>

        <div class="mt-4">
          <x-input-label for="skill" :value="__('級・段位')" />
          <input id="skill" type="text" name="skill" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 mt-1 rounded-md shadow-sm" id="skill" value="{{old('skill')}}">
        </div>

        <div class="mt-4">
          <x-input-label for="note" :value="__('メモ')" />

          <textarea name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 mt-1 rounded-md shadow-sm w-6/12" id="note" cols="30" rows="5">{{old('note')}}</textarea>
        </div>

        <div class="flex items-center justify-end mt-4">
          <x-primary-button class="ml-4">
              {{ __('送信する') }}
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>