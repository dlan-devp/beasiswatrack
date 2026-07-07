    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @auth
            <h1 class="text-4xl font-bold mb-4">
                Halo, {{ Auth::user()->name }}
            </h1>
            @endauth
            <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
            <p class="text-lg text-blue-100 mb-8">{{ $label }}</p>
        </div>
    </div>