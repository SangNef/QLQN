@extends('layout.main')
@section('content')
    <div class="w-full p-2 pr-24">
        <div class="flex justify-around">
            @if (session('user') && session('user')->position == 5)
                <a href="#" class="tab-link px-4 py-1 bg-sky-900 text-white font-semibold" data-tab="list">DANH SÁCH</a>
            @endif
            <a href="#" class="tab-link px-4 py-1 bg-sky-900 text-white font-semibold" data-tab="change-password">ĐỔI MẬT KHẨU</a>
            <a href="#" class="tab-link px-4 py-1 bg-sky-900 text-white font-semibold" data-tab="info-permissions">THÔNG TIN, QUYỀN HẠN</a>
            <a href="{{ route('logout') }}" class="px-4 py-1 bg-sky-900 text-white font-semibold">ĐĂNG XUẤT</a>
        </div>
        
        @if (session('user') && session('user')->position == 5)
            <div class="tab-content" id="list">
                @include('pages.account.tabs.list')
            </div>
            <div class="tab-content hidden" id="change-password">
                @include('pages.account.tabs.change_password')
            </div>
            <div class="tab-content hidden" id="info-permissions">
                {{-- @include('pages.account.tabs.info_permissions') --}}
            </div>
            <div class="tab-content hidden" id="logout">
                <!-- Include nội dung tab ĐĂNG XUẤT -->
            </div>
        @else
            <div class="tab-content" id="change-password">
                @include('pages.account.tabs.change_password')
            </div>
            <div class="tab-content hidden" id="info-permissions">
                {{-- @include('pages.account.tabs.info_permissions') --}}
            </div>
            <div class="tab-content hidden" id="logout">
                <!-- Include nội dung tab ĐĂNG XUẤT -->
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabLinks = document.querySelectorAll('.tab-link');
            var tabContents = document.querySelectorAll('.tab-content');

            tabLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    var tabId = this.getAttribute('data-tab');

                    tabContents.forEach(function(content) {
                        content.classList.add('hidden');
                    });

                    document.getElementById(tabId).classList.remove('hidden');
                });
            });
        });
    </script>
@endsection
