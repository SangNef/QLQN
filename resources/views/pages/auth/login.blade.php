@extends('layout.auth')
@section('auth')
    <section class="relative">
        <div class="w-full min-h-screen">
            <img src="{{ asset('unnamed.jpg') }}" alt="banner" class="w-full max-h-screen">
        </div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="bg-white shadow-lg border border-black">
                <div class="flex gap-8 border-b border-black p-4">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="w-16 h-16">
                    <div>
                        <h3 class="text-blue-600 font-bold">BỆNH VIỆN QUÂN Y 354</h3>
                        <h3 class="text-red-600 font-bold mt-3">PHẦN MỀM QUẢN LÝ HẬU CẦN</h3>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="border-r border-black px-3 py-8">
                        <h3 class="font-bold text-red-500">Hỗ trợ kỹ thuật</h3>
                        <p>SĐT Trực ban: 0383065274</p>
                        <p>SĐT Trực kỹ thuật: 0383065274</p>
                        <p><i class="fa-solid fa-arrow-right-to-bracket rotate-90 text-green-500"></i> Tài liệu hướng dẫn sử
                            dụng</p>
                    </div>
                    <div class="px-3 py-4">
                        <h3 class="flex items-center text-red-500 font-bold">
                            <i class="fa-solid fa-circle-user text-2xl mr-2"></i>
                            Đồng chí nhập thông tin
                        </h3>

                        <form action="{{ route('postLogin') }}" method="post">
                            @csrf
                            @if (session('error'))
                                <div class="text-red-500 bg-red-200 p-2 mt-4">{{ session('error') }}</div>
                            @endif
                            <div class="flex flex-col">
                                <input type="text" name="username" id="username" placeholder="Tên đăng nhập"
                                    class="border border-black p-1 mt-4">
                                <input type="password" name="password" id="password" placeholder="Mật khẩu"
                                    class="border border-black p-1 mt-4">
                                <button type="submit" class="bg-blue-600 text-white p-2 mt-4">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
