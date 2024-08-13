<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Home</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if ($unread > 0)
                    <span class="badge badge-warning navbar-badge">{{ $unread }}</span>
                @else
                    <span class="badge badge-warning navbar-badge" style="display: none">{{ $unread }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notifications->count() }} Notifications</span>
                @forelse ($notifications as $notif)
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $notif->message }}

                        {{-- Ini ada di data yang belum di baca atau baru ditambahkan --}}
                        <span class="badge badge-success">New</span>

                        <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        Belum ada tugas baru
                    </a>
                @endforelse
            </div>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="nav-icon fas fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary" style="display: flex; align-items:center; justify-content:center;">
                    <p>
                        {{ session('nama') }} -
                        @if (session('level') == 1)
                            Pengurus
                        @elseif(session('level') == 2)
                            General Manager
                        @elseif(session('level') == 3)
                            Manager
                        @elseif(session('level') == 4)
                            KA Unit
                        @else
                            Employee
                        @endif
                        <small>Dibuat pada {{ session('dibuat') }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                    <a href="/logout" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan moment.js sudah diimport jika menggunakan bundler
        // import moment from 'moment';

        function formatDate(dateString) {
            return moment(dateString).fromNow();
        }

        function fetchNotifications() {
            fetch('/notifications/fetch')
                .then(response => response.json())
                .then(data => {
                    const notifications = data.notifications;
                    const unread = data.unread;

                    // Update badge count
                    const badge = document.querySelector('.navbar-badge');
                    if (unread > 0) {
                        badge.textContent = unread;
                        badge.style.display = 'inline';
                    } else {
                        badge.style.display = 'none';
                    }

                    // Update notification dropdown
                    const dropdownMenu = document.querySelector('.dropdown-menu');
                    dropdownMenu.innerHTML =
                        `<span class="dropdown-item dropdown-header">${notifications.length} Notifications</span>`;

                    if (notifications.length === 0) {
                        dropdownMenu.innerHTML +=
                            `<div class="dropdown-divider"></div><a href="#" class="dropdown-item">Belum ada tugas baru</a>`;
                    } else {
                        notifications.forEach(notif => {
                            dropdownMenu.innerHTML +=
                                `<div class="dropdown-divider"></div><a href="#" class="dropdown-item">${notif.message} <span class="float-right text-muted text-sm">${formatDate(notif.created_at)}</span></a>`;
                        });
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // Initial fetch
        fetchNotifications();

        // Polling interval (e.g., every 30 seconds)
        setInterval(fetchNotifications, 60000);

        // Mark notifications as read when clicking on the bell icon
        const bellIcon = document.querySelector('.nav-link[data-toggle="dropdown"]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]');

        if (bellIcon && csrfToken) {
            bellIcon.addEventListener('click', function() {
                fetch('/notifications/mark-as-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                        },
                        body: JSON.stringify({
                            markAsRead: true
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            fetchNotifications(); // Refresh notifications after marking as read
                        }
                    })
                    .catch(error => console.error('Error marking notifications as read:', error));
            });
        } else {
            console.error('CSRF token or notification icon not found.');
        }
    });
</script>
