<div class="w-full flex justify-between pt-6">
    <h1 class="font-bold">DANH SÁCH TÀI KHOẢN</h1>
    <a href="{{ route('account.create') }}"
        class="px-4 py-1 bg-blue-500 hover:bg-blue-600 duration-300 shadow-sm rounded text-white">Thêm tài khoản</a>
</div>
<table class="w-full mt-4">
    <thead>
        <tr>
            <th class="border border-black">STT</th>
            <th class="border border-black">Đồng chí</th>
            <th class="border border-black">Tên đăng nhập</th>
            <th class="border border-black">Mật khẩu</th>
            <th class="border border-black">Chức vụ</th>
            <th class="border border-black">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="border border-black px-3">{{ $loop->iteration }}</td>
                <td class="border border-black px-3">{{ $user->name }}</td>
                <td class="border border-black px-3">{{ $user->username }}</td>
                <td class="border border-black px-3">{{ $user->password }}</td>
                <td class="border border-black px-3">{{ $user->position }}</td>
                <td class="border border-black px-3">
                    <a class="text-blue-500">Xem</a>
                    <a class="text-green-500">Sửa</a>
                    {{-- <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE') --}}
                    <button type="submit" class="text-red-500">Xóa</button>
                    {{-- </form> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>