<nav class="bg-[#331C09]">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center">
        <div class="shrink-0">
          <img class="size-10" src="Logo.jpg" alt="Your Company">
        </div>
        
        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white">Product</a>
        <div class="hidden md:block flex-1">
          <div class="flex items-baseline space-x-4 justify-end">
            <span class="text-white">{{ $title }}</span>
          </div>
        </div>
        <div class="hidden md:block ml-4">
          <div class="flex items-center">
              <a href="/Logout" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white">Logout</a>
              <a href="/ShoppingCart/{{ $user }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white relative">
                <i data-feather="shopping-cart"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                  {{ $pendingCount }}
                </span>
              </a>
          </div> 
        </div>
        
        <div x-data="{ isOpen: false }" class="-mr-2 flex md:hidden">
          <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
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
    </div>

    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <a href="/ProductLogin" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white">Product</a>
      </div>
    
      <div class="mt-3 space-y-1 px-2">
        <a href="/Logout" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white">Logout</a>
        <a href="/ShoppingCart" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white relative">
          <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <use href="path/to/feather-sprite.svg#shopping-cart" />
          </svg>
          <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
            {{ $pendingCount }}
          </span>
        </a>
      </div>
    </div>
  </nav>
