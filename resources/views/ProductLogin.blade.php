<x-layout-login>   
<x-nav-bar-login :pendingCount="$count_shopping_cart" :title="$title" :user="$user" />
<div>
    <body>
        <a class="rounded-md px-3 py-2 text-sm font-medium text-[rgb(240,180,140)]">{{ $user }}</a>
    </body>
</div>
<div id="product-list" class="grid grid-cols-1 sm:grid-cols-4 sd:grid-cols-4 lg:grid-cols-16 gap-4 ml-8 mr-8 mt-10 rounded-2xl">
    @foreach($product as $dataproduct)
    <form id="product" class="space-y-6" action="/addshoppingcart" method="post" enctype="multipart/form-data">
        @csrf
        <div class="group relative w-fit bg-[rgb(236,222,210)] rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="group relative">
                <img src="{{ asset('storage/'. $dataproduct->image)}}" alt="Produk Image" class="size-auto rounded-md object-cover object-center rounded-t-xl bg-[rgb(240,180,140)] group-hover:opacity-75">
            </div>
            <div class="p-2">
                <h3 class="text-lg font-thin font-serif text-gray-800 line-clamp-2 mb-0 uppercase">{{ $dataproduct->nama_product }}</h3>
                <h4 class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0">Stock : {{ $dataproduct->stock }}</h4> 
                <h5 class="text-[rgb(45,120,137)] font-bold text-lg mb-0">Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</h5>

                <!-- data parameter yang akan dikirimkan ke controller -->
                <input type="hidden" id="nama_pembeli" name="nama_pembeli" value="{{ $user }}">
                <input type="hidden" id="nama_product" name="nama_product" value="{{ $dataproduct->nama_product }}">
                <input type="hidden" id="jumlah_product" name="jumlah_product" value="1">
                <input type="hidden" id="total_price" name="total_price" value="{{ $dataproduct->price }}">

                <div class="flex items-center mt-2">
                    <label for="quantity" class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0">Quantity</label>
                    <button type="button" class="decrease bg-gray-300 px-2 py-1 rounded-l mx-4">-</button>
                    <span id="quantity" class="mx-0">1</span>
                    <button type="button" class="increase bg-gray-300 px-2 py-1 rounded-r mx-4" data-stock="{{ $dataproduct->stock }}">+</button>
                </div>

                <h5 id="total-price" class="text-[rgb(45,120,137)] font-bold text-lg mb-0">Total Price: Rp {{ number_format((float)$dataproduct->price, 0, ',', '.') }}</h5>
                <h7 class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0">{{ Str::limit($dataproduct->description,50)}}</h7>
                <a href="#" data-product-id="{{ $loop->index }}" onclick="showModal(event, {{ $loop->index }}, '{{ $dataproduct->nama_product }}', '{{ $dataproduct->description }}')" class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0 transition duration-300 ease-in-out transform hover:-translate-y-0.5">...detail</a>
                
                <button type="submit" class="block text-center bg-[rgb(119,72,33)] text-white px-3 py-1 rounded-lg hover:bg-[rgb(155,120,91)] transform transition duration-300 hover:scale-105 hover:shadow-xl">
                    Add to Cart
                </button>
            </div>
        </div>
    </form>
    @endforeach
</div>

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
</x-layout-login>
