<x-nav-bar-shoppingcart :title="$title"/>
<x-layout>

    <div class="px-10 py-10 border border-[rgb(200,160,120)] rounded-2xl shadow-orange-950">
        <h2 class=" mt-6 text-xl font-semibold text-gray-900 text-center ">Payment</h2>
    </div>

    <!-- List of products -->
    <ul role="list" class="space-y-4 p-4">
        
        @foreach ($dttransaksi as $transaksi)
        <li class="p-6 hover:bg-[rgb(245,210,188)] transition duration-150 ease-in-out bg-[rgb(240,219,205)] rounded-xl shadow-lg border border-[rgb(200,160,120)]"> 
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-lg border border-[rgb(200,160,120)] shadow-sm">
                    <img src="{{ asset('storage/'. $transaksi->image)}}" 
                         alt="{{ $transaksi->nama_product }}" 
                         class="h-full w-full object-cover object-center">
                </div>
                
                <div class="flex-1 flex flex-col">
                    <div class="flex justify-between items-start">
                        <h4 class="text-lg font-semibold text-gray-900">{{ $transaksi->nama_product }}</h4>
                        <p class="text-lg font-medium text-gray-900">
                            Rp {{ number_format((float)$transaksi->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                    
                    <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $transaksi->description }}</p>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-[rgb(200,160,120)] bg-opacity-20">
                            <span class="text-sm font-medium text-gray-800">Qty: {{ $transaksi->jumlah_product }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    
    <div class="border-t border-[rgb(200,160,120)] bg-[rgb(248,235,227)]">
        <div class="px-6 py-6">
            <div class="flex justify-between items-center text-lg font-semibold text-gray-900 mb-4">
                <p>Subtotal</p>
                <p>Rp {{ number_format((float) $total_price,0,',','.') }}</p>
            </div>
            <p class="text-sm text-gray-600 mb-6">Shipping and taxes calculated at checkout.</p>
            
            <div class="space-y-4">
                
                <button id="pay-button"
                    class="w-full flex items-center justify-center rounded-lg bg-[rgb(200,160,120)] px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-[rgb(180,140,100)] transition duration-150 ease-in-out">
                        Pay Now !
                </button>
                
            </div>
        </div>
    </div>



    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">

        document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
            snap.pay('{{ $snapToken }}', {
            // Optional

            onSuccess: function(result){
                window.location.href = '/success/{{ $transaksi->nama_pembeli  }}';
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
            });
        };




      // For example trigger on button clicked, or any time you need
      //var payButton = document.getElementById('pay-button');
      //payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        //window.snap.pay('{{ $snapToken }}');
        // customer will be redirected after completing payment pop-up
      //});
    </script>

</x-layout>
