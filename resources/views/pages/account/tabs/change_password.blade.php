<div class="container mx-auto px-4">
    <div class="flex min-h-[80vh] justify-center items-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md overflow-hidden border-y-[16px] border-x-4 border-gray-500">
                <h3 class="text-lg p-4 font-semibold">ĐỔI MẬT KHẨU</h3>
                <div class="p-4">

                    <div class="mb-4">
                        <label for="opassword" class="block text-gray-700">Mật khẩu cũ</label>
                        <input type="text" name="opassword" id="opassword"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                            value="{{ old('opassword') }}" required>
                        @error('opassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="npassword" class="block text-gray-700">Mật khẩu mới</label>
                        <input type="password" name="npassword" id="npassword"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                            required>
                        @error('npassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="password" name="cpassword" id="cpassword"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                            placeholder="Nhập lại mật khẩu mới" required>
                        @error('cpassword')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="flex items-center bg-indigo-500 text-white py-2 px-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">
                            <i class="fa-solid fa-check text-xl mr-2"></i>
                            Xác nhận
                        </button>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
