<x-layout-cruid-seller>
<x-slot:title>{{ $title }}</x-slot:title>
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Promo Ads</h3>
            <div class="bg-[rgb(240,222,209)] rounded-xl shadow-lg overflow-hidden transform p-6 max-w-md">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="productForm" class="space-y-6" action="/Carousel" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="Id">
                    
                    <div class="col-span-full">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                          Promo Ads Image
                        </label>
                        <div class="space-y-4">
                          <input 
                            type="file" 
                            id="image" 
                            name="image"
                            class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                          >
                          
                          <input 
                            type="hidden" 
                            id="nama_seller" 
                            name="nama_seller" 
                            value="{{ $nama_seller }}"
                            class="hidden"
                          >
                        </div>
                      </div>
                      
                      <div class="flex justify-end space-x-3 mt-6">
                        <button 
                          type="button" 
                          onclick="window.location.href='/CRUIDSeller'" 
                          class="px-4 py-2 rounded-md text-sm font-medium bg-gray-500 text-white hover:bg-gray-600 transition-colors duration-200"
                        >
                          Cancel
                        </button>
                        
                        <button 
                          type="submit" 
                          class="px-4 py-2 rounded-md text-sm font-semibold bg-[#A14C36] text-white hover:bg-[#723322] shadow-md transition-colors duration-200"
                        >
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

