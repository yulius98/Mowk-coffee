<x-layout-cruid-seller>
<x-slot:title>{{ $title }}</x-slot:title>
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Produk Coffee Been</h3>
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
                @if (is_object($edit_produk))
                    
                    <form id="EditProductForm" class="space-y-4" action="/edit_produk/{{$edit_produk->id}}/{{ $user }}"   method="post" enctype="multipart/form-data">    
                        @csrf
                        <input type="hidden" id="Id" name="Id" value="{{ $edit_produk->id }}">
                        <div>
                            <label class="block text-sm font-bold text-black">Product Name</label>
                            <label class="block text-sm font-normal text-black">{{ $edit_produk->nama_product }}</label>
                            <input type="hidden" id="nama_product" name="nama_product" value="{{ $edit_produk->nama_product }}"  
                                class="mt-1 block w-full rounded-md border-[rgb(236,222,210)] shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-black">Price</label>
                            <input type="number" id="price" name="price" value="{{ $edit_produk->price }}" required 
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
                                    class="bg-[#9b6c60] text-white px-4 py-2 rounded-md hover:bg-[#54372f]" onclick="window.location.href='/CRUIDSeller/{{ $user }}'">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="rounded-md bg-[#A14C36] px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322]" >
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

