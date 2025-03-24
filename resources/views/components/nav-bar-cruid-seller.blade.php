<nav class="fixed w-full top-0 z-50 bg-[#331C09] transition-all duration-300 ">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">  
          <div class="hidden md:block">
            <!--<div class="ml-10 flex items-baseline space-x-4">
              <a href="/CRUIDSeller" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Product</a>  
              <a href="/Carousel" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Promo Ads</a>
            </div> -->
          </div>

        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <a class="rounded-md px-3 py-2 text-sm font-medium text-white">{{ $slot}}</a>
            <a href="/Login" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Logout</a>
              
          </div> 
        </div>
        
        <div  x-data="{ !isOpen: false }" class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
          <div
            x-show="isOpen"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg"
        >
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <a href="/CRUIDSeller" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Product Cofee Been</a>  
      </div>
    
        <div class="mt-3 space-y-1 px-2">
                <a href="/Login" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Logout</a>
        </div>
        
    </div>
  </nav>