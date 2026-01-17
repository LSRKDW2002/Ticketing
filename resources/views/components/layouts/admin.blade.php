<!DOCTYPE html>
<html lang="id" data-theme="adminTheme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    {{-- GANTI CDN → VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer lg:drawer-open w-full min-h-screen bg-base-200">

        {{-- TOGGLE (ID HARUS SAMA) --}}
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />

        {{-- CONTENT --}}
        <div class="drawer-content">

            {{-- NAVBAR --}}
            <nav class="navbar w-full bg-base-300 border-b border-base-300 px-4">
                <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                        stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                        class="my-1.5 inline-block size-5">
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                        </path>
                        <path d="M9 4v16"></path>
                        <path d="M14 10l2 2l-2 2"></path>
                    </svg>
                </label>

                <div class="flex-1 font-semibold">
                    {{ $title ?? 'Admin Dashboard' }}
                </div>
            </nav>

            {{-- PAGE CONTENT --}}
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>

        {{-- SIDEBAR (DIBIARKAN SEPERTI ASLINYA) --}}
        @include('components.admin.sidebar')

    </div>

    @stack('scripts')
</body>

</html>
