<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>
            
        <div class="mt-3">
            <h3 class=" font-bold text-lg leading-6 text-black mt-20">Add Event</h3>
            <div class="bg-[rgb(236,222,210)] rounded-xl shadow-lg shadow-black overflow-hidden transform p-6 max-w-md">
                @if ($errors->any())
                    <div class="alert alert-danger text-red-500 text-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="AddEventForm" class="space-y-6" action="/add_event/{{ $title }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <input type="hidden" id="nama_seller" name="nama_seller" class="mt-1 block" value="{{ $title }}">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Event Date</label>
                        <input type="date" id="date_event" name="date_event" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Event Time</label>
                        <input type="time" id="time_event" name="time_event" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Event Name</label>
                        <input type="text" id="name_event" name="name_event" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Event Description</label>
                        <textarea id="description_event" name="description_event" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Event Venues</label>
                        <input type="text" id="location_event" name="location_event" required 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Ticket</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" id="ticket_free" name="tiket" value="free" required
                                    class="text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-black">Free</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" id="ticket_paid" name="tiket" value="paid"
                                    class="text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-black">Paid</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-black">Price</label>
                        <input type="number" id="harga_tiket" name="harga_tiket"  
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2">
                    </div>

                    <div class="col-span-full">
                        <label for="image" class="block text-sm font-bold text-black">Image</label>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="image_event" name="image_event">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-5">
                        <button type="button" 
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/CRUIDSeller/{{$title}}'">
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
