<nav class="fixed w-full top-0 z-50 bg-[#331C09] transition-all duration-300" x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
        
      <div class="flex items-center">
          
        <div class="shrink-0">
          <img class="h-14 w-auto rounded-lg shadow-md object-cover my-1 hover:opacity-90" src="/Logo.jpg" alt="Mowk Coffee">
        </div>  
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/CRUIDSeller/{{ $slot }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Product</a>
            <a href="/Dashboard_Order_Product/{{ $slot }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Order Product</a>  
            <a href="/Dashboard_Event/{{ $slot }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Event</a>
          </div> 
        </div>
        
      </div>  
        
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          <a class=" rounded-md px-3 py-2 text-sm font-medium text-white">{{ $slot }}</a>
          <a href="/Login" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Logout</a>      
        </div> 
      </div>
    

      <div class="-mr-2 flex md:hidden">
      <!-- Mobile menu button -->
        <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>  
      </div>
    </div>
      
    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <a href="/CRUIDSeller/{{ $slot }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Product</a>
      </div>
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <a href="/Dashboard_Order_Product/{{ $slot }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Order Product</a>  
      </div>
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">  
        <a href="/#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Dashboard Event</a>
      </div>
          
      <div class="border-t border-gray-700 pt-4 pb-3">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <a class=" rounded-md px-3 py-2 text-sm font-medium text-white">{{ $slot }}</a>
        </div>
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">  
          <a href="/Login" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Logout</a>
        </div>
      </div>

    </div>
  </div>
</nav>