<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>
            
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mt-20">Add Produk {{ $category }}</h3>
            <div class="bg-[rgb(236,222,210)] rounded-xl shadow-lg overflow-hidden transform p-6 max-w-md">
                @if ($errors->any())
                    <div class="alert alert-danger text-red-500 text-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="productForm" class="space-y-6" action="/CRUIDSeller" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <input type="hidden" id="nama_seller" name="nama_seller" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2" value="{{ $nama_seller }}">
                        <input type="hidden" id="jenis_product" name="jenis_product" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2" value="{{ $category }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Product Name</label>
                        <input type="text" id="nama_product" name="nama_product" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Product Stock</label>
                        <input type="number" id="jumlah_product" name="jumlah_product" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Price</label>
                        <input type="number" id="price" name="price" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-black">Deskripsi</label>
                        <textarea id="description" name="description" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"></textarea>
                    </div>
                    <div class="col-span-full">
                        <label for="image" class="block text-sm font-bold text-black">Product Image</label>
                        <div class="mb-3">
                            
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-5">
                        <button type="button" 
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/CRUIDSeller/{{$nama_seller}}'">
                            Cancel
                        </button>
                        
                        <button type="submit" 
                                class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322]">
                                Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    
</x-layout-cruid-seller>

<script>
    // Function to check if the image input is empty
    function validateForm() {
        const imageInput = document.getElementById('image');
        
        if (imageInput.files.length === 0) {
            alert('Please select a product image!');
        } else {
            // Submit the form if the image is selected
            
            document.getElementById('productForm').submit();
        }
    }
</script>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.classList.remove('hidden');
    }
</script>
