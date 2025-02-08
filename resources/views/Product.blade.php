<x-nav-bar/>
<x-layout>
     <!-- Products Grid -->
        <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($dt_product_not_login as $dt_product)
                <div class="card  bg-[rgb(238,233,229)] rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="card-body">
                        <img src="{{ asset('storage/'. $dt_product->image)}}" class="card-img-top h-56" alt="Produk Image">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 line-clamp-2 mb-2">{{ $dt_product->nama_product }}</h3>
                        <p class="text-lime-600 font-bold text-xl mb-4">Rp {{ number_format((float)$dt_product->price, 0, ',', '.') }}</p>
                        <a href="/Login"
                        class="block text-center bg-lime-600 text-white px-6 py-3 rounded-lg hover:bg-lime-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                            Login
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    
</x-layout>
