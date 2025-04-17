<x-nav-bar-login :pendingCount="$count_shopping_cart" :title="$title" :user="$user" />
<x-layout-login>

    <section id="hero" class="mt-16 bg-[rgb(221,194,175)] p-20">
        <div id="heroCarousel" class="relative w-full rounded-3xl shadow-2xl shadow-black overflow-hidden">
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

            <div class="flex  transition-transform duration-500 ease-in-out" id="carouselItems">
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

 
    <div class="bg-[rgb(221,194,175)] p-20">
        <div class="mx-auto max-w-2xl px-4 py-8 sm:px-6 sm:py-0 lg:max-w-7xl lg:px-8 ">   
            <h2 class="text-4xl font-bold tracking-tight text-black text-center">Product Mowks Coffee </h2> <!-- Added mb-6 for better spacing -->
        </div>

    <!-- Product list -->
        {{ $product->links() }}
        @foreach($product as $dataproduct)
            <form id="product" class="space-y-6" action="/addshoppingcart" method="post" enctype="multipart/form-data">
                @csrf
            <div class="container mx-auto px-4 py-8 mt-4">
                <div class=" bg-transparent rounded-2xl shadow-black shadow-2xl overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8">
                        <!-- Product Image Section -->
                        <div class="rounded-2xl overflow-hidden bg-transparent shadow-2xl border border-slate-400 ">
                            <div class="flex justify-center items-center p-4">
                                <img src="{{ asset('storage/'. $dataproduct->image)}}" 
                                    alt="" class="w-fit rounded-2xl bg-[rgb(240,180,140)] object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" >
                            </div>
                        </div>

                        <!-- Details Product -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold font-serif text-gray-800 line-clamp-2 mb-0 uppercase">{{ $dataproduct->nama_product }}</h3>
                            @if ($dataproduct->discount == "yes")
                                <div class="flex items-center gap-8">
                                    <h4 class="text-base font-bold  text-green-500 line-through"><del>Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</del></h4>
                                    <h5 class=" text-lg font-bold text-black">Rp {{ number_format((float)$dataproduct->discount_price, 0, ',', '.') }}</h5>
                                </div>
                            @elseif ($dataproduct->discount == "no")
                                <h5 class="text-base font-medium text-black">Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</h5>    
                            @endif

                            <h6 class="text-lg font-thin font-serif text-gray-800 line-clamp-2 mb-0">Stock : {{ $dataproduct->stock }}</h6> 
                            <h7 class="text-lg font-thin font-serif text-gray-800 line-clamp-2 mb-0"> Description : {{ Str::limit($dataproduct->description,100)}}</h7>
                            <a 
                                href="#" data-product-id="{{ $loop->index }}" 
                                onclick="showModal(event, {{ $loop->index }}, '{{ $dataproduct->nama_product }}', '{{ $dataproduct->description }}')" 
                                class="text-sm 
                                      font-thin 
                                      font-serif 
                                      text-gray-400 
                                      line-clamp-2 
                                      mb-0
                                      mr-2 
                                      transition duration-300 
                                      ease-in-out
                                      hover:text-[rgb(18,18,18)] 
                                      transform hover:-translate-y-0.5"
                            >...detail
                            </a>


                            <!-- data parameter yang akan dikirimkan ke controller -->
                            <input type="hidden" id="nama_pembeli" name="nama_pembeli" value="{{ $user }}">
                            <input type="hidden" id="nama_product" name="nama_product" value="{{ $dataproduct->nama_product }}">
                            <input type="hidden" id="jumlah_product" name="jumlah_product" value="1">

                            @if ($dataproduct->discount == "yes")
                                <input type="hidden" id="total_price" name="total_price" value="{{ $dataproduct->discount_price }}">
                            @elseif ($dataproduct->discount == "no")
                                <input type="hidden" id="total_price" name="total_price" value="{{ $dataproduct->price }}">
                            @endif

                            <div class="border-t border-black mt-4"></div>
                            <div class="flex items-center">
                                <label for="quantity" class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mt-5">Quantity : </label>
                                <button type="button" class="decrease bg-gray-300 px-2 py-1 rounded-l mx-4 mt-5">-</button>
                                <span id="quantity" class="mx-0 mt-5">1</span>
                                <button type="button" class="increase bg-gray-300 px-2 py-1 rounded-r mx-4 mt-5" data-stock="{{ $dataproduct->stock }}">+</button>
                            </div>
                            
                            @if ($dataproduct->discount == "yes")
                                <h8 id="total-price" class="text-[rgb(36,99,113)] font-bold text-lg mt-15">Total Price: Rp {{ number_format((float)$dataproduct->discount_price, 0, ',', '.') }}</h8>
                            @elseif ($dataproduct->discount == "no")
                                <h8 id="total-price" class="text-[rgb(36,99,113)] font-bold text-lg mt-15">Total Price: Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</h8>
                            @endif
                            
                            <button type="submit" class="block text-center bg-[rgb(119,72,33)] text-white px-3 py-1 rounded-lg hover:bg-[rgb(155,120,91)] transform transition duration-300 hover:scale-105 hover:shadow-xl">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        @endforeach
    </div>
