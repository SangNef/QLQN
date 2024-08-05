@extends('layout.main')
@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Thêm Mục</h1>
            <a href="{{ route('items.index') }}"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Danh Sách</a>
        </div>
        @if ($errors->any())
            <div class="bg-red-200 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('item.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div class="flex space-between w-full gap-4">
                    <div class="w-1/2">
                        <label for="user" class="block text-gray-600 font-medium mb-1">Người đăng ký</label>
                        <input type="text" name="user" id="user" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed" value="{{ session('user')->name }}" disabled>
                    </div>
                    <div class="w-1/2">
                        <label for="" class="block text-gray-600 font-medium mb-1">Phòng ban</label>
                        <input type="text" name="" id="" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed" disabled
                        value="{{ session('user')->department?->name }}">
                    </div>
                </div>
                <div>
                    <label for="name" class="block text-gray-600 font-medium mb-1">Tên</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" placeholder="Nhập tên">
                </div>
                <div>
                    <label for="type_1" class="block text-gray-600 font-medium mb-1">Phân loại 1</label>
                    <input type="number" name="type_1" id="type_1" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_2" class="block text-gray-600 font-medium mb-1">Phân loại 2</label>
                    <input type="number" name="type_2" id="type_2" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_3" class="block text-gray-600 font-medium mb-1">Phân loại 3</label>
                    <input type="number" name="type_3" id="type_3" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_4" class="block text-gray-600 font-medium mb-1">Phân loại 4</label>
                    <input type="number" name="type_4" id="type_4" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" placeholder="Số lượng">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm Mục</button>
                </div>
            </div>
        </form>
    </div>
@endsection
