<x-nav-bar/>
<x-layout>
    <!-- Products Grid -->
    
    <div class="bg-[rgb(221,194,175)] pt-20"> <!-- Added pt-20 for top padding to prevent navbar overlap -->
        <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-0 lg:max-w-7xl lg:px-8"> <!-- Increased padding -->
          <h2 class="text-2xl font-bold tracking-tight text-gray-900 mt-2">Product Coffee Machine</h2> <!-- Added mb-6 for better spacing -->
        </div>    
        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach($dt_product_not_login as $dt_product)
                <div class="group relative">
                    <a href="/Login"
                        class="relative block text-center bg-[rgb(119,72,33)] text-white px-3 py-1 rounded-lg hover:bg-[rgb(155,120,91)] transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <img src="{{ asset('storage/'. $dt_product->image)}}" class="aspect-square w-full rounded-md bg-[rgb(240,180,140)] object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @if($dt_product->stock == 0)
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-md">
                                <span class="text-white text-2xl font-bold transform -rotate-45">Empty Stock</span>
                            </div>
                        @endif
                    </a>   
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-lg font-bold font-sans text-gray-800 line-clamp-2 mb-0 uppercase">{{ $dt_product->nama_product }}</h3>
                            <h4 class=" text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0">Stock : {{ $dt_product->stock }}</h4> 
                        </div>
                        <p class=" text-base font-medium text-gray-900">Rp {{ number_format((float)$dt_product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach    
            <!-- More products... -->
        </div>
        
    </div>    
</x-layout>

