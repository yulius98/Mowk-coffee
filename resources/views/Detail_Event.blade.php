<x-nav-bar/>
<x-layout>
    <div class="container mx-auto px-4 py-8 mt-4">
        <div class=" bg-transparent rounded-2xl shadow-black shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 p-8">
                <!-- Product Image Section -->
                <div class="rounded-2xl overflow-hidden bg-transparent shadow-2xl border border-slate-400 ">
                    <div class="flex justify-center items-center p-4">
                        <img src="{{ asset('storage/'. $data_event->image_event)}}" 
                             alt="" class="rounded-2xl w-full h-auto max-w-lg object-contain transform transition" >
                    </div>
                </div>

                <!-- Details Event -->
                <div class="space-y-2">
                    <div class="flex justify-between items-start">
                        <h1 class="text-xl lg:text-xl font-bold text-black">Date  : {{ \Carbon\Carbon::parse($data_event->date_event)->format('d-M-Y') }}</h1>
                        <h2 class="text-lg font-semibold text-green-800 text-right ">{{ Str::upper($data_event->tiket)  }}</h2>
                    </div>
                    <h3 class="text-lg font-semibold text-black">Time : {{ \Carbon\Carbon::parse($data_event->time_event)->format('H:i') }}</h3>
                    <h4 class="text-xl lg:text-xl font-bold text-black">Topic : {{ $data_event->name_event }}</h4>
                    <h5 class="text-xl lg:text-xl font-bold text-black">Location : {{ $data_event->location_event }}</h5>
                    <div class="prose mt-2 text-black whitespace-pre-line break-words">
                        <span class="text-lg font-semibold text-black">Description :</span>
                        <p>{{ $data_event->description_event }}</p>
                    </div>
                    @if ($data_event->tiket == 'paid')
                        <div class="flex justify-between items-start">
                            <h6 class=" mt-2 text-base font-bold text-black">Price : Rp. {{ number_format((float) $data_event->harga_tiket,0,",",".") }}</h6>
                        </div>
                    @endif
                    <a href="/Joint_Event/{{ $data_event->id }}"black
                        class="block w-full text-center bg-[#a55a1d] text-white py-4 rounded-xl hover:bg-[#331C09] transition duration-300 font-medium">
                            Joint Event
                    </a>
                    <a href="/Event"
                        class="block w-full text-center bg-[#a55a1d] text-white px-6 py-4 rounded-xl hover:bg-[#331C09] transition duration-300 font-medium">
                            Back
                    </a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-layout>
