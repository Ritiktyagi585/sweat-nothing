<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard | Sweat Nothing')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard-sidebar.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f8fa] font-sans text-[15px] font-normal text-[#121212] antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-[260px_1fr]">
        <div id="dashboard-sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden"></div>

        <aside id="dashboard-sidebar"
            class="fixed inset-y-0 left-0 z-50 flex w-[260px] -translate-x-full flex-col overflow-y-auto bg-[#101111] text-white transition-transform duration-200 lg:sticky lg:top-0 lg:h-screen lg:w-auto lg:translate-x-0 lg:self-start">
            <a href="{{ route('dashboard') }}" class="dashboard-brand" aria-label="Ayurth dashboard home">
                <span class="dashboard-brand-mark">
                    <img src="{{ asset('images/ayurthlogoh.png') }}" alt="Ayurth" class="dashboard-brand-image">
                </span>
            </a>

            <nav class="dashboard-nav" aria-label="Dashboard navigation">
                <a href="{{ route('dashboard') }}" class="dashboard-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
                    <span class="dashboard-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/></svg></span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('dashboard.enquiries') }}" class="dashboard-nav-link {{ request()->routeIs('dashboard.enquiries') ? 'is-active' : '' }}">
                    <span class="dashboard-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>
                    <span>Enquiries</span>
                </a>
                <a href="{{ route('dashboard.orders') }}" class="dashboard-nav-link {{ request()->routeIs('dashboard.orders') ? 'is-active' : '' }}">
                    <span class="dashboard-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 8h14l1 12H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/><path d="M8 12h.01M16 12h.01" stroke-linecap="round"/></svg></span>
                    <span>Orders</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="dashboard-nav-link {{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}">
                    <span class="dashboard-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21M8 5.1l8.5 4.7"/></svg></span>
                    <span>Product</span>
                </a>
                <a href="{{ route('dashboard.settings') }}" class="dashboard-nav-link {{ request()->routeIs('dashboard.settings') ? 'is-active' : '' }}">
                    <span class="dashboard-nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 8.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Z"/><path d="m19.4 13.5 1.1.9-1.2 2.1-1.4-.5a7.8 7.8 0 0 1-1.5.9l-.2 1.5h-2.4l-.4-1.4a7.8 7.8 0 0 1-1.7 0l-.9 1.1-2.1-1.2.5-1.4a7.8 7.8 0 0 1-.9-1.5l-1.5-.2v-2.4l1.4-.4a7.8 7.8 0 0 1 0-1.7l-1.1-.9 1.2-2.1 1.4.5a7.8 7.8 0 0 1 1.5-.9l.2-1.5h2.4l.4 1.4a7.8 7.8 0 0 1 1.7 0l.9-1.1 2.1 1.2-.5 1.4a7.8 7.8 0 0 1 .9 1.5l1.5.2v2.4l-1.4.4a7.8 7.8 0 0 1 0 1.7Z" transform="translate(-1 -1) scale(1.08)"/></svg></span>
                    <span>Settings</span>
                </a>
            </nav>

            <div class="dashboard-sidebar-footer">
                <a href="{{ route('home') }}" class="dashboard-footer-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M19 12H5m7 7-7-7 7-7"/></svg>
                    <span>Back to Website</span>
                </a>
                <form action="{{ route('dashboard.logout') }}" method="POST" class="mt-1">@csrf
                    <button class="dashboard-footer-link dashboard-logout-link" type="submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M10 17l5-5-5-5m5 5H3"/><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0">
            <header
                class="sticky top-0 z-20 flex min-h-16 items-center justify-between border-b border-black/5 bg-white px-4 py-3 sm:min-h-20 sm:px-5 sm:py-4 lg:px-8">
                <button id="dashboard-menu-toggle" type="button"
                    class="grid h-10 w-10 place-items-center rounded-lg border border-black/10 text-xl transition hover:bg-slate-100 lg:hidden"
                    aria-label="Open dashboard menu" aria-controls="dashboard-sidebar" aria-expanded="false">
                    &#9776;
                </button>
                <label
                    class="hidden max-w-md flex-1 items-center gap-3 rounded-xl bg-[#f4f5f7] px-4 py-3 text-sm text-slate-500 sm:flex">
                    <span class="text-xl text-black">&#9906;</span>
                    <input class="w-full bg-transparent outline-none" type="search"
                        placeholder="Search orders, products, enquiries...">
                </label>

                <div class="ml-auto flex items-center gap-2 sm:gap-4">
                    <div class="dashboard-notification-wrap">
                        <button id="dashboard-notification-toggle" type="button" class="dashboard-notification-toggle" aria-label="Open notifications" aria-haspopup="true" aria-expanded="false" aria-controls="dashboard-notification-menu">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/><path d="M10 21h4"/></svg>
                            <span class="dashboard-notification-dot" aria-hidden="true"></span>
                        </button>
                        <div id="dashboard-notification-menu" class="dashboard-notification-menu" hidden>
                            <div class="dashboard-notification-heading">Quick links</div>
                            <a href="{{ route('dashboard.enquiries') }}" class="dashboard-notification-link">
                                <span class="dashboard-notification-link-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>
                                <span><strong>Enquiries</strong><small>View customer messages</small></span>
                            </a>
                            <a href="{{ route('dashboard.orders') }}" class="dashboard-notification-link">
                                <span class="dashboard-notification-link-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M5 8h14l1 12H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg></span>
                                <span><strong>Orders</strong><small>Manage customer orders</small></span>
                            </a>
                        </div>
                    </div>
                    <div class="hidden h-10 w-px bg-black/10 sm:block"></div>
                    <div class="dashboard-profile-wrap">
                        <button id="dashboard-profile-toggle" type="button" class="dashboard-profile-toggle" aria-label="Open profile menu" aria-haspopup="true" aria-expanded="false" aria-controls="dashboard-profile-menu">
                            <span class="dashboard-profile-avatar">{{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 2)) }}</span>
                            <span class="dashboard-profile-copy"><span class="dashboard-profile-name">{{ auth()->user()?->name ?? 'Admin' }}</span><span class="dashboard-profile-role">Admin</span></span>
                            <svg class="dashboard-profile-chevron" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="m5 7.5 5 5 5-5"/></svg>
                        </button>
                        <div id="dashboard-profile-menu" class="dashboard-profile-menu" hidden>
                            <a href="{{ route('dashboard.settings') }}" class="dashboard-profile-menu-link">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
                                <span>Profile</span>
                            </a>
                            <div class="dashboard-profile-menu-divider"></div>
                            <form action="{{ route('dashboard.logout') }}" method="POST">@csrf
                                <button type="submit" class="dashboard-profile-menu-link dashboard-profile-logout">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M10 17l5-5-5-5m5 5H3"/><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"/></svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                                    </div>
            </header>

            @yield('content')
        </div>
    </div>
    <script>
        const dashboardMenuToggle = document.getElementById('dashboard-menu-toggle');
        const dashboardSidebar = document.getElementById('dashboard-sidebar');
        const dashboardSidebarBackdrop = document.getElementById('dashboard-sidebar-backdrop');
        const dashboardProfileToggle = document.getElementById('dashboard-profile-toggle');
        const dashboardProfileMenu = document.getElementById('dashboard-profile-menu');
        const dashboardProfileWrap = document.querySelector('.dashboard-profile-wrap');
        const dashboardNotificationToggle = document.getElementById('dashboard-notification-toggle');
        const dashboardNotificationMenu = document.getElementById('dashboard-notification-menu');
        const dashboardNotificationWrap = document.querySelector('.dashboard-notification-wrap');

        const closeDashboardNotificationMenu = () => {
            dashboardNotificationMenu.hidden = true;
            dashboardNotificationToggle.setAttribute('aria-expanded', 'false');
            dashboardNotificationToggle.setAttribute('aria-label', 'Open notifications');
        };

        dashboardNotificationToggle.addEventListener('click', () => {
            const isOpen = dashboardNotificationMenu.hidden;
            dashboardNotificationMenu.hidden = !isOpen;
            dashboardNotificationToggle.setAttribute('aria-expanded', String(isOpen));
            dashboardNotificationToggle.setAttribute('aria-label', isOpen ? 'Close notifications' : 'Open notifications');
            closeDashboardProfileMenu();
        });

        dashboardNotificationMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeDashboardNotificationMenu);
        });

        const closeDashboardProfileMenu = () => {
            dashboardProfileMenu.hidden = true;
            dashboardProfileToggle.setAttribute('aria-expanded', 'false');
            dashboardProfileToggle.setAttribute('aria-label', 'Open profile menu');
        };

        dashboardProfileToggle.addEventListener('click', () => {
            const isOpen = dashboardProfileMenu.hidden;
            dashboardProfileMenu.hidden = !isOpen;
            dashboardProfileToggle.setAttribute('aria-expanded', String(isOpen));
            dashboardProfileToggle.setAttribute('aria-label', isOpen ? 'Close profile menu' : 'Open profile menu');
        });

        document.addEventListener('click', (event) => {
            if (!dashboardProfileWrap.contains(event.target)) {
                closeDashboardProfileMenu();
            }
            if (!dashboardNotificationWrap.contains(event.target)) {
                closeDashboardNotificationMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !dashboardProfileMenu.hidden) {
                closeDashboardProfileMenu();
                dashboardProfileToggle.focus();
            }
            if (event.key === 'Escape' && !dashboardNotificationMenu.hidden) {
                closeDashboardNotificationMenu();
                dashboardNotificationToggle.focus();
            }
        });

        const closeDashboardMenu = () => {
            dashboardSidebar.classList.add('-translate-x-full');
            dashboardSidebarBackdrop.classList.add('hidden');
            dashboardMenuToggle.setAttribute('aria-expanded', 'false');
            dashboardMenuToggle.setAttribute('aria-label', 'Open dashboard menu');
        };

        dashboardMenuToggle.addEventListener('click', () => {
            const isOpen = dashboardSidebar.classList.toggle('-translate-x-full') === false;

            dashboardSidebarBackdrop.classList.toggle('hidden', !isOpen);
            dashboardMenuToggle.setAttribute('aria-expanded', String(isOpen));
            dashboardMenuToggle.setAttribute('aria-label', isOpen ? 'Close dashboard menu' : 'Open dashboard menu');
        });

        dashboardSidebarBackdrop.addEventListener('click', closeDashboardMenu);
    </script>
</body>

</html>
