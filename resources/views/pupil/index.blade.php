<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-gray-700 leading-tight">
      生徒一覧
    </h2>
    <x-message :message="session('message')" />
  </x-slot>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="my-6">
      <table class="w-full border-collapse mt-8"> 
        <tr class="bg-yellow-400">
          <th class="p-3 text-left text-white">名前</th>
          <th class="p-2 text-left text-white">性別</th>
          <th class="p-3 text-left text-white">生年月日</th>
          <th class="p-2 text-left text-white">級・段位</th>
          <th class="p-3 text-left text-white">メモ</th>
          <th class="p-2 text-center text-white">編集</th>
          <th class="p-2 text-center text-white">削除</th>
        </tr>
        @foreach($pupils as $pupil) 
        <tr class="bg-white">
          <td class="border-gray-light border hover:bg-gray-100 text-left p-3">{{$pupil->name}}</td>
          <td class="border-gray-light border hover:bg-gray-100 text-left p-2">
            @if($pupil->sex==1)
              男性 
            @else 
              女性
            @endif
          </td>
          <td class="border-gray-light border hover:bg-gray-100 text-left p-3">{{$pupil->birthday}}</td>
          <td class="border-gray-light border hover:bg-gray-100 text-left p-2">{{$pupil->skill}}</td>
          <td class="border-gray-light border hover:bg-gray-100 text-left p-3">{{$pupil->note}}</td>
          <td class="border-gray-light border hover:bg-gray-100 text-center p-2">
            <a href="{{route('pupil.edit', $pupil)}}"><x-primary-button class="bg-teal-700">編集</x-primary-button></a>
          </td>
          <td class="border-gray-light border hover:bg-gray-100 text-center p-2">
            <form method="post" action="{{route('pupil.destroy', $pupil)}}">
              @csrf
              @method('delete')
              <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
            </form>
            </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>

  {{ $pupils->links('vendor.pagination.tailwind2') }}

</x-app-layout>