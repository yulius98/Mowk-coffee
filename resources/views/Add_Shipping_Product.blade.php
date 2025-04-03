<x-layout-cruid-seller>
    <x-slot:title>{{ $dttitle }}</x-slot:title>
            
        <div class="mt-16">
            <h3 class="text-2xl font-bold text-black">Add Shipping Produk</h3>
            <div class="bg-[rgb(236,222,210)] rounded-xl shadow-lg overflow-hidden transform max-w-md mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger text-red-500 text-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (is_object($dt_shipping))
                    <form id="Add_AWB_Bill" class="space-y-6" action="/add_awb_bill/{{$dttitle}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div>
                            <label class="block text-sm font-bold text-black ml-2">Buyer's Name : {{ strtoupper($dt_shipping->nama_pembeli) }}</label>
                            <label class="block text-sm font-bold text-black ml-2">Product Name : {{ $dt_shipping->nama_product }}</label>
                            <label class="block text-sm font-bold text-black ml-2">Total Product : {{ $dt_shipping->jumlah_product }}</label>
                            <label class="block text-sm font-bold text-black ml-2">Total Price : Rp {{number_format((float)$dt_shipping->total_price,0,',','.')}}</label>
                            <label class="block text-sm font-bold text-black ml-2">Shipping Address : {{ $dt_shipping->alamat_pengiriman }}</label>
                            <label class="block text-sm font-bold text-black ml-2">Contact Number : {{ $dt_shipping->no_HP }}</label>
                        </div>

                        <div class="border-t border-black my-4">
                            <div class="flex items-center justify-between mt-4">
                                <label for="no_awb" class="text-sm font-bold text-black ml-2">No. AWB Bill : </label>
                                <input type="text" name="no_awb" id="no_awb" class="border border-gray-300 rounded-md mr-20 px-1 py-1 focus:outline-none focus:ring-2 focus:ring-[#A14C36] focus:border-transparent w-1/2" placeholder="No. AWB Bill" required>
                                <input type="hidden" id="id" name="id" value="{{ $dt_shipping->id }}">
                            </div>
                               
                            <div class="flex justify-end space-x-3 mr-2 mt-4 mb-2">
                                <button type="button" 
                                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/CRUIDSeller/{{$dttitle}}'">
                                    Cancel
                                </button>
                                
                                <button type="submit" 
                                        class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322]">
                                        Save
                                </button>
                            </div>
                            
                        </div>

                    </form>
                @endif
            </div>
        </div>
    
</x-layout-cruid-seller>
