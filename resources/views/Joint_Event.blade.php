<x-nav-bar/>
<x-layout>
    <form action="/Joint_Event" method="post" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-center bg-transparent ">
          <div class=" bg-transparent rounded-xl shadow-lg shadow-black p-6 mt-10 w-full max-w-md">
            <h2 class="text-2xl font-bold text-black text-center">Joint Event {{ $data_event-> name_event  }}</h2>
            
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6 mt-4">
              
              <div>
                <input type="hidden" name="name_event" id="name_event" value="{{ $data_event->name_event }}">
                <input type="hidden" name="tiket" id="tiket" value="{{ $data_event->tiket }}">
                <label for="name" class="block text-sm font-bold text-black">Name</label>
                <input type="text" name="nama_peserta" id="nama_peserta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" >
              </div>
    
              <div>
                <label for="no_HP" class="block text-sm font-bold text-black">Phone Number</label>
                <input type="text" name="no_HP" id="no_HP" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" >
              </div>

              <div>
                <label for="alamat_peserta" class="block text-sm font-bold text-black">Address</label>
                <input type="text" name="alamat_peserta" id="alamat_peserta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" >
              </div>

              <div>
                <label for="email_peserta" class="block text-sm font-bold text-black">Email</label>
                <input type="email" name="email_peserta" id="email_peserta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" >
              </div>
              
              @if ($data_event->tiket == 'paid')
              <div>
                <label for="email_peserta" class="block text-sm font-bold text-black">Price : Rp. {{ number_format((float) $data_event->harga_tiket,0,",",".") }}</label>
              </div>
              
              @endif

            </div>
    
            
          
            <div class="mt-6 border rounded-md p-4 flex items-center justify-end gap-x-6">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/'">Cancel</button>
                @if ($data_event->tiket == 'paid')
                    <button type="button" class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Paid</button>
                @else
                    <button type="submit" class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                @endif

            </div>
          </div>
        </div>
      </form>
</x-layout>