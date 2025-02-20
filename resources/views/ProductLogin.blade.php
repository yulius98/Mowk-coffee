<x-layout-login>   

<x-nav-bar-login :pendingCount="$count_shopping_cart" :title="$title" :user="$user" />
<div>
    <body>
        <a class="rounded-md px-3 py-2 text-sm font-medium text-[rgb(240,180,140)]">{{ $user }}</a>
    </body>
</div>
<div id="product-list" class="grid grid-cols-1 sm:grid-cols-4 sd:grid-cols-3 lg:grid-cols-16 gap-4">
    @foreach($product as $dataproduct)
    <form id="product" class="space-y-6" action="/addshoppingcart" method="post" enctype="multipart/form-data">
        @csrf
        <div class="group relative bg-[rgb(236,222,210)] rounded-xl shadow-lg overflow-hidden">
            <div class="group relative">
                <img src="{{ asset('storage/'. $dataproduct->image)}}" alt="Produk Image" class="aspect-square w-full object-cover object-center rounded-t-xl bg-[rgb(240,180,140)] group-hover:opacity-75">
            </div>
            <div class="p-2">
                <h3 class="text-lg font-thin font-serif text-gray-800 line-clamp-2 mb-0">{{ $dataproduct->nama_product }}</h3>
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
                <h7 class="text-sm font-thin font-serif text-gray-800 line-clamp-2 mb-0">{{ Str::limit($dataproduct->description)}}</h7>
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

<div id="modalsContainer">
    @foreach($product as $index => $dataproduct)
    <div id="modal-{{ $index }}" class="detail-modal hidden fixed bg-white border rounded-lg shadow-lg z-[9999] p-4 w-64">
        <h3 class="text-lg font-medium leading-6 text-gray-900 modal-title"></h3>
        <p class="text-sm text-gray-500 mt-2 modal-description"></p>
        <button onclick="closeModal({{ $index }})" class="mt-3 px-3 py-1 bg-[rgb(119,72,33)] text-white text-sm rounded-md hover:bg-[rgb(155,120,91)] focus:outline-none focus:ring-2 focus:ring-gray-300">
            Close
        </button>
    </div>
    @endforeach
</div>

<script>
    let activeDetailLink = null;
    let activeModal = null;

    function showModal(event, productId, title, description) {
        event.preventDefault();
        
        document.querySelectorAll('.detail-modal').forEach(modal => {
            modal.classList.add('hidden');
        });

        const detailLink = event.target;
        const modal = document.getElementById(`modal-${productId}`);
        
        modal.querySelector('.modal-title').textContent = title;
        modal.querySelector('.modal-description').textContent = description;
        
        activeDetailLink = detailLink;
        activeModal = modal;
        
        updateModalPosition();
        
        modal.classList.remove('hidden');
    }

    function updateModalPosition() {
        if (activeDetailLink && activeModal) {
            const linkRect = activeDetailLink.getBoundingClientRect();
            activeModal.style.left = `${linkRect.right + 0.1}px`;
            activeModal.style.top = `${linkRect.top}px`;
        }
    }

    function closeModal(productId) {
        document.getElementById(`modal-${productId}`).classList.add('hidden');
        activeDetailLink = null;
        activeModal = null;
    }

    document.addEventListener('click', function(event) {
        if (!event.target.closest('.detail-modal') && !event.target.closest('[data-product-id]')) {
            document.querySelectorAll('.detail-modal').forEach(modal => {
                modal.classList.add('hidden');
            });
            activeDetailLink = null;
            activeModal = null;
        }
    });

    window.addEventListener('scroll', updateModalPosition);
</script>
</x-layout-login>
