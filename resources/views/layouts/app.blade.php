<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HRLara') }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Aplikasi manajemen modern dengan antarmuka yang intuitif">
    <meta name="keywords" content="manajemen, dashboard, aplikasi">
    <meta name="author" content="Your Company">
    
    <!-- Preconnect untuk optimasi performa -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://unpkg.com">
    
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    
    <!-- Load Chart.js (conditional) -->
    <script>
        // Hanya load Chart.js jika diperlukan
        if (window.location.pathname.includes('dashboard')) {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
            document.head.appendChild(script);
        }
    </script>

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
/* =========================
   ROOT TOKENS (BRAND)
========================= */
:root {
    --sidebar-width-collapsed: 5rem;
    --sidebar-width-expanded: 16rem;
    --transition-duration: .2s;

    /* BRAND COLOR (hasil rgb(19 180 241)) */
    --primary-color: #13B4F1;
    --primary-hover: #1098CC;

    --text-light: #d1d5db;
    --text-dark:  #1f2937;

    --bg-light: #f8fafc;
    --bg-dark:  #0f172a;

    --modal-max-width: 56rem;
    --modal-max-height: 85vh;
}

/* util text brand */
.text-biru {
    color: rgb(19 180 241 / 1);
}

/* =========================
   BASE
========================= */
* { box-sizing: border-box; }

body {
    font-family: 'Figtree', sans-serif;
    overflow-x: hidden;
}

/* =========================
   SIDEBAR
========================= */
.sidebar {
    background-color: var(--primary-color);
    box-shadow: 2px 0 5px rgba(0,0,0,.1);
    transition: width var(--transition-duration) ease-in-out;
}

.sidebar-collapsed { width: var(--sidebar-width-collapsed) !important; }
.sidebar-expanded  { width: var(--sidebar-width-expanded) !important; }

.main-content-collapsed { margin-left: var(--sidebar-width-collapsed) !important; }
.main-content-expanded  { margin-left: var(--sidebar-width-expanded) !important; }

.sidebar-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    color: var(--text-light);
    border-radius: .5rem;
    margin: .25rem .75rem;
    cursor: pointer;
    white-space: nowrap;
    overflow: hidden;
    transition: all .2s;
}

.sidebar-item:hover {
    background-color: var(--primary-hover);
    color: #eef2ff;
}

.sidebar-item.active {
    background: #f1f5f9;
    color: var(--primary-color);
    font-weight: 600;
}

.profile-container {
    border-top: 1px solid var(--primary-hover);
    padding-top: 1.5rem;
    margin-top: 1rem;
}

/* =========================
   TOOLTIP
========================= */
.tooltip-container { position: relative; display: inline-flex; align-items: center; }
.tooltip-text {
    visibility: hidden;
    opacity: 0;
    width: 200px;
    background: #334155;
    color: #fff;
    border-radius: 6px;
    padding: 8px;
    position: absolute;
    bottom: 125%;
    left: 50%;
    margin-left: -100px;
    transition: opacity .3s;
    box-shadow: 0 4px 6px rgba(0,0,0,.1);
    z-index: 10;
}
.tooltip-container:hover .tooltip-text { visibility: visible; opacity: 1; }

/* =========================
   MODAL
========================= */
.modal-backdrop {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.5);
    backdrop-filter: blur(4px);
    z-index: 40;
    opacity: 0;
    transition: opacity .3s;
}
.modal-backdrop.active { opacity: 1; }

.modal-container {
    position: fixed; inset: 0;
    overflow-y: auto;
    z-index: 50;
    display: none;
}
.modal-container.active { display: flex; }

.modal-dialog {
    margin: auto;
    width: auto;
    padding: 1rem;
    max-width: var(--modal-max-width);
    animation: modalSlideIn .3s ease-out;
}

.modal-content {
    background: #fff;
    border-radius: .75rem;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,.25);
    overflow: hidden;
    max-height: var(--modal-max-height);
    display: flex;
    flex-direction: column;
}

