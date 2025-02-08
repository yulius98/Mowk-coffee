<x-layout-login>
<x-slot:title>{{ $title }}</x-slot:title>
<div>
    <body>
    <a class="rounded-md px-3 py-2 text-sm font-medium text-gray-300">{{ $user->name }}</a>
    <a class="rounded-md px-3 py-2 text-sm font-medium text-gray-300">{{ $user->id }}</a>
    {{-- Tambahkan konten lain sesuai kebutuhan --}}
</body>
</div>
<div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($product as $dataproduct)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="relative">
                        <img src="{{ asset('storage/'. $dataproduct->image)}}" alt="Produk Image"
                            class="w-auto h-56">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 line-clamp-2 mb-0">{{ $dataproduct->nama_product }}</h3>
                        <h4 class="text-base font-light text-gray-800 line-clamp-2 mb-0">Stock : {{ $dataproduct->jumlah_product }}</h4> 
                        <h5 class="text-lime-600 font-bold text-xl mb-1">Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</h5>
                        <p class="text-base font-light text-gray-800 mb-1">{{ Str::limit($dataproduct->description, 100) }}</p>
                        <a href="#"
                        class="block text-center bg-lime-600 text-white px-6 py-3 rounded-lg hover:bg-lime-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5 mb-2">
                            View Detail
                        </a>
                        
                        <a href="#"
                        class="block text-center bg-lime-600 text-white px-6 py-3 rounded-lg hover:bg-lime-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                            Buy Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
</x-layout-login>

