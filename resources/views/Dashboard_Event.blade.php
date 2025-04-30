<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <div class="container mx-auto mt-4 px-4 py-8">
    
        <!-- Tabel Products to be Shipped -->    
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-black">Event Participant List</h2>    
        </div>
        <div class="card-body bg-transparent ">
            <table class="min-w-full divide-y divide-gray-900">
                <thead class="bg-[rgb(136,77,38)]">
                    <tr>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Participant Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Email</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Participant Address</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Phone Number</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Payment Status</th>
                        
                    </tr>
                </thead>
                
                @foreach ( $data_peserta_event as $dt_peserta_event)
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->name_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->nama_peserta}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->email_peserta}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->alamat_peserta}}</td>        
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->no_HP}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_peserta_event->status_pembanyaran }}</td>
                                
                                {{--<td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                    <div class="d-flex justify-content-between mb-3">
                                        <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/shipping_product/{{$dtshipping->id}}/{{ $title }}'" >Shipping Product</button>
                                    </div>
                                    
                                </td> --}}
                                
                            </tr>    
                        </tbody>
                @endforeach
            </table>
        </div>
    </div>


    <div class="container mx-auto mt-4 px-4 py-8">
       
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-black">List of Events</h2>
            <div class="flex items-center gap-4">
                <button type="button" 
                        class="bg-[#A14C36] hover:bg-[#723322] text-white px-4 py-2 rounded-lg shadow-sm transition duration-150" onclick="window.location.href='/add_event/{{ $title }}'">
                    Add Event 
                </button>
            </div>    
        </div>
        <div class="card-body bg-transparent">
            <table class="min-w-full divide-y divide-gray-900">
                <thead class="bg-[rgb(136,77,38)]">
                    <tr>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Date</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Time</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Description</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Event Venues</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Ticket</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Price</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Image</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Action</th>
                    </tr>
                </thead>
                
                @foreach ( $data_event as $dt_list_event)
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->date_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->time_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->name_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->description_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->location_event}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_list_event->tiket}}</td>        
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">Rp {{number_format((float)$dt_list_event->harga_tiket,0,',','.')}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">
                                    <img src="{{ asset('storage/'. $dt_list_event->image_event)}}" alt="image_event" class="w-[20%] h-auto object-cover">
                                </td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">
                                    <div class="d-flex justify-content-between mb-3">
                                        <button type="button" class="gap-x-1.5 rounded-full shadow-2xl bg-[#A14C36] hover:bg-[#723322] px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-800 " onclick="window.location.href='/edit_even/{{$dt_list_event->id}}/{{ $title }}'" >Edit</button>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/delete_even/{{$dt_list_event->id}}/{{ $title }}'" >Delete</button>
                                    </div>
                                </td>
                                
                            </tr>    
                        </tbody>
                @endforeach
            </table>
        </div>
    </div> 





</x-layout-cruid-seller>