.modal-header {
    display: flex; align-items: center;
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.modal-title { font-size: 1.25rem; font-weight: 600; }
.modal-body { padding: 1.5rem; flex: 1; overflow-y: auto; }

.modal-close {
    margin-left: auto;
    border: none;
    background: none;
    padding: .5rem;
    border-radius: .375rem;
    color: #6b7280;
    cursor: pointer;
    transition: .2s;
}
.modal-close:hover { background: #f3f4f6; color: #374151; }

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: .75rem;
    padding: 1rem 1.5rem 1.5rem;
    border-top: 1px solid #e5e7eb;
}

/* modal animation */
@keyframes modalSlideIn {
    from { opacity: 0; transform: translateY(-1rem) scale(.95); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* =========================
   TABLE / CANVAS
========================= */
.table-row-hover { transition: .2s; }
.table-row-hover:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}

#signature-canvas {
    border: 2px dashed #cbd5e1;
    border-radius: .5rem;
    cursor: crosshair;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 620px) {
    .sidebar-expanded { width: 100% !important; position: fixed; height: 100vh; z-index: 50; }
    .main-content-expanded, .main-content-collapsed { margin-left: 0 !important; }

    .modal-dialog { width: 100%; height: 100%; padding: 0; max-width: none; }
    .modal-content { border-radius: 0; height: 100%; }
    .modal-footer { flex-direction: column-reverse; }
}

@media (min-width: 768px) {
    #sidebar {
        height: calc(100vh - 5rem);
        top: 5rem;
        transition: transform .3s ease-in-out;
    }
}

