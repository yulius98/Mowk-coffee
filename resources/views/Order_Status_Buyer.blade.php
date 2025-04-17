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
        
        {{ $dttransaksi->links() }}
        @foreach ($dttransaksi as $transaksi)
            <div class="container mx-auto px-4 py-8 mt-4"> 
                <div class=" bg-transparent rounded-2xl shadow-black shadow-2xl overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8">
                        <!-- Product Image Section -->
                        <div class="rounded-2xl overflow-hidden bg-transparent shadow-2xl border border-slate-400 ">
                            <div class="flex justify-center items-center p-4">
                                <img src="{{ asset('storage/'. $transaksi->image)}}" 
                                    alt="" 
                                    class="w-fit rounded-2xl bg-[rgb(240,180,140)] object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                            </div>
                        </div>
                        
                        <!-- Details Product -->
                        <div class="space-y-2">
                            <h4 class="text-lg font-bold text-black">{{ $transaksi->nama_product }}</h4>
                            <p class="text-lg font-semibold text-black">
                                Rp {{ number_format((float)$transaksi->total_price, 0, ',', '.') }}
                            </p>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ Str::limit($transaksi->description,100) }}
                            </p>
                                
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20">
                                <span class="text-lg font-semibold text-black">Qty: {{ $transaksi->jumlah_product }}</span>
                            </div>
                            
                            <div class=" p-2 border-t border-[rgb(200,160,120)] bg-[rgb(236,213,200)] rounded-xl shadow-sm shadow-black">
                                
                                @if ($transaksi->status_transaksi == 'paid')
                                    <h5 class="mt-2 mr-2 inline-flex items-center rounded-full bg-[rgb(200,160,120)] bg-opacity-20 text-sm font-bold text-red-600 p-2">Order is being packed</h5>
                                @elseif ($transaksi->status_transaksi == 'send')
                                    <h5 class="mt-2 mr-2 inline-flex items-center rounded-full bg-[rgb(200,160,120)] bg-opacity-20 text-sm font-bold text-black p-2">AWB Bill No : {{ $transaksi->AWB_Bill }}</h5>
                                @endif

                                <h6 class=" mt-2 text-base font-bold text-gray-900">Order ID :{{ $transaksi->order_id }}</h6>
                                <span class="block text-right text-sm font-bold text-black">
                                    Order Status: 
                                    <span class="{{ strtoupper($transaksi->status_transaksi) == 'PENDING' ? 'text-red-600' : 'text-black' }}">
                                        {{ strtoupper($transaksi->status_transaksi) }}
                                    </span>
                                </span>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    <div class="border-t border-[rgb(200,160,120)] bg-[rgb(248,235,227)]">
            <div class="px-6 py-6">
                <div class="space-y-4">
                    <div class="flex justify-center items-center space-x-2 text-sm">
                        <span class="text-gray-600">or</span>
                        <a href="/ProductLogin/{{ $user->name }}/Coffee Been" 
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



