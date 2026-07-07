<x-master.layout 
    title="Temukan Beasiswa Impian Anda" 
    label="Jelajahi ribuan peluang beasiswa dari berbagai institusi terkemuka di Indonesia"
    >

    {{-- main content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filter -->
            <div class="lg:col-span-1">
                <form method="GET" action="/" class="space-y-6">
                    <!-- Search -->
                    <div class="sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Filter</h3>
                        
                        <div class="space-y-4">
                            <!-- Search Input -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Beasiswa</label>
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Nama, instansi..." 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Semua</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Dibuka</option>
                                    <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Ditutup</option>
                                </select>
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenjang</label>
                                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">Semua Jenjang</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Type Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Beasiswa</label>
                                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="all">Semua Jenis</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Buttons -->
                            <div class="flex gap-2 pt-4">
                                <button 
                                    type="submit" 
                                    class="flex-1 bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition"
                                >
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                                <a 
                                    href="{{ route('scholarships.index') }}" 
                                    class="flex-1 bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition text-center"
                                >
                                    <i class="fas fa-redo mr-2"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Scholarships Grid -->
            <div class="lg:col-span-3">
                <!-- Results Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Beasiswa Tersedia
                    </h2>
                    <div class="text-gray-600">
                        {{ $scholarships->total() }} hasil
                    </div>
                </div>

                <!-- Scholarships Grid -->
                @if($scholarships->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach($scholarships as $scholarship)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden border border-gray-200 flex flex-col h-full">
                                <!-- Card Header with Status Badge -->
                                <div class="relative bg-gradient-to-r from-blue-500 to-blue-600 p-4 text-white">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold mb-1">{{ $scholarship->name }}</h3>
                                            <p class="text-blue-100">{{ $scholarship->institution }}</p>
                                        </div>
                                        <div class="flex gap-2">
                                            @if($scholarship->isActive())
                                                <span class="bg-green-400 text-green-900 text-xs font-bold px-3 py-1 rounded-full">DIBUKA</span>
                                            @else
                                                <span class="bg-red-400 text-red-900 text-xs font-bold px-3 py-1 rounded-full">DITUTUP</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-4 space-y-4 flex-1">
                                    <!-- Type & Category -->
                                    <div class="flex gap-2 flex-wrap">
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded">
                                            {{ $scholarship->type }}
                                        </span>
                                        <span class="inline-block bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded">
                                            {{ $scholarship->category }}
                                        </span>
                                    </div>

                                    <!-- Description -->
                                    @if($scholarship->description)
                                        <p class="text-gray-700 text-sm line-clamp-2">
                                            {{ $scholarship->description }}
                                        </p>
                                    @endif

                                    <!-- Requirements -->
                                    @if($scholarship->requirements)
                                        <div class="border-t pt-4">
                                            <p class="text-sm font-semibold text-gray-900 mb-2">Persyaratan:</p>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                @foreach(array_slice(explode(',', $scholarship->requirements), 0, 2) as $req)
                                                    <li class="flex items-start">
                                                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                                                        <span>{{ trim($req) }}</span>
                                                    </li>
                                                @endforeach
                                                @if(count(explode(',', $scholarship->requirements)) > 2)
                                                    <li class="text-gray-500 italic">+{{ count(explode(',', $scholarship->requirements)) - 2 }} persyaratan lainnya</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- Dates -->
                                    <div class="border-t pt-4 grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-600 font-medium">Dibuka</p>
                                            <p class="text-gray-900 font-semibold">{{ $scholarship->open_date->format('d M Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600 font-medium">Ditutup</p>
                                            <p class="text-gray-900 font-semibold">{{ $scholarship->close_date->format('d M Y') }}</p>
                                            @if($scholarship->isActive())
                                                <p class="text-xs text-orange-600 font-medium mt-1">
                                                    Sisa {{ $scholarship->daysUntilClose() }} hari
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="px-4 py-4  bg-gray-50 border-t flex gap-2">
                                    <a 
                                        href="{{ $scholarship->application_link }}" 
                                        target="_blank" 
                                        class="flex-1 bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition text-center"
                                    >
                                        <i class="fas fa-external-link-alt mr-2"></i> Daftar
                                    </a>
                                    @if(auth()->check())
                                        <form action="{{ route('scholarships.toggleSave', $scholarship) }}" method="POST" class="flex-1">
                                            @csrf
                                            @php
                                                $isSaved = \App\Models\SavedScholarship::where('user_id', auth()->id())
                                                    ->where('scholarship_id', $scholarship->id)
                                                    ->exists();
                                            @endphp
                                            <button 
                                                type="submit" 
                                                class="w-full {{ $isSaved ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-300 hover:bg-gray-400' }} text-{{ $isSaved ? 'white' : 'gray-700' }} font-bold py-2 px-4 rounded-lg transition"
                                            >
                                                {{ $isSaved ? 'Hapus' : 'Simpan' }}
                                            </button>
                                        </form>
                                    @else
                                        <a 
                                            href="{{ route('login') }}" 
                                            class="flex-1 bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-400 transition text-center"
                                        >
                                            Simpan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center items-center">
                        <div class="flex justify-center">
                            {{ $scholarships->links() }}
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-search text-6xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada beasiswa ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                        <a href="{{ route('scholarships.index') }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition">
                            Lihat Semua Beasiswa
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>


</x-master.layout>