/* mobile toggle */
.mobile-menu-toggle {
    display: none;
    position: fixed;
    top: 1rem; left: 1rem;
    z-index: 60;
    background: var(--primary-color);
    color: #fff;
    border: none;
    border-radius: .375rem;
    padding: .5rem;
}
@media (max-width: 768px) { .mobile-menu-toggle { display: block; } }
</style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!--Header -->
        <header class="bg-white shadow dark:bg-gray-800 sticky top-0 left-0 right-0 ">
            <div class="px-4 sm:px-6 lg:px-8 py-2 flex justify-between items-left">
                
                <div class="flex items-center space-x-3 min-w-0">
                    <!-- Logo Perusahaan -->
                    <div class="flex-shrink-0">
                    <svg class="w-8 h-8 flex-shrink-0" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="4" fill="none" stroke="#13b4f1" stroke-width="2"></rect>
                        <text x="12" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-size="9" font-weight="bold" fill="#13b4f1">HR</text>
                    </svg>
                    </div>

                </div>

                <!-- User Navigation -->
                <div class="flex items-center space-x-4">
                    @auth

                    <div class="flex items-center space-x-4 sm:space-x-6">
                    <!-- Real-time Clock -->
                    <div id="live-clock" class="text-right hidden sm:block">
                        <div class="font-semibold text-gray-700 dark:text-gray-300 text-lg" id="clock-time">17:40:26</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400" id="clock-date">Kamis, 20 November 2025</div>
                    </div>

                    <script>
                    // Function untuk update jam
                    function updateClock() {
                        const now = new Date();
                        
                        // Set timezone ke Indonesia (WIB, WITA, WIT)
                        const optionsTime = { 
                            timeZone: 'Asia/Jakarta',
                            hour12: false,
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        };
                        
                        const optionsDate = {
                            timeZone: 'Asia/Jakarta',
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        
                        // Format waktu dan tanggal
                        const timeString = now.toLocaleTimeString('id-ID', optionsTime);
                        const dateString = now.toLocaleDateString('id-ID', optionsDate);
                        
                        // Update DOM
                        document.getElementById('clock-time').textContent = timeString;
                        document.getElementById('clock-date').textContent = dateString;
                    }

                    // Update jam setiap detik
                    setInterval(updateClock, 1000);

                    // Jalankan sekali saat pertama load
                    updateClock();
                    </script>
                        <!-- Notifikasi Real-time -->
                        <button class="text-gray-500 hover:text-indigo-600 relative" aria-label="Notifikasi">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="bell" class="lucide lucide-bell w-6 h-6"><path d="M10.268 21a2 2 0 0 0 3.464 0"></path><path d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326"></path></svg>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                        </button>
                    </div>
                    <!-- Theme Toggle -->
                   <!-- <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400 hidden dark:block" fill="#13b4f1" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                        </svg>
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-400 block dark:hidden" fill="#13b4f1" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </button>-->

                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @endauth <!-- TAMBAHKAN INI -->
                </div>
            </div>
        </header
        

        
        <!-- Sidebar -->
        <div id="sidebar" class=" fixed inset-y-0 top-20 left-2 z-50  border-all transition-all duration-400 ease-in-out sidebar-expanded">

            <!-- Navigation Menu -->
            <nav class=" shadow-lg sm:rounded-lg  px-3 space-y-1 bg-white p-2">
                <!-- Dashboard -->
                <button id="toggleSidebar" class="px-3 border-0 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 duration-200">
                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400 transition-transform duration-300" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="" stroke-linejoin="" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                    </svg>
                </button>
                    <span class="text-lg font-semibold text-biru dark:text-white whitespace-nowrap overflow-hidden sidebar-logo-text p-1">
                        HRLara
                    </span>
                <hr>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Dashboard</span>
                </a>

                <!-- User -->
                <!--<a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a3 3 0 100-6 3 3 0 000 6zm0 2c-3 0-5 1.5-5 3v1h10v-1c0-1.5-2-3-5-3z" />
                    </svg>

                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">User</span>
                </a>-->

               <!-- Karyawan -->
                <a href="{{ route('karyawan.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Karyawan</span>
                </a>

                <!-- Jabatan Dan Akses -->
                <a href="{{ route('jabatan.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Jabatan & Akses</span>
                </a>

                <!-- Absensi -->
                <a href="{{ route('absensi.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Absensi</span>
                </a>

                <!-- Perizinan -->
                <a href="{{ route('perizinan.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Perizinan</span>
                </a>

                <!-- Pembayaran Lembur -->
                <a href="{{ route('honor.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="#13b4f1">
                        <rect x="3" y="3" width="18" height="18" rx="3" stroke-width="2"></rect>
                        <text x="12" y="16" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" font-weight="" fill="#13b4f1">Rp</text>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Pembayaran Lembur</span>
                </a>

                <!-- Penggajian -->
                <a href="{{ route('penggajian.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Penggajian</span>
                </a>

                <!-- Surat -->
                <a href="{{ route('surat.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Surat</span>
                </a>
            
                <!--Rekening Bank -->
                <a href="{{ route('rekening.index') }}" class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10l9-6 9 6v9a2 2 0 01-2 2H5a2 2 0 01-2-2v-9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 22V12h6v10" />
                    </svg>

                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">Rekening Bank</span>
                </a>
                
                <!-- Area -->
                <a href="{{ route('area.index') }}" 
                   class="flex items-center space-x-3 px-3 py-3 text-gray-700 dark:text-gray-300 rounded-lg 
                          hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200 group">
                
                    <!-- Icon Location -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="#13b4f1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11a3 3 0 100-6 3 3 0 000 6z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 2a9 9 0 00-9 9c0 5.25 9 11 9 11s9-5.75 9-11a9 9 0 00-9-9z"/>
                    </svg>
                
                    <span class="sidebar-text whitespace-nowrap overflow-hidden text-biru">
                        Area
                    </span>
                </a>

                
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="transition-all duration-300 ease-in-out main-content-expanded">
            <!-- Page Content -->
            <main class="p-2 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>

    </div>

    <!-- JavaScript untuk Sidebar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleButton = document.getElementById('toggleSidebar');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');
            const sidebarLogoText = document.querySelector('.sidebar-logo-text');
            const themeToggle = document.getElementById('theme-toggle');
            const toggleIcon = toggleButton.querySelector('svg');

            // Check initial state from localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            if (isCollapsed) {
                collapseSidebar();
            }

            // Toggle Sidebar
            toggleButton.addEventListener('click', function() {
                if (sidebar.classList.contains('sidebar-expanded')) {
                    collapseSidebar();
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    expandSidebar();
                    localStorage.setItem('sidebarCollapsed', 'false');
                }
            });

            function collapseSidebar() {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                mainContent.classList.remove('main-content-expanded');
                mainContent.classList.add('main-content-collapsed');
                toggleIcon.style.transform = 'rotate(180deg)';
                
                // Hide texts
                sidebarTexts.forEach(text => {
                    text.classList.add('hidden');
                });
                sidebarLogoText.classList.add('hidden');
            }

            function expandSidebar() {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                mainContent.classList.remove('main-content-collapsed');
                mainContent.classList.add('main-content-expanded');
                toggleIcon.style.transform = 'rotate(0deg)';
                
                // Show texts
                sidebarTexts.forEach(text => {
                    text.classList.remove('hidden');
                });
                sidebarLogoText.classList.remove('hidden');
            }

            // Theme Toggle
            themeToggle.addEventListener('click', function() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            });

            // Check saved theme
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    </script>
</body>
</html>