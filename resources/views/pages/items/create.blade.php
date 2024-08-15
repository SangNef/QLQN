@extends('layout.main')
@section('content')
    <div class="container mx-8 p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Thêm Vật chất
                @if ($defaultType == 'doanh-trai')
                    Doanh trại
                @elseif ($defaultType == 'quan-nhu')
                    Quân nhu
                @elseif ($defaultType == 'xang-xe')
                    Xăng xe
                @elseif ($defaultType == 'quan-y')
                    Quân y
                @endif
                @if ($defaultStatus == 'co-dinh')
                    cố định
                @elseif ($defaultStatus == 'cap-phat')
                    cấp phát
                @endif
            </h1>
            {{-- <a href="{{ route('items.index') }}"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Danh Sách</a> --}}
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
                        <input type="text" name="user" id="user"
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                            value="{{ session('user')->name }}" disabled>
                    </div>
                    <div class="w-1/2">
                        <label for="department" class="block text-gray-600 font-medium mb-1">Phòng ban</label>
                        <input type="text" name="department" id="department"
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                            disabled value="{{ session('user')->department?->name }}">
                    </div>
                </div>
                <div>
                    <label for="date" class="block text-gray-600 font-medium mb-1">Ngày</label>
                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100">
                </div>
                <div>
                    <label for="name" class="block text-gray-600 font-medium mb-1">Tên</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100"
                        placeholder="Nhập tên">
                </div>
                <input type="hidden" name="type" value="{{ $defaultType }}">
                <input type="hidden" name="status" value="{{ $defaultStatus }}">
                <div class="flex justify-between gap-4">
                    <div class="w-full">
                        <label for="type" class="block text-gray-600 font-medium mb-1">Phân loại</label>
                        <select name="type" id="type" disabled
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100">
                            <option value="doanh-trai" @if ($defaultType == 'doanh-trai') selected @endif>Doanh trại</option>
                            <option value="quan-nhu" @if ($defaultType == 'quan-nhu') selected @endif>Quân nhu</option>
                            <option value="xang-xe" @if ($defaultType == 'xang-xe') selected @endif>Xăng xe</option>
                            <option value="quan-y" @if ($defaultType == 'quan-y') selected @endif>Quân y</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="status" class="block text-gray-600 font-medium mb-1">Trạng thái</label>
                        <select name="status" id="status" disabled
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100">
                            <option value="co-dinh" @if ($defaultStatus == 'co-dinh') selected @endif>Cố định</option>
                            <option value="cap-phat" @if ($defaultStatus == 'cap-phat') selected @endif>Cấp, phát, nhận vật
                                chất</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="type_1" class="block text-gray-600 font-medium mb-1">Phân loại 1</label>
                    <input type="number" name="type_1" id="type_1" min="0" value="0"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100"
                        placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_2" class="block text-gray-600 font-medium mb-1">Phân loại 2</label>
                    <input type="number" name="type_2" id="type_2" min="0" value="0"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100"
                        placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_3" class="block text-gray-600 font-medium mb-1">Phân loại 3</label>
                    <input type="number" name="type_3" id="type_3" min="0" value="0"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100"
                        placeholder="Số lượng">
                </div>
                <div>
                    <label for="type_4" class="block text-gray-600 font-medium mb-1">Phân loại 4</label>
                    <input type="number" name="type_4" id="type_4" min="0" value="0"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100"
                        placeholder="Số lượng">
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm</button>
                </div>
            </div>
        </form>
    </div>
@endsection
