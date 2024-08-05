@extends('layout.main')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Chi Tiết Đề Nghị, Nhu Cầu</h1>
            <a href="{{ route('suggestions.index') }}"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out shadow-md rounded-lg text-white text-lg">Danh
                Sách</a>
        </div>

        @if (session('success'))
            <div class="bg-green-200 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Tên Người Đăng Ký:</h2>
            <p class="text-gray-700 text-lg">{{ $suggestion->user->name }}</p>
        </div>

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Ngày Đăng Ký:</h2>
            <p class="text-gray-700 text-lg">{{ date('d/m/Y', strtotime($suggestion->date)) }}</p>
        </div>

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Khoa, Ban, Bộ Phận:</h2>
            <p class="text-gray-700 text-lg">{{ $suggestion->user->department->name }}</p>
        </div>

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Nội Dung Đăng Ký:</h2>
            <p class="text-gray-700 text-lg">{{ $suggestion->description }}</p>
        </div>

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Ảnh Đính Kèm:</h2>
            <div class="flex gap-4">
                <img src="{{ asset('storage/' . $suggestion->image) }}" alt="Suggestion Image"
                    class="w-64 border border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>

        <div class="mb-6 flex">
            <h2 class="text-lg w-64 font-semibold text-gray-800">Trạng Thái:</h2>
            <p class="text-gray-700 text-lg">
                @if ($suggestion->status == 'pending')
                    <span class="text-red-600 bg-red-100 font-bold py-1 px-2 rounded">Chưa Xử Lý</span>
                @elseif ($suggestion->status == 'approved')
                    <span class="text-yellow-600 bg-yellow-100 font-bold py-1 px-2 rounded">Đã Duyệt Yêu Cầu</span>
                @else
                    <span class="text-green-600 bg-green-100 font-bold py-1 px-2 rounded">Đã Xử Lý</span>
                @endif
            </p>
        </div>

        @if ((session('user')->role != 'user') && ($suggestion->status != 'completed'))
            <form action="{{ route('suggestion.update', ['id' => $suggestion->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($suggestion->status == 'pending')
                    <div class="mb-6 flex">
                        <h2 class="text-lg w-64 font-semibold text-gray-800">Ghi Chú:</h2>
                        <textarea name="note" id="note" class="w-1/2 border border-gray-300 p-2 rounded-lg shadow-sm" rows="3"
                            placeholder="Nhập ghi chú"></textarea>
                    </div>
                @endif
                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out shadow-md rounded-lg text-white text-lg">
                        @if ($suggestion->status == 'pending')
                            Duyệt Yêu Cầu
                        @else
                            Hoàn Thành
                        @endif
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