</div>
</x-layout-login>

<script>
    document.querySelectorAll('.increase').forEach(button => {
        button.addEventListener('click', function() {
            const quantityLabel = button.parentElement.querySelector('#quantity');
            const totalPriceLabel = button.parentElement.parentElement.querySelector('#total-price');
            const jumlahProductInput = button.parentElement.parentElement.querySelector('#jumlah_product');
            const totalPriceInput = button.parentElement.parentElement.querySelector('#total_price');
            let quantity = parseInt(quantityLabel.textContent);
            const stock = parseInt(button.getAttribute('data-stock'));
            const price = parseFloat(button.parentElement.parentElement.querySelector('h5').textContent.replace(/[^0-9,-]+/g,""));
            if (quantity < stock) {
                quantityLabel.textContent = quantity + 1;
                jumlahProductInput.value = quantity + 1;
                totalPriceInput.value = price * (quantity + 1);
                totalPriceLabel.textContent = 'Total Price: Rp ' + new Intl.NumberFormat('id-ID').format(price * (quantity + 1));
            }
        });
    });

    document.querySelectorAll('.decrease').forEach(button => {
        button.addEventListener('click', function() {
            const quantityLabel = button.parentElement.querySelector('#quantity');
            const totalPriceLabel = button.parentElement.parentElement.querySelector('#total-price');
            const jumlahProductInput = button.parentElement.parentElement.querySelector('#jumlah_product');
            const totalPriceInput = button.parentElement.parentElement.querySelector('#total_price');
            let quantity = parseInt(quantityLabel.textContent);
            const price = parseFloat(button.parentElement.parentElement.querySelector('h5').textContent.replace(/[^0-9,-]+/g,""));
            if (quantity > 1) {
                quantityLabel.textContent = quantity - 1;
                jumlahProductInput.value = quantity - 1;
                totalPriceInput.value = price * (quantity - 1);
                totalPriceLabel.textContent = 'Total Price: Rp ' + new Intl.NumberFormat('id-ID').format(price * (quantity - 1));
            }
        });
    });
</script>

<!-- Improved Modal Container -->
<div id="modalsContainer">
    @foreach($product as $index => $dataproduct)
    <div id="modal-{{ $index }}" class="detail-modal hidden fixed inset-0 z-50">
        <!-- Modal Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        
        <!-- Modal Content -->
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <!-- Modal Header -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-xl font-semibold leading-6 text-gray-900 modal-title mb-4"></h3>
                                <div class="mt-2">
                                    <p class="text-base text-gray-500 modal-description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button onclick="closeModal({{ $index }})" class="mt-3 inline-flex w-full justify-center rounded-md bg-[rgb(119,72,33)] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[rgb(155,120,91)] sm:mt-0 sm:w-auto transition duration-300 ease-in-out transform hover:scale-105">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
    let activeModal = null;

    function showModal(event, productId, title, description) {
        event.preventDefault();
        
        // Hide any active modals
        document.querySelectorAll('.detail-modal').forEach(modal => {
            modal.classList.add('hidden');
        });

        const modal = document.getElementById(`modal-${productId}`);
        
        // Set modal content
        modal.querySelector('.modal-title').textContent = title;
        modal.querySelector('.modal-description').textContent = description;
        
        activeModal = modal;
        
        // Show modal with fade effect
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.bg-black').classList.add('opacity-50');
        }, 10);

        // Prevent body scroll when modal is open
        document.body.style.overflow = 'hidden';
    }

    function closeModal(productId) {
        const modal = document.getElementById(`modal-${productId}`);
        
        // Fade out effect
        modal.querySelector('.bg-black').classList.remove('opacity-50');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            activeModal = null;
            // Restore body scroll
            document.body.style.overflow = '';
        }, 200);
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (activeModal && !event.target.closest('.modal-content') && !event.target.closest('[data-product-id]')) {
            const productId = activeModal.id.split('-')[1];
            closeModal(productId);
        }
    });

    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && activeModal) {
            const productId = activeModal.id.split('-')[1];
            closeModal(productId);
        }
    });
</script>

