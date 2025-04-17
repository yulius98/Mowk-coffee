<nav class="fixed w-full top-0 z-50 bg-[#331C09] transition-all duration-300 " x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      
      <div class="flex items-center">
        <div class="shrink-0">
          <img class="h-14 w-auto rounded-lg shadow-md object-cover my-1 hover:opacity-90" src="/Logo.jpg" alt="Mowk Coffee">
        </div>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <div class="w-auto">
              <button
                  type="button" 
                  @click="isOpen = !isOpen"
                  class="rounded-md px-4 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white flex items-center"
                  id="options-menu"
                  aria-haspopup="true"
                  aria-expanded="true">
                  Product Mowks Coffee
                  <svg class="ml-2 h-5 w-5 text-[#edaa6f]" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <div 
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute left-60 z-10 mt-10 w-56 origin-top-right divide-y divide-[#3c220d] rounded-md bg-[#784820] shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                role="menu" 
                aria-orientation="vertical" 
                aria-labelledby="menu-button" 
                tabindex="-1">
                
                <div class=" py-2" role="none">
                    <a href="/ProductLogin/{{ $user }}/Coffee Been" class="text-white hover:bg-[#522E0E] hover:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Coffee Been</a>  
                    <a href="/ProductLogin/{{ $user }}/Machine Coffee" class="text-white hover:bg-[#522E0E] hover:text-white block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Coffee Machine</a>    
                </div>
            </div>      
          </div>
        </div>
        
        
        
        
        
        
        
        {{-- <div class="hidden md:block ">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/ProductLogin/{{ $user }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Product Mowks Coffee</a>
          </div>  
        </div> --}}
        
        <div class="hidden md:block ">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/Order_Status/{{ $user }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Order Status</a>
          </div>  
        </div>

      </div>

      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
            <span class="text-white">{{ $title }}</span>
            <a href="/Edit_Profile/{{ $user }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Edit Profile</a>
            <a href="/Logout" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Logout</a>
            <a href="/ShoppingCart/{{ $user }}" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white relative">
              <!-- <i data-feather="shopping-cart"></i> -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13m-10 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm9 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
              </svg>
              <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                {{ $pendingCount }}
              </span>
            </a>
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
        <a href="/ProductLogin/{{ $user }}/Coffee Been" class="block rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Product Coffee Been</a>
      </div>
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <a href="/ProductLogin/{{ $user }}/Machine Coffee" class="block rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Product Coffee Machine</a>
      </div>
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <a href="/Order_Status/{{ $user }}" class="block rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Order Status</a>
      </div>
      <div class="border-t border-gray-700 pt-4 pb-3">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <span class="text-white">{{ $title }}</span>
          <a href="/Edit_Profile/{{ $user }}" class="block rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white">Edit Profile</a>  
          <a href="/ShoppingCart/{{ $user }}" class="block rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-[#522E0E] hover:text-white relative">
            <!--<i data-feather="shopping-cart"></i> -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
              <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13m-10 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm9 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
            </svg>
            <span class="absolute top-0 left-7 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
              {{ $pendingCount }}
            </span>
          </a>
          <a href="/Logout" class="block rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-[#522E0E] hover:text-white">Logout</a>
        </div>
      </div>
    </div>
  </nav>
