<x-layout-cruid-seller>
<x-slot:title>{{ $title }}</x-slot:title>
<div>
    <body>
        <a class="rounded-md px-3 py-2 text-sm font-medium text-[rgb(240,180,140)]">{{ $user }}</a>
    </body>
</div>
<!-- Produk Promo -->    
<div class="container mx-auto px-4 py-8" >
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">Product Ads</h2>
        <div class="flex items-center gap-4">
            <button type="button"
            class="bg-[#A14C36] hover:bg-[#723322] text-white px-4 py-2 rounded-lg shadow-sm transition duration-150" onclick="window.location.href='/Carousel/{{ $user }}'">
            Add Product Ads
            </button>
        </div>    
    </div>
    {{ $data_carousel->links() }}    
    <div class="card-body">
            <table class="min-w-full divide-y divide-gray-900">
                <thead class="bg-[rgb(136,77,38)]">
                    <tr>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Ads</th>
                        <th class="border border-gray-900 px-4 py-2 font-medium text-white">Action</th>
                    </tr>
                </thead>
                @foreach ($data_carousel as $dt_ads )
                    <tbody class="divide-y divide-black bg-[rgb(236,222,210)]">
                        <tr>
                            <td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                <img src="{{ asset('storage/'. $dt_ads->image)}}" alt="Product Ads" class="w-[20%] h-auto object-cover">
                            </td>
                            <td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='#'" >Edit</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
    </div>
</div>    

<!-- Produk biji kopi -->
<div class="container mx-auto px-4 py-8">
    <!-- Header dengan Search -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black">Product Coffee Been</h2>
        <div class="flex items-center gap-4">
            <button type="button" 
                    class="bg-[#A14C36] hover:bg-[#723322] text-white px-4 py-2 rounded-lg shadow-sm transition duration-150" onclick="window.location.href='/add_produk/{{ $user }}/Coffee Been'">
                Add Coffee Been 
            </button>
        </div>
    </div>
    
    {{ $data_biji_kopi->links() }}
    <!-- Tabel Produk -->
    <div class="card-body">
        
        <table class="min-w-full divide-y divide-gray-900">
            <thead class="bg-[rgb(136,77,38)]">
                <tr>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Name</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Stock</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Price</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Description</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Image</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Action</th>
                </tr>
            </thead>
            
            @foreach ( $data_biji_kopi as $dtbiji_kopi)
                    <tbody class="divide-y divide-black bg-[rgb(236,222,210)]">
                        <tr>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtbiji_kopi->nama_product}}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtbiji_kopi->stock}}</td>        
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">Rp {{number_format((float)$dtbiji_kopi->price,0,',','.')}}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ Str::limit($dtbiji_kopi->description, 50, '...') }}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">
                                <img src="{{ asset('storage/'. $dtbiji_kopi->image)}}" alt="Product Image" class=" w-[20%] h-auto object-cover">
                            </td>
                            <td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/add_stock/{{$dtbiji_kopi->id}}/{{ $user }}'" >Add Stock</button>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/edit_produk/{{$dtbiji_kopi->id}}/{{ $user }}'" >Edit</button>
                                </div>
                            </td>
                            
                        </tr>    
                    </tbody>
            @endforeach
            
        </table>
        
    </div>
</div>


<!-- Produk mesin kopi -->
<div class="container mx-auto px-4 py-8">
    <!-- Header dengan Search -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Coffee Machine Products</h2>
        <div class="flex items-center gap-4">
            
            <button type="button" 
                    class="bg-[#A14C36] hover:bg-[#723322] text-white px-4 py-2 rounded-lg shadow-sm transition duration-150" onclick="window.location.href='/add_produk/{{ $user }}/Machine Coffee'">
                Add Coffee Machine 
            </button>
        </div>
    </div>

    {{ $data_mesin_kopi->links() }}
    <!-- Tabel Produk -->
    <div class="card-body bg-[rgb(236,222,210)]">
        <table class="min-w-full divide-y divide-gray-900">
            <thead class="bg-[rgb(136,77,38)]">
                <tr>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Name</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Stock</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Price</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Description</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Product Image</th>
                    <th class="border border-gray-900 px-4 py-2 font-medium text-white">Action</th>
                </tr>
            </thead>
            
            @foreach ( $data_mesin_kopi as $dtmesin_kopi)
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtmesin_kopi->nama_product}}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{$dtmesin_kopi->stock}}</td>        
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">Rp {{number_format((float)$dtmesin_kopi->price,0,',','.')}}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">{{ Str::limit($dtmesin_kopi->description,50, '...') }}</td>
                            <td class="border border-gray-900 px-4 py-2 font-normal text-[rgb(4,4,4)]">
                                <img src="{{ asset('storage/'. $dtmesin_kopi->image)}}" alt="Product Image" class="w-[20%] h-auto object-cover">
                            </td>
                            <td class="border border-gray-900 px-4 py-2 font-medium text-gray-500">
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/add_stock/{{$dtmesin_kopi->id}}/{{ $user }}'" >Add Stock</button>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <button class="btn btn-danger gap-x-1.5 rounded-md bg-[rgba(178,45,45,0.87)] px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-800 hover:bg-gray-700" onclick="window.location.href='/edit_produk/{{$dtmesin_kopi->id}}/{{ $user }}'" >Edit</button>
                                </div>
                            </td>
                            
                        </tr>    
                    </tbody>
            @endforeach
        </table>
    </div>
</div>



</x-layout-cruid-seller>