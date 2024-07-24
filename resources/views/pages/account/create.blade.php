@extends('layout.main')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex min-h-[80vh] justify-center items-center">
            <div class="w-full max-w-2xl">
                <div class="bg-white shadow-md overflow-hidden border-y-[16px] border-x-4 border-gray-500">
                    <h3 class="text-lg text-center py-4">Thêm tài khoản</h3>
                    <div class="p-4">
                        <form action="{{ route('account.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Đồng chí</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="username" class="block text-gray-700">Tên đăng nhập</label>
                                <input type="text" name="username" id="username"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" required>
                                @error('username')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Mật khẩu</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                                    required>
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="position" class="block text-gray-700">Vị trí</label>
                                <div class="flex flex-wrap gap-4 mt-2 justify-evenly">
                                    @foreach (['1', '2', '3', '4', '5'] as $position)
                                        <label class="flex items-center">
                                            <input type="radio" name="position" value="{{ $position }}"
                                                class="form-radio text-indigo-600"
                                                {{ $position == 1 ? 'checked' : '' }}>
                                            <span class="ml-2">{{ $position }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('position')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full bg-indigo-500 text-white py-2 px-4 rounded-lg hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Xác
                                nhận</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
