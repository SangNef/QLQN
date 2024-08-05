@extends('layout.auth')

@section('auth')
<section class="relative">
    <div class="w-full min-h-screen">
        <img src="{{ asset('unnamed.jpg') }}" alt="banner" class="w-full max-h-screen object-cover">
    </div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg border border-gray-300">
        <div class="flex gap-4 border-b border-gray-300 pb-4 mb-4">
            <img src="{{ asset('logo.png') }}" alt="logo" class="w-16 h-16">
            <div>
                <h3 class="text-blue-600 font-bold text-xl">BỆNH VIỆN QUÂN Y 354</h3>
                <h3 class="text-red-600 font-bold mt-2 text-lg">PHẦN MỀM QUẢN LÝ HẬU CẦN</h3>
            </div>
        </div>
        <div class="flex">
            <div class="border-r border-gray-300 pr-4 mr-4 pt-6">
                <h3 class="font-bold text-red-500 mb-2">Hỗ trợ kỹ thuật</h3>
                <p class="text-sm">SĐT Trực ban: 0383065274</p>
                <p class="text-sm">SĐT Trực kỹ thuật: 0383065274</p>
                <p class="text-sm flex items-center gap-1 mt-2">
                    <i class="fa-solid fa-arrow-right-to-bracket rotate-90 text-green-500"></i>
                    Tài liệu hướng dẫn sử dụng
                </p>
            </div>
            <div class="flex-1">
                <h3 class="flex items-center text-red-500 font-bold text-lg mb-4">
                    <i class="fa-solid fa-circle-user text-2xl mr-2"></i>
                    Đồng chí nhập thông tin
                </h3>

                <form action="{{ route('postLogin') }}" method="post">
                    @csrf
                    @if (session('error'))
                        <div class="text-red-500 bg-red-200 p-2 rounded mb-4">{{ session('error') }}</div>
                    @endif
                    <div class="flex flex-col gap-4">
                        <input type="text" name="username" id="username" placeholder="Tên đăng nhập"
                            class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="password" name="password" id="password" placeholder="Mật khẩu"
                            class="border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg mt-4 hover:bg-blue-700 transition">
                            Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
