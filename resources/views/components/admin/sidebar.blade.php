<div class="drawer-side">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>

    <aside class="flex min-h-full flex-col
               bg-base-100 border-r border-base-300
               w-80">

        {{-- BRAND --}}
        <div class="flex items-center gap-4 px-6 py-5 border-b border-base-300">

            {{-- Logo (responsive, tidak dipaksa ukuran) --}}
            <div class="flex items-center justify-center max-w-[72px]">
                <img src="{{ asset('assets/bengkelkoding.webp') }}" alt="Logo"
                    class="max-h-12 max-w-full object-contain">
            </div>

            {{-- Text --}}
            <div>
                <h2 class="text-xl font-bold text-primary">
                    Admin Panel
                </h2>
                <p class="text-sm text-base-content/60">
                    Event Management
                </p>
            </div>
        </div>


        {{-- MENU --}}
        <ul class="menu w-full grow px-4 py-6 gap-2 text-base-content">

            {{-- DASHBOARD --}}
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl
                          {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10z" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            {{-- SECTION --}}
            <li class="menu-title mt-4">
                <span>Manajemen</span>
            </li>

            {{-- KATEGORI --}}
            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl
                          {{ request()->routeIs('admin.categories.*') ? 'bg-primary text-white' : 'hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2"
                            d="M4 4h6v6H4zm10 0h6v6h-6zM4 14h6v6H4zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0" />
                    </svg>
                    <span class="font-medium">Manajemen Kategori</span>
                </a>
            </li>

            {{-- EVENT --}}
            <li>
                <a href="{{ route('admin.events.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl
                          {{ request()->routeIs('admin.events.*') ? 'bg-primary text-white' : 'hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3a2 2 0 0 0 0-4V7a2 2 0 0 1 2-2" />
                    </svg>
                    <span class="font-medium">Manajemen Event</span>
                </a>
            </li>

            {{-- PAYMENT TYPE (NEW) --}}
            <li>
                <a href="{{ route('admin.payment-types.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl
                  {{ request()->routeIs('admin.payment-types.*') ? 'bg-primary text-white' : 'hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="M3 7h18v10H3zM3 11h18M7 15h2" />
                    </svg>
                    <span class="font-medium">Tipe Pembayaran</span>
                </a>
            </li>

            {{-- HISTORY --}}
            <li>
                <a href="{{ route('admin.histories.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl
                          {{ request()->routeIs('admin.histories.*') ? 'bg-primary text-white' : 'hover:bg-base-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span class="font-medium">History Pembelian</span>
                </a>
            </li>
        </ul>

        {{-- LOGOUT --}}
        <div class="p-4 border-t border-base-300">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-4 w-full
                               px-4 py-3 rounded-xl
                               text-error hover:bg-error/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M10 17v-2h4v-2h-4v-2l-5 3zM19 5H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-3h-2v3H5V7h14v3h2V7a2 2 0 0 0-2-2" />
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>

    </aside>
</div>
