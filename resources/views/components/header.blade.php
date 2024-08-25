<header class="fixed z-20 bg-[#FEF46A] w-full flex justify-between items-center px-10 gap-4 py-2">
    <div class="flex flex-row items-center gap-4">
        <img src="{{ asset('logo.png') }}" alt="logo" class="w-10 h-10">
        <div class=" text-red-500">HỆ THỐNG QUẢN LÝ HẬU CẦN | BỆNH VIỆN QUÂN Y 354</div>
    </div>
    <div class="relative flex items-center gap-2">
        <h3 class="text-red-500">Thông báo chỉ đạo</h3>
        <button id="notificationButton" class="text-red-500 relative">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 22c1.104 0 2-.896 2-2H10c0 1.104.896 2 2 2zm6-6V10c0-4.418-3.582-8-8-8S2 5.582 2 10v6l-1 2v1h18v-1l-1-2z">
                </path>
            </svg>
            {{-- <span id="notificationCount" class="absolute -top-3 -right-1 bg-white px-1 rounded-full text-sm">0</span> --}}
        </button>
        <div id="notificationPopup"
            class="hidden absolute right-0 top-full mt-2 w-64 bg-white border border-gray-300 shadow-lg rounded-lg">
            <div class="py-4">
                <div class="flex justify-between px-4">
                    <p class="font-semibold">Thông Báo</p>
                    <div>
                        <button id="prevPage"">
                            < </button>
                                <button id="nextPage""> > </button>
                    </div>
                </div>
                <ul id="notificationList">
                </ul>
                <button id="markAllRead" class="font-bold text-center w-full mt-3">Đánh dấu tất cả là đã đọc</button>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentPage = 1;

        const notificationButton = document.getElementById('notificationButton');
        const notificationPopup = document.getElementById('notificationPopup');
        const notificationList = document.getElementById('notificationList');
        const notificationCount = document.getElementById('notificationCount');
        const markAllReadButton = document.getElementById('markAllRead');
        const prevPageButton = document.getElementById('prevPage');
        const nextPageButton = document.getElementById('nextPage');

        async function fetchNotifications(page = 1) {
            try {
                console.log(`Fetching notifications for page ${page}`);
                const response = await fetch(`/thong-bao?page=${page}`);
                const data = await response.json();
                console.log('Notifications fetched:', data);

                notificationList.innerHTML = ''; // Xóa thông báo cũ

                let unreadCount = 0;

                // Lặp qua các thông báo và tạo các phần tử li
                data.data.forEach(notification => {
                    console.log('Notification:', notification);
                    const li = document.createElement('li');
                    li.className =
                    `py-2 border-b px-4 ${notification.is_read ? '' : 'bg-gray-200'}`;
                    li.innerHTML =
                        `<strong>${notification.title}</strong><br/> ${notification.content}`;
                    notificationList.appendChild(li);
                    if (!notification.is_read) {
                        unreadCount++
                    }
                });

                console.log(unreadCount)

                if (data.current_page <= 1) {
                    prevPageButton.disabled = true;
                    prevPageButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevPageButton.disabled = false;
                    prevPageButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                if (data.current_page >= data.last_page) {
                    nextPageButton.disabled = true;
                    nextPageButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextPageButton.disabled = false;
                    nextPageButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                currentPage = data.current_page;

                // Cập nhật số lượng thông báo chưa đọc
                notificationCount.textContent = unreadCount;

            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        }

        async function markAllNotificationsAsRead() {
            try {
                console.log('Marking all notifications as read');
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                await fetch('/thong-bao/mark-all-read', {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                });
                fetchNotifications(currentPage); // Làm mới thông báo sau khi đánh dấu tất cả là đã đọc
            } catch (error) {
                console.error('Error marking all notifications as read:', error);
            }
        }

        notificationButton.addEventListener('click', function() {
            console.log('Notification button clicked');
            notificationPopup.classList.toggle('hidden');

            if (!notificationPopup.classList.contains('hidden')) {
                fetchNotifications(currentPage);
            }
        });

        document.addEventListener('click', function(event) {
            if (!notificationButton.contains(event.target) && !notificationPopup.contains(event
                .target)) {
                notificationPopup.classList.add('hidden');
            }
        });

        markAllReadButton.addEventListener('click', markAllNotificationsAsRead);

        prevPageButton.addEventListener('click', function() {
            console.log('Previous page button clicked');
            if (currentPage > 1) {
                currentPage--;
                fetchNotifications(currentPage);
            }
        });

        nextPageButton.addEventListener('click', function() {
            console.log('Next page button clicked');
            currentPage++;
            fetchNotifications(currentPage);
        });
    });
</script>
