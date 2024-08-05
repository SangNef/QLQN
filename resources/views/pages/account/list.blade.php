@extends('layout.main')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Danh Sách Tài Khoản</h1>
            <a href="{{ route('account.create') }}"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm
                Tài Khoản</a>
        </div>
        <form action="{{ route('account.index') }}" method="GET" class="w-full mb-6 flex items-center gap-4">
            <div class="mb-6 w-1/3">
                <label for="search" class="block text-gray-600 font-medium mb-1">Tên</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm tài khoản..."
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800">
            </div>
            <div class="mb-6">
                <label for="department_name" class="block text-gray-600 font-medium mb-1">Phòng ban</label>
                <input type="text" id="department_name" name="department_name" placeholder="Chọn phòng ban..."
                    class="w-full border border-gray-300 rounded-lg p-2 text-gray-800" value="{{ $departmentName }}">
            </div>
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Tìm
            </button>
        </form>
        @if (session('success'))
            <div class="bg-green-200 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-200 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-100 text-gray-600 text-sm font-medium">
                    <tr>
                        <th class="border-b px-4 py-2 text-left">STT</th>
                        <th class="border-b px-4 py-2 text-left">Đồng Chí</th>
                        <th class="border-b px-4 py-2 text-left">Phòng ban</th>
                        <th class="border-b px-4 py-2 text-left">Tên Đăng Nhập</th>
                        <th class="border-b px-4 py-2 text-left">Mật Khẩu</th>
                        <th class="border-b px-4 py-2 text-left">Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="border-b px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border-b px-4 py-2">{{ $user->name }}</td>
                            <td class="border-b px-4 py-2">{{ $user->department?->name }}</td>
                            <td class="border-b px-4 py-2">{{ $user->username }}</td>
                            <td class="border-b px-4 py-2">{{ $user->password }}</td>
                            <td class="border-b px-4 py-2">
                                @if (!$user->is_deleted)
                                    <form action="{{ route('account.ban', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-1 bg-red-600 border border-red-700 rounded-md shadow-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out">
                                            Khóa
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('account.ban', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-1 bg-green-600 border border-green-700 rounded-md shadow-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                            Mở Khóa
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        <div class="w-full flex justify-end mt-6">
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px">
                    @if ($users->onFirstPage())
                        <li>
                            <span
                                class="bg-white border border-gray-300 text-gray-500 cursor-default hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $users->previousPageUrl() }}"
                                class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</a>
                        </li>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li>
                            @if ($page == $users->currentPage())
                                <span
                                    class="bg-blue-50 border border-gray-300 text-blue-600 py-2 px-3 leading-tight">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    @if ($users->hasMorePages())
                        <li>
                            <a href="{{ $users->nextPageUrl() }}"
                                class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">Next</a>
                        </li>
                    @else
                        <li>
                            <span
                                class="bg-white border border-gray-300 text-gray-500 cursor-default hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <script>
        $(function() {
            var availableDepartments = [
                @foreach ($departments as $item)
                    "{{ $item->name }}",
                @endforeach
            ];

            $("#department_name").autocomplete({
                source: availableDepartments,
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
