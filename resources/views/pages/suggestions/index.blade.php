@extends('layout.main')
@section('content')
    <div class="w-full p-2 pr-24">
        <div class="w-full flex justify-between">
            <h1 class="font-bold">DANH SÁCH ĐỀ NGHỊ, NHU CẦU</h1>
            <button class="px-4 py-1 bg-blue-500 hover:bg-blue-600 duration-300 shadow-sm rounded text-white">Thêm yêu cầu</button>
        </div>
        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th class="border">STT</th>
                    <th class="border">Ngày</th>
                    <th class="border">Khoa, ban, bộ phận</th>
                    <th class="border">Tên người đăng ký</th>
                    <th class="border">Nội dung đăng ký</th>
                    <th class="border">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggestions as $suggestion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suggestion->name }}</td>
                        <td>{{ $suggestion->created_at }}</td>
                        <td>{{ $suggestion->user->name }}</td>
                        <td>{{ $suggestion->status }}</td>
                        <td>
                            <a href="{{ route('suggestions.show', $suggestion->id) }}" class="text-blue-500">Xem</a>
                            <a href="{{ route('suggestions.edit', $suggestion->id) }}" class="text-green-500">Sửa</a>
                            <form action="{{ route('suggestions.destroy', $suggestion->id) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
