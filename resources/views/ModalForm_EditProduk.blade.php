<x-layout-cruid-seller>
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Produk Coffee Been</h3>
            <div class="bg-gray-200 rounded-xl shadow-lg overflow-hidden transform p-6 max-w-md">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (is_object($edit_produk))
                    
                    <form id="EditProductForm" class="space-y-4" method="post" enctype="multipart/form-data">    
                        @csrf
                        <input type="hidden" id="Id" name="Id" value="{{ $edit_produk->id }}">
                        <div>
                            <label class="block text-sm font-bold text-black">Product Name</label>
                            <input type="text" id="nama_product" name="nama_product" value="{{ $edit_produk->nama_product }}" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-black">Number of Product</label>
                            <input type="text" id="jumlah_product" name="jumlah_product" value="{{ $edit_produk->jumlah_product }}" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-black">Price</label>
                            <input type="text" id="price" name="price" value="{{ $edit_produk->price }}" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-black">Deskripsi</label>
                            <textarea id="description" name="description" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $edit_produk->description }}</textarea>
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
                            <button type="button"
                                    class="rounded-md bg-[#A14C36] px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322]" onclick="window.location.href='/edit_produk/{{$edit_produk->id}}'" >
                                    Save
                            </button>

                        </div>
                    </form>
                @endif
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
            document.getElementById('EditProductForm').submit();
        }
    }
</script>

