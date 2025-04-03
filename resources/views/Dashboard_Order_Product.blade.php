<x-layout-cruid-seller>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto mt-4 px-4 py-8">
    
        <!-- Tabel Products to be Shipped -->    
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-black">Products to be Shipped</h2>    
        </div>
        <div class="card-body bg-[rgb(236,222,210)]">
            <table class="min-w-full divide-y divide-gray-900">
                <thead class="bg-[rgb(136,77,38)]">
                    <tr>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Order ID</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Buyer's Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Total Product</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Total Price</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Shipping Address</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">HP Number</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Action</th>
                    </tr>
                </thead>
                
                @foreach ( $data_shipping as $dtshipping)
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtshipping->order_id}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtshipping->nama_pembeli}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtshipping->nama_product}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtshipping->jumlah_product}}</td>        
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">Rp {{number_format((float)$dtshipping->total_price,0,',','.')}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dtshipping->alamat_pengiriman }}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dtshipping->no_HP }}</td>
                                <td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                    <div class="d-flex justify-content-between mb-3">
                                        <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/shipping_product/{{$dtshipping->id}}/{{ $title }}'" >Shipping Product</button>
                                    </div>
                                    
                                </td>
                                
                            </tr>    
                        </tbody>
                @endforeach
            </table>
        </div>
    </div>


    <div class="container mx-auto mt-4 px-4 py-8">
    
        <!-- Tabel Products to be Shipped -->    
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-black">All Status Order</h2>    
        </div>
        <div class="card-body bg-[rgb(236,222,210)]">
            <table class="min-w-full divide-y divide-gray-900">
                <thead class="bg-[rgb(136,77,38)]">
                    <tr>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Order ID</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Buyer's Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Name</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Total Product</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Total Price</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Shipping Address</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">HP Number</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Status</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">No AWB Bill</th>
                    </tr>
                </thead>
                
                @foreach ( $all_status_order as $dt_all_status_order)
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_all_status_order->order_id}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_all_status_order->nama_pembeli}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_all_status_order->nama_product}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dt_all_status_order->jumlah_product}}</td>        
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">Rp {{number_format((float)$dt_all_status_order->total_price,0,',','.')}}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dt_all_status_order->alamat_pengiriman }}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dt_all_status_order->no_HP }}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dt_all_status_order->status_transaksi }}</td>
                                <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ $dt_all_status_order->AWB_Bill }}</td>
                            </tr>    
                        </tbody>
                @endforeach
            </table>
        </div>
    </div>





</x-layout-cruid-seller>
