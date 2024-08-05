@extends('layout.main')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-xl shadow-lg min-h-[80vh]">
        <!-- Your existing content here -->
        <div class="w-full flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Danh Sách Đề Nghị, Nhu Cầu</h1>
            @if (session('user')->role == 'user')
                <a href="{{ route('suggestion.create') }}"
                    class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">Thêm
                    Yêu Cầu</a>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-green-200 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-200 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-6">
            <form action="{{ route('suggestions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
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

                @if (session('user')->role != 'user')
                <div class="flex items-center gap-2">
                    <label for="department" class="text-gray-700">Khoa, Ban, Bộ Phận:</label>
                    <select id="department" name="department"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Tất cả</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->name }}" {{ request('department') == $department->name ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                    
                @endif
                
                <div class="flex items-center gap-2">
                    <label for="status" class="text-gray-700">Trạng Thái:</label>
                    <select id="status" name="status"
                        class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="">Tất cả</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chưa Xử Lý</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã Duyệt Yêu Cầu</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Đã Xử Lý</option>
                    </select>
                </div>
                
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    Lọc
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg bg-white shadow-sm">
                <thead class="bg-gray-100 text-xs font-medium text-gray-600 uppercase">
                    <tr>
                        <th class="p-3 border-b text-left">STT</th>
                        <th class="p-3 border-b text-left">Ngày</th>
                        <th class="p-3 border-b text-left">Khoa, Ban, Bộ Phận</th>
                        <th class="p-3 border-b text-left">Tên Người Đăng Ký</th>
                        <th class="p-3 border-b text-left">Nội Dung Đăng Ký</th>
                        <th class="p-3 border-b text-left">Trạng Thái</th>
                        <th class="p-3 border-b text-left">Ghi Chú</th>
                        <th class="p-3 border-b text-left"></th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    @foreach ($suggestions as $suggestion)
                        <tr class="hover:bg-gray-50 even:bg-gray-100 duration-150 cursor-pointer"
                            onclick="window.location='{{ route('suggestion.detail', ['id' => $suggestion->id]) }}'">
                            <td class="p-3 border-b">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-3 border-b">{{ date('d/m/Y', strtotime($suggestion->date)) }}</td>
                            <td class="p-3 border-b">{{ $suggestion->user->department->name }}</td>
                            <td class="p-3 border-b">{{ $suggestion->user->name }}</td>
                            <td class="p-3 border-b">{{ $suggestion->description }}</td>
                            <td class="p-3 border-b">
                                @if ($suggestion->status == 'pending')
                                    <span class="text-red-600 bg-red-100 font-bold py-1 px-2 rounded">Chưa Xử Lý</span>
                                @elseif ($suggestion->status == 'approved')
                                    <span class="text-yellow-600 bg-yellow-100 font-bold py-1 px-2 rounded">Đã Duyệt Yêu Cầu</span>
                                @else
                                    <span class="text-green-600 bg-green-100 font-bold py-1 px-2 rounded">Đã Xử Lý</span>
                                @endif
                            </td>
                            <td class="p-3 border-b">{{ $suggestion->note }}</td>
                            <td class="p-3 border-b">
                                <form action="{{ route('suggestion.destroy', ['id' => $suggestion->id]) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa yêu cầu này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-1 bg-red-600 border border-red-700 rounded-md shadow-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        <div class="w-full flex justify-end mx-auto mt-6">
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px">
                    @if ($suggestions->onFirstPage())
                        <li>
                            <span class="bg-white border border-gray-300 text-gray-500 cursor-default hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $suggestions->previousPageUrl() }}"
                                class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-2 px-3">Previous</a>
                        </li>
                    @endif

                    @foreach ($suggestions->getUrlRange(1, $suggestions->lastPage()) as $page => $url)
                        <li>
                            @if ($page == $suggestions->currentPage())
                                <span class="bg-blue-50 border border-gray-300 text-blue-600 py-2 px-3 leading-tight">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}"
                                    class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-2 px-3">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach

                    @if ($suggestions->hasMorePages())
                        <li>
                            <a href="{{ $suggestions->nextPageUrl() }}"
                                class="bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">Next</a>
                        </li>
                    @else
                        <li>
                            <span class="bg-white border border-gray-300 text-gray-500 cursor-default hover:bg-gray-100 hover:text-gray-700 rounded-r-lg leading-tight py-2 px-3">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection
