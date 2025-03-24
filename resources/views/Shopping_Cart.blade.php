<x-nav-bar-shoppingcart :title="$title"/>       
<header class="bg-[rgb(240,219,205)] w-full shadow-md">
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
<x-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-[rgb(221,194,175)] rounded-lg shadow-lg">
        <div class="px-6 py-2 border-b border-[rgb(200,160,120)] rounded-2xl">
            <h2 class="text-xl font-semibold text-gray-900">Shopping Cart</h2>
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
                            <p class="text-lg font-medium text-gray-900">
                                Rp {{ number_format((float)$transaksi->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ Str::limit($transaksi->description,100) }}</p>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20">
                                <span class="text-sm font-medium text-gray-800">Qty: {{ $transaksi->jumlah_product }}</span>
                            </div>
                            <button type="button" 
                                    class="flex items-center text-red-600 hover:text-red-700 font-medium transition duration-150 ease-in-out" onclick="window.location.href='/delete_shoppingcart/{{$transaksi->id}}/{{ $transaksi->nama_pembeli }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="border-t border-[rgb(200,160,120)] bg-[rgb(248,235,227)]">
            <div class="px-6 py-6">
                <div class="flex justify-between items-center text-lg font-semibold text-gray-900 mb-4">
                    <p>Subtotal</p>
                    <p>Rp {{ number_format((float) $total_price,0,',','.') }}</p>
                </div>
                <p class="text-sm text-gray-600 mb-6">Shipping and taxes calculated at checkout.</p>
                
                <div class="space-y-4">
                    <button type="button" id="pay-button"
                        class="w-full flex items-center justify-center rounded-lg bg-[rgb(200,160,120)] px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-[rgb(180,140,100)] transition duration-150 ease-in-out" onclick="window.location.href='/Checkout/{{$user->name}}/{{$total_price}}'">
                        Proceed to Checkout
                    </button>
                    
                    <div class="flex justify-center items-center space-x-2 text-sm">
                        <span class="text-gray-600">or</span>
                        <a href="/Product" 
                                class="font-medium text-[rgb(200,160,120)] hover:text-[rgb(180,140,100)] transition duration-150 ease-in-out">
                            Continue Shopping
                            <span aria-hidden="true"> →</span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>
</x-layout>


