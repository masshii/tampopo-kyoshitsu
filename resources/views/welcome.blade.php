<x-guest-layout>
    <div class="h-screen pb-14 bg-right bg-cover">
    <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
        
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
            <h1 class="my-4 text-3xl md:text-5xl text-yellow-500 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">
                たんぽぽ書道教室
            </h1>

            <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                
            </p>
        
            <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
                会員募集中!!
            </p>

            <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
                <a href="{{route('login')}}">
                    <x-primary-button class="btnsetg">ログイン</x-primary-button>
                </a>
                <a href="{{route('register')}}">
                    <x-primary-button class="btnsetr">ご登録はこちら</x-primary-button>
                </a>
            </div>
            <div class="text-center pt-14">
                <a href="{{route('contact.create')}}" class="font-bold text-gray-700 pt-8 lg:pt-6 text-center hover:underline">
                    お問い合わせ
                </a>
            </div>
        </div>
        
        <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
            <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/tampopo.jpg')}}">
        </div>
    </div>
    <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        
        
        <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
            <p class="text-gray-500 text-center">&copy; 2023 たんぽぽ書道教室</p>
        </div>
    </div>
</div>
</x-guest-layout>