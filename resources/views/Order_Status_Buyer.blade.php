<x-nav-bar-login :pendingCount="$count_shopping_cart" :title="$title" :user="$user->name"/>       
<header class="bg-[rgb(240,219,205)] w-full shadow-md fixed top-0 z-10">
    <div class="max-w-7xl mx-auto py-6 px-6">
        <div class="space-y-3 border-l-4 border-[rgb(200,160,120)] pl-4 ">
            <h1 class="text-xl font-bold text-gray-900">Buyer's Information</h1>
            <div class="space-y-2">
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Name</span>
                    <span class="text-gray-900 font-medium">: {{ $user->name }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Phone</span>
                    <span class="text-gray-900 font-medium">: {{ $user->no_HP }}</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 w-32">Address</span>
                    <span class="text-gray-900 font-medium">: {{ $user->alamat_pengiriman }}</span>
                </div>
            </div>
        </div>
    </div>
</header>
<x-layout-login>
<div class="max-w-7xl mx-auto pt-60 px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-[rgb(221,194,175)] rounded-lg shadow-lg">
        <div class="px-6 py-2 border-b border-[rgb(200,160,120)] rounded-2xl">
            <h2 class="text-xl font-semibold text-gray-900">Order Status</h2>
        </div>
        
        <ul role="list" class="space-y-4 p-4">
            @foreach ($dttransaksi as $transaksi)
            <li class="p-6 hover:bg-[rgb(240,219,205)] transition duration-150 ease-in-out bg-[rgb(240,219,205)] rounded-xl shadow-lg border border-[rgb(200,160,120)]"> 
                <div class="flex items-center space-x-6">
                    
                    <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-lg border border-[rgb(200,160,120)] shadow-sm">
                        <img src="{{ asset('storage/'. $transaksi->image)}}" 
                             alt="{{ $transaksi->nama_product }}" 
                             class="size-fit object-cover object-center">
                    </div>
                    
                    <div class="flex-1 flex flex-col">
                        <div class="flex justify-between items-start">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $transaksi->nama_product }}</h4>
                            @if ($transaksi->status_transaksi == 'paid')
                                <h5 class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20 text-sm font-bold text-red-600">Order is being packed</h5>
                            @elseif ($transaksi->status_transaksi == 'send')
                                <h5 class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20 text-sm font-bold text-black">AWB Bill No : {{ $transaksi->AWB_Bill }}</h5>
                            @endif

                            <p class="text-lg font-medium text-gray-900">
                                Rp {{ number_format((float)$transaksi->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ Str::limit($transaksi->description,100) }}</p>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20">
                                <span class="text-sm font-medium text-gray-800">Qty: {{ $transaksi->jumlah_product }}</span>
                            </div>
                            <div>
                                @if ($transaksi->status_transaksi == 'paid') 
                                    <span class=" text-base font-bold text-gray-900">Order ID :{{ $transaksi->order_id }}</span>
                                @elseif ($transaksi->status_transaksi == 'send')
                                    <span class=" text-base font-bold text-gray-900">Order ID :{{ $transaksi->order_id }}</span>
                                @endif
                            </div>
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20">
                                <span class="text-sm font-medium text-gray-800">
                                    Order Status: 
                                    <span class="{{ strtoupper($transaksi->status_transaksi) == 'PENDING' ? 'text-red-600' : 'text-black' }}">
                                        {{ strtoupper($transaksi->status_transaksi) }}
                                    </span>
                                </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="border-t border-[rgb(200,160,120)] bg-[rgb(248,235,227)]">
            <div class="px-6 py-6">
                
                
                <div class="space-y-4">
                    
                    
                    <div class="flex justify-center items-center space-x-2 text-sm">
                        <span class="text-gray-600">or</span>
                        <a href="/ProductLogin/{{ $user->name }}" 
                                class="font-medium text-[rgb(200,160,120)] hover:text-[rgb(180,140,100)] transition duration-150 ease-in-out">
                            Continue Shopping
                            <span aria-hidden="true"> →</span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>
</x-layout-login>



