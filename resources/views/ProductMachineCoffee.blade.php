<x-nav-bar/>
<x-layout>
    <section id="hero" class="mt-16 bg-[rgb(221,194,175)]">
        <div id="heroCarousel" class="relative w-full rounded-3xl shadow-2xl overflow-hidden">
            <!-- Carousel Indicators -->
            <div class="absolute bottom-4 left-1/2 z-10 flex -translate-x-1/2 space-x-2">
                @foreach ($Carousel as $key => $Ads)
                    <button type="button" 
                        class="h-2 w-2 rounded-full bg-white/50 hover:bg-white/80 transition-colors duration-200"
                        data-carousel-indicator="{{ $key }}"
                        aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>
    
            <div class="flex transition-transform duration-500 ease-in-out" id="carouselItems">
                @foreach ($Carousel as $key => $Ads)
                    <div class="min-w-full relative" data-carousel-item="{{ $key }}">
                        <img src="{{ asset('storage/'. $Ads->image) }}" 
                             class="w-full h-96 md:h-[500px] object-cover" 
                             alt="Slide {{ $key + 1 }}">
                        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                    </div>
                @endforeach
            </div>
    
            <!-- Previous Control -->
            <button class="absolute left-0 top-1/2 -translate-y-1/2 p-4 bg-black bg-opacity-30 hover:bg-opacity-50 transition-colors duration-200" 
                    type="button" 
                    data-carousel-prev id="prevButton">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="sr-only">Previous</span>
            </button>
    
            <!-- Next Control -->
            <button class="absolute right-0 top-1/2 -translate-y-1/2 p-4 bg-black bg-opacity-30 hover:bg-opacity-50 transition-colors duration-200" 
                    type="button" 
                    data-carousel-next id="nextButton">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </section>
    
    <script>
        const carouselItems = document.getElementById('carouselItems');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const totalItems = carouselItems.children.length;
        let currentIndex = 0;

        function updateCarousel() {
            const offset = -currentIndex * 100;
            carouselItems.style.transform = `translateX(${offset}%)`;
        }

        prevButton.addEventListener('click', () => {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalItems - 1;
            updateCarousel();
        });

        nextButton.addEventListener('click', () => {
            currentIndex = (currentIndex < totalItems - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        });
    </script>

    
    <!-- Products Grid -->
    <div class="bg-[rgb(221,194,175)] pt-20"> <!-- Added pt-20 for top padding to prevent navbar overlap -->
        <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-0 lg:max-w-7xl lg:px-8 "> <!-- Increased padding -->
            <h2 class="text-2xl font-bold tracking-tight text-black mt-0 text-center">Coffee Machine</h2> <!-- Added mb-6 for better spacing -->
        </div>    
        
        {{ $dt_product_not_login->links() }}

        <div class=" grid grid-cols-1 gap-x-4 gap-y-8 sm:mt-4 lg:mx-0 lg:max-w-none lg:grid-cols-3 ">
            @foreach($dt_product_not_login as $dt_product)
                <div class=" p-2 bg-[rgb(236,220,208)] group relative border border-[rgb(236,220,208)] rounded-2xl shadow-lg shadow-black overflow-hidden hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                    <a href="/Login"
                        class="relative block text-center bg-transparent text-white px-3 py-1 rounded-xl hover:bg-[rgb(236,220,208)] transform transition duration-300 hover:scale-105 hover:shadow-xl">
                        <div
                            class="absolute right-4 text-white text-xs font-bold px-3 py-1 rounded-full 
                            {{ $dt_product->stock > 0 ? 'bg-[#754014]' : 'bg-[#331C09]' }}">
                            {{ $dt_product->stock > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                        </div>
                        <img src="{{ asset('storage/'. $dt_product->image)}}" class="aspect-square w-full rounded-md bg-[rgb(240,180,140)] object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                        @if($dt_product->stock == 0)
                        <div class=" absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-md">
                            <span class=" text-white text-2xl font-bold transform rotate-0 sm:-rotate-45">Empty Stock</span>
                        </div>
                        @endif
                    </a>   
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-base font-bold font-sans text-black line-clamp-2 ml-2 uppercase">{{ $dt_product->nama_product }}</h3>
                            <h4 class="text-sm font-thin font-serif text-black line-clamp-2 ml-2">Stock : {{ $dt_product->stock }}</h4> 
                        </div>
                        <p class=" text-base font-medium text-black mr-2">Rp {{ number_format((float)$dt_product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach    
        </div>
    </div>    
</x-layout>

