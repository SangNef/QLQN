@extends('layout.main')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full max-w-lg">
            <div class="border-b border-gray-200 mb-4">
                <h1 class="text-3xl font-extrabold text-gray-800">Đổi Mật Khẩu</h1>
            </div>
            @if (session('success'))
                <div class="bg-green-200 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <div class="p-6">
                <form action="{{ route('account.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="opassword" class="block text-gray-700 text-sm font-medium mb-2">Mật khẩu cũ</label>
                        <input type="password" name="opassword" id="opassword"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out"
                            value="{{ old('opassword') }}" required>
                        @error('opassword')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="npassword" class="block text-gray-700 text-sm font-medium mb-2">Mật khẩu mới</label>
                        <input type="password" name="npassword" id="npassword"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out"
                            required>
                        @error('npassword')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <input type="password" name="cpassword" id="cpassword"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-150 ease-in-out"
                            required>
                        @error('cpassword')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="flex items-center bg-indigo-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                            <i class="fa-solid fa-check text-xl mr-2"></i>
                            Xác nhận
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
