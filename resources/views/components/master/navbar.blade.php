<nav class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16 relative">
        <!-- LOGO -->
        <div class="text-2xl font-bold text-blue-600">
            <i class="fas fa-graduation-cap"></i> BeasiswaTrack
        </div>

        <!-- TRICK: Checkbox tersembunyi buat trigger buka-tutup -->
        <input type="checkbox" id="menu-toggle" class="hidden peer">

        <label for="menu-toggle" class="md:hidden text-2xl text-gray-600 cursor-pointer p-2 z-50">
            <i class="fas fa-bars"></i>
        </label>

        <div class="hidden peer-checked:flex md:flex flex-col md:flex-row absolute md:static top-16 left-0 w-full md:w-auto bg-white md:bg-transparent p-4 md:p-0 gap-4 items-center shadow-lg md:shadow-none border-b md:border-none border-gray-100">
            <a href="/" class="{{ request()->is("/") ? "text-blue-600 font-medium" : "text-gray-700 font-medium" }}">Cari Beasiswa</a>
            <a href="/saved" class="{{ request()->is("saved") ? "text-blue-600 font-medium" : "text-gray-700 font-medium" }}">Disimpan</a>
            @guest
                <a href="{{ route('login') }}" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl">Login</a>
            @endguest
            @auth
                @if (auth()->user()->role?->nama_role === 'admin')
                    <a href="{{ url('/admin') }}"
                        class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-xl">
                        Admin
                    </a>
                @endif
                    <form method="POST" action="{{ route('logout') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-xl">Logout</button>
                    </form>
            @endauth
            
        </div>
    </div>
</nav>