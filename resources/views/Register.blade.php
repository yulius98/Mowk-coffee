<x-nav-bar/>
<x-layout-no-header>
  <form action="/Register" method="post" class="space-y-6" enctype="multipart/form-data">
    @csrf
    <div class="min-h-screen flex items-center justify-center bg-[rgb(221,194,175)] p-6">
      <div class="bg-gray-100 rounded-xl shadow-lg max-w-md mx-auto p-6">
        <h2 class="text-2xl font-bold text-black text-center">Register</h2>
        
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6 mt-4">
          
          <div>
            <label for="username" class="block text-sm font-bold text-black">User Name</label>
            <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="janesmith">
          </div>

          <div>
            <label for="password" class="block text-sm font-bold text-black">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="********">
          </div>
        </div>

        <h2 class="mt-10 text-lg font-bold text-black">Personal Information</h2>
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
            <input type="text" name="name" id="name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="Your Name">
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="you@example.com">
          </div>
        </div>
        
        <div class="grid grid-cols-1 gap-y-2 mt-2 w-full">
          <div>
            <label for="alamat_pengiriman" class="block text-sm font-medium text-gray-900 w-full">Alamat Pengiriman</label>
            <textarea id="alamat_pengiriman" name="alamat_pengiriman" autocomplete="given-name" class="mt-1 block w-full max-w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="alamat pengiriman"></textarea>
          </div>
          <div>
            <label for="no_HP" class="block text-sm font-medium text-gray-900 w-full">Nomor Handphone</label>
            <input id="no_HP" name="no_HP" autocomplete="given-name" class="mt-1 block w-full max-w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="no Handphone">
          </div>
        </div>
      
        <div class="mt-6 border rounded-md p-4 flex items-center justify-end gap-x-6">
          <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/'">Cancel</button>
          <button type="submit" class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
      </div>
    </div>
  </form>
</x-layout-no-header>