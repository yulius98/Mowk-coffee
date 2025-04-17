<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>
            <div class="mt-20">
                <h3 class="text-lg font-bold leading-6 text-gray-900 mb-4">Promo Ads Image</h3>
                <div class=" bg-[rgb(240,222,209)] shadow-xl shadow-black  rounded-xl overflow-hidden transform p-6 max-w-md">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form id="productForm" class="space-y-6" action="/Carousel_Edit/{{ $nama_seller }}" method="post" enctype="multipart/form-data">
                        @csrf
                       
                        
                        @foreach ( $edit_Ads as $edit_carousel )
                        <div class="flex flex-col md:flex-row gap-6 w-full">
                            <!-- Hidden Inputs -->
                            
                            <input type="hidden" id="nama_seller" name="nama_seller" value="{{ $nama_seller }}"> 
                        
                            <!-- Form Section -->
                            <div class="flex-1 w-full space-y-6">
                                
                                <!-- Old Image Section -->
                                <div class="space-y-2 -mt-8">
                                    <label for="old_image" class="block text-sm font-bold text-black">Old Image:</label>
                                    <textarea 
                                        id="old_image" 
                                        name="old_image" 
                                        rows="2" 
                                        readonly 
                                        class="w-full p-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded resize-none overflow-auto"
                                    >{{ $edit_carousel->image }}</textarea>
                        
                                    <img 
                                        src="{{ asset('storage/' . $edit_carousel->image) }}" 
                                        alt="Old Product Image" 
                                        class="w-32 h-auto rounded border border-gray-300 shadow-sm object-cover"
                                    >
                                </div>
                        
                                <hr class="border-gray-300 shadow-sm shadow-black">
                        
                                <!-- New Image Upload -->
                                <div class="space-y-2">
                                    <label for="image" class="block text-sm font-bold text-black">New Image:</label>
                                    <input 
                                        type="file" 
                                        id="image" 
                                        name="image" 
                                        class="w-full text-sm border border-gray-300 rounded p-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                    >
                                </div>
                            </div>
                        </div>
                        
                        @endforeach

                        <div class="flex justify-end space-x-3 mt-5">
                            <button type="button" 
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/CRUIDSeller/{{ $nama_seller }}'">
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
