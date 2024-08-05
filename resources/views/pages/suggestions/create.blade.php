@extends('layout.main')
@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Thêm Đề Nghị, Nhu Cầu</h1>
            <a href="{{ route('suggestions.index') }}"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Danh
                Sách</a>
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
        <form action="{{ route('suggestion.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="name" class="block text-gray-600 font-medium mb-1">Tên Người Đăng Ký</label>
                        <input type="text" name="name" id="name"
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                            disabled value="{{ session('user')->name }}">
                    </div>
                    <div class="flex-1">
                        <label for="date" class="block text-gray-600 font-medium mb-1">Ngày Đăng Ký</label>
                        <input type="text" id="date"
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100 cursor-not-allowed"
                            disabled value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                </div>
                <div>
                    <label for="room" class="block text-gray-600 font-medium mb-1">Khoa, Ban, Bộ Phận</label>
                    <input type="text" name="room" id="room"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100  cursor-not-allowed"
                        value="{{ session('user')->department?->name }}" disabled>
                </div>
                <div>
                    <label for="description" class="block text-gray-600 font-medium mb-1">Nội Dung Đăng Ký</label>
                    <textarea name="description" id="description"
                        class="w-full border border-gray-300 rounded-lg p-2 text-gray-800 bg-gray-100" rows="6"
                        placeholder="Nhập nội dung đăng ký"></textarea>
                </div>
                <div>
                    <label for="image" class="block text-gray-600 font-medium mb-1">Ảnh Đính Kèm</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded-lg p-2 text-gray-800" accept="image/*">
                        <img src="" alt="Preview" id="preview" class="w-1/4 h-auto rounded-lg shadow-sm hidden">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Đăng
                        Ký</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const image = document.getElementById('image');
        const preview = document.getElementById('preview');
        image.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.addEventListener('load', function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                });
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
@endsection
