<x-layout-cruid-seller>

        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add Produk Coffee Been</h3>
            <form id="productForm" class="space-y-4" action="/CRUIDSeller" method="post">
                @csrf
                <input type="hidden" id="Id">
                
                <div>
                    <label class="block text-sm font-bold text-black">Product Name</label>
                    <input type="text" id="nama_product" name="nama_product" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-bold text-black">Number of Product</label>
                    <input type="text" id="jumlah_product" name="jumlah_product" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-bold text-black">Price</label>
                    <input type="text" id="price" name="price" required 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-bold text-black">Deskripsi</label>
                    <textarea id="description" name="description" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-bold text-black">Product Image</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(event)">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 4MB</p>
                            <img id="image-preview" class="mt-4 hidden" alt="Image Preview" style="width: 5rem; height: 5rem;" />
                        </div>
                    </div>
                </div>
      
                

                               
                <div class="flex items-center">
                    <input type="checkbox" id="produk_unggulan" name="produk_unggulan" value="1" 
                           class="rounded border-gray-300 font-bold text-black shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <label class="ml-2 block text-sm text-gray-900">Product Promo</label>
                </div>

                <div class="flex justify-end space-x-3 mt-5">
                    <button type="button" 
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Cancel
                    </button>
                    
                    <button type="submit" 
                            class="rounded-md bg-[#A14C36] px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322]">
                            Save
                    </button>

                </div>
            </form>
        </div>
    
</x-layout-cruid-seller>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.classList.remove('hidden');
    }
</script>
