<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>
        
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add Produk Coffee Been</h3>
            <div class="bg-[rgb(236,222,210)] rounded-xl shadow-lg overflow-hidden transform p-6 max-w-md">
                @if ($errors->any())
                    <div class="alert alert-danger">
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
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Product Name</label>
                        <input type="text" id="nama_product" name="nama_product" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Number of Product</label>
                        <input type="text" id="jumlah_product" name="jumlah_product" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Price</label>
                        <input type="text" id="price" name="price" required 
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
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/CRUIDSeller'">
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
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.classList.remove('hidden');
    }
</script>
