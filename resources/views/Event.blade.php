<x-nav-bar/>
<x-layout>
  
    <div class=" mt-20 mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h1 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Mowk's Coffee Event</h1>
      </div>
    </div>
    <!-- <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 lg:grid-cols-5 xl:gap-x-4"> -->
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">  
      @foreach ( $data_event as $dt_event )
        <div class="bg-[rgb(236,220,208)] group relative border border-[rgb(236,220,208)] rounded-2xl shadow-md overflow-hidden p-2 ">
          <div class=" w-auto h-auto flex-shrink-0 overflow-hidden rounded-xl">
            <img src="{{ asset('storage/'. $dt_event->image_event)}}" 
              alt="" 
              class=" w-auto h-auto object-cover object-center">
          </div>   
          <div class= "flex justify-between items-start">
            <h2 class=" mt-1 text-lg font-semibold text-black">Date : {{ \Carbon\Carbon::parse($dt_event->date_event)->format('d-M-Y') }} </h2>
            <h3 class=" mt-1 text-lg font-semibold text-green-800 text-right ">{{ Str::upper($dt_event->tiket)  }}</h3>
          </div>  
          <div class="flex justify-between items-start">
            <h4 class="text-xl font-bold text-black">Topic : {{ $dt_event->name_event }}</h4>
          </div>
          <div class="flex justify-between items-start">
            <h5 class=" text-base font-bold text-black">Location : {{ $dt_event->location_event }}</h5>
          </div>
          <div class="flex justify-between items-start">
            <h6 class=" text-base font-serif text-black">{{ Str::limit($dt_event->description_event,50,'...') }}</h6>
          </div>
          @if ($dt_event->tiket == 'paid')
            <div class="flex justify-between items-start">
              <h5 class=" mt-2 text-base font-bold text-black">Price : Rp. {{ number_format((float) $dt_event->harga_tiket,0,",",".") }}</h5>
            </div>
          @endif
          <div class="flex justify-between items-start">
            <a href="/Detail_Event/{{ $dt_event->id }}" class="absolute bottom-0 right-0 mb-2 mr-2 text-base font-medium text-green-800">See Detail...</a>
          </div>       
        </div>  
      @endforeach
    </div> 
  
      
</x-layout>
