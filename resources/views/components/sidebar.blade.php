<aside class="w-[300px] min-h-screen fixed bg-sky-900 flex flex-col">
    <ul class="py-8 mt-16 px-8 flex flex-col flex-grow">
        <li class="w-full text-white font-bold uppercase mb-4">
            <a href="/" class="block w-full py-2 hover:bg-sky-800 hover:pl-3 duration-150">Đề nghị, nhu cầu</a>
        </li>
        <li class="w-full text-white font-bold uppercase mb-4">
            <a href="#" class="menu-toggle flex items-center justify-between py-2 hover:bg-sky-800 hover:pl-3 duration-150">
                Quản lý vật chất
                <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </a>
            <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                <li class="w-full text-white font-bold uppercase mb-4">
                    <a href="#" class="menu-toggle flex text-sm pl-3 items-center justify-between py-2 hover:bg-sky-800 hover:pl-5 duration-150">
                        Doanh trại
                        <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                        <li><a href="{{ route('doanh-trai.co-dinh') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Tài sản cố định</a></li>
                        <li><a href="{{ route('doanh-trai.cap-phat') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Cấp, phát, nhận vật chất</a></li>
                    </ul>
                </li>
                <li class="w-full text-white font-bold uppercase mb-4">
                    <a href="#" class="menu-toggle flex text-sm pl-3 items-center justify-between py-2 hover:bg-sky-800 hover:pl-5 duration-150">
                        Quân nhu
                        <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                        <li><a href="{{ route('quan-nhu.co-dinh') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Tài sản cố định</a></li>
                        <li><a href="{{ route('quan-nhu.cap-phat') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Cấp, phát, nhận vật chất</a></li>
                    </ul>
                </li>
                <li class="w-full text-white font-bold uppercase mb-4">
                    <a href="#" class="menu-toggle flex text-sm pl-3 items-center justify-between py-2 hover:bg-sky-800 hover:pl-5 duration-150">
                        Xăng xe
                        <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                        <li><a href="{{ route('xang-xe.co-dinh') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Tài sản cố định</a></li>
                        <li><a href="{{ route('xang-xe.cap-phat') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Cấp, phát, nhận vật chất</a></li>
                    </ul>
                </li>
                <li class="w-full text-white font-bold uppercase mb-4">
                    <a href="#" class="menu-toggle flex text-sm pl-3 items-center justify-between py-2 hover:bg-sky-800 hover:pl-5 duration-150">
                        Quân y
                        <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                        <li><a href="{{ route('quan-y.co-dinh') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Tài sản cố định</a></li>
                        <li><a href="{{ route('quan-y.cap-phat') }}" class="block text-sm py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-7 pl-5 duration-150">Cấp, phát, nhận vật chất</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- Phần Tài khoản -->
        <li class="w-full text-white font-bold uppercase mb-4">
            <a href="#"
                class="menu-toggle flex items-center justify-between py-2 hover:bg-sky-800 hover:pl-3 duration-150">
                Quản lý tài khoản
                <svg class="w-4 h-4 transition-transform duration-300 transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </a>
            <ul class="submenu max-h-0 overflow-hidden transition-max-height duration-300 ease-in-out">
                @if (session('user')->role_id === 1)
                    <li><a href="{{ route('account.index') }}"
                            class="block py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-5 duration-150">Danh Sách</a>
                    </li>
                @endif
                <li><a href="{{ route('account.changePassword') }}"
                        class="block py-2 px-4 text-gray-300 hover:bg-sky-800 hover:pl-5 duration-150">Đổi Mật Khẩu</a>
                </li>
                
            </ul>
        </li>

        
        <!-- Logout Menu Item -->
        <li class="mt-auto w-full text-white font-bold uppercase">
            <a href="{{ route('logout') }}" class="block w-full py-2 hover:bg-sky-800 hover:pl-3 duration-150">Đăng Xuất</a>
        </li>
    </ul>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggles = document.querySelectorAll('.menu-toggle');
        var submenus = document.querySelectorAll('.submenu');

        menuToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(event) {
                event.preventDefault();

                var submenu = this.nextElementSibling;
                var arrow = this.querySelector('svg');

                if (submenu) {
                    submenu.classList.toggle('max-h-0');
                    submenu.classList.toggle('max-h-screen'); // Adjust this if needed

                    if (submenu.classList.contains('max-h-0')) {
                        arrow.style.transform = 'rotate(0deg)';
                    } else {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                }
            });
        });
    });
</script>

<style>
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .submenu.max-h-screen {
        max-height: 1000px;
        /* Adjust based on submenu height */
    }
</style>
