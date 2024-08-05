@extends('layout.main')
@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <!-- Your existing content here -->
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Báo Cáo Buồng Tự Nguyện</h1>
            @if (session('user')->role == 'user')
                <a href="{{ route('suggestion.create') }}"
                    class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm
                    Yêu Cầu</a>
            @endif
        </div>
        <div class="max-w-xl">
            <div class="mb-4">
                <label for="user" class="block text-gray-600 font-medium mb-1">Người đăng ký</label>
                <input type="text"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                    value="{{ session('user')->username }}" disabled>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-600 font-medium mb-1">Khoa</label>
                <input type="text" name="date" id="status"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                    value="{{ session('user')->department?->name }}" disabled>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-600 font-medium mb-1">Ngày đăng ký</label>
                <input type="text" name="date" id="status"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                    disabled value="{{ date('d/m/Y') }}">
            </div>
        </div>
    </div>
@endsection
