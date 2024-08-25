@extends('layout.main')

@section('content')
    <div class="container mx-8 p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Thêm tài khoản</h1>
            <a href="{{ route('account.index') }}"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Danh Sách
            </a>
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

        <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-gray-600 font-medium mb-1">Tên Đồng Chí</label>
                <input type="text" name="name" id="name"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800" value="{{ old('name') }}" required>
            </div>
            <div class="mb-6">
                <label for="username" class="block text-gray-600 font-medium mb-1">Tên Đăng Nhập</label>
                <input type="text" name="username" id="username"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800" value="{{ old('username') }}"
                    required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-600 font-medium mb-1">Mật Khẩu</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800" required>
            </div>
            <div class="mb-6">
                <label for="role" class="block text-gray-600 font-medium mb-1">Chức Vụ</label>
                <select name="role_id" id="role" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800"
                    required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-6" id="department_input" style="display:none;">
                <label for="department_name" class="block text-gray-600 font-medium mb-1">Phòng ban</label>
                <input type="text" id="department_name" name="department_name"
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800">
            </div>
            <div class="mb-6" id="storage_input" style="display:none;">
                <label for="storage_name" class="block text-gray-600 font-medium mb-1">Ngành</label>
                <select name="storage_id" id="storage_name" class="w-full border border-gray-300 rounded-lg p-2 text-gray-800">
                    @foreach ($storages as $storage)
                        <option value="{{ $storage->id }}" {{ old('storage') == $storage->name ? 'selected' : '' }}>
                            {{ $storage->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 transition duration-300 ease-in-out shadow-lg rounded-lg text-white text-lg">Thêm</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.getElementById('role');
            var departmentInput = document.getElementById('department_input');
            var storageInput = document.getElementById('storage_input');

            roleSelect.addEventListener('change', function() {
                if (this.value == 5) {
                    departmentInput.style.display = 'block';
                    storageInput.style.display = 'none';
                } else if (this.value == 6) {
                    departmentInput.style.display = 'none';
                    storageInput.style.display = 'block';
                } else {
                    departmentInput.style.display = 'none';
                    storageInput.style.display = 'none';
                }
            });

            roleSelect.dispatchEvent(new Event('change'));

            var availablePositions = [
                @foreach ($departments as $item)
                    "{{ $item->name }}",
                @endforeach
            ];

            $("#department_name").autocomplete({
                source: availablePositions,
                minLength: 0,
                open: function() {
                    $(this).autocomplete('widget').css({
                        'max-height': '200px',
                        'overflow-y': 'auto',
                        'overflow-x': 'hidden',
                        'margin-top': '1px',
                        'margin-left': '10px',
                    });
                }
            }).focus(function() {
                $(this).autocomplete('search', ''); // Tìm kiếm với từ khóa trống để hiển thị danh sách
            });

        });
    </script>
@endsection
