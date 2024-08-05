@extends('layout.main')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <!-- Your existing content here -->
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Danh Sách Vật Chất Hậu Cần</h1>
            @if (session('user')->role == 'user')
                <a href="{{ route('item.create') }}"
                    class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm
                    mới</a>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-green-200 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            {{-- <form action="{{ route('suggestions.index') }}" method="GET" class="flex justify-between flex-col md:flex-row gap-4">
                <div class="flex items-center gap-2">
                    <label for="start_date" class="text-gray-700">Từ Ngày:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                
                <div class="flex items-center gap-2">
                    <label for="end_date" class="text-gray-700">Đến Ngày:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div class="flex items-center gap-2">
                    <label for="account" class="text-gray-700">Tài Khoản:</label>
                    <select id="account" name="account"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Chọn Tài Khoản</option>
                        {{-- @foreach ($accounts as $account)
                            <option value="{{ $account->id }}" {{ request('account') == $account->id ? 'selected' : '' }}>
                                {{ $account->name }}
                            </option>
                        @endforeach --}}
            {{-- </select>
                </div>
                
                <div class="flex items-center gap-2">
                    <label for="status" class="text-gray-700">Trạng Thái:</label>
                    <select id="status" name="status"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Chọn Trạng Thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chưa Xử Lý</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã Duyệt Yêu Cầu</option>
                        <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Đã Xử Lý</option>
                    </select>
                </div>
                
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    Lọc
                </button>
            </form> --}}
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg bg-white shadow-sm">
                <thead class="bg-gray-100 text-xs font-medium text-gray-600 uppercase">
                    <tr>
                        <th class="p-3 border-b text-left">STT</th>
                        <th class="p-3 border-b text-left">Tên</th>
                        <th class="p-3 border-b text-left">Khoa, ban, bộ phận</th>
                        <th class="p-3 border-b text-left">SL</th>
                        <th class="p-3 border-b text-left">Loại 1</th>
                        <th class="p-3 border-b text-left">Loại 2</th>
                        <th class="p-3 border-b text-left">Loại 3</th>
                        <th class="p-3 border-b text-left">Loại 4</th>
                        <th class="p-3 border-b text-left"></th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @foreach ($items as $item)
                        <tr class="hover:bg-gray-50 even:bg-gray-100 duration-150 cursor-pointer"
                            onclick="window.location='{{ route('item.detail', ['id' => $item->id]) }}'">
                            <td class="p-3 border-b">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-3 border-b">{{ $item->name }}</td>
                            <td class="p-3 border-b">{{ $item->user->department?->name }}</td>
                            <td class="p-3 border-b">{{ $item->type_1 + $item->type_2 + $item->type_3 + $item->type_4 }}
                            </td>
                            <td class="p-3 border-b">{{ $item->type_1 }}</td>
                            <td class="p-3 border-b">{{ $item->type_2 }}</td>
                            <td class="p-3 border-b">{{ $item->type_3 }}</td>
                            <td class="p-3 border-b">{{ $item->type_4 }}</td>
                            <td class="p-3 border-b">{{ $item->note }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        <div class="w-full flex justify-end mx-auto mt-6">
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px">
                    @if ($items->onFirstPage())
                        <li>
                            <span
                                class="bg-white border border-gray-300 text-gray-500 cursor-default hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $items->previousPageUrl() }}"
                                class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</a>
                        </li>
                    @endif

                    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                        <li>
                            @if ($page == $items->currentPage())
                                <span
                                    class="bg-blue-50 border border-gray-300 text-blue-600 py-2 px-3 leading-tight">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    @if ($items->hasMorePages())
                        <li>
                            <a href="{{ $items->nextPageUrl() }}"
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
@endsection
