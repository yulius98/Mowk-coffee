<x-layout-no-header>
  <form action="/RegisterSeller" method="post" class="space-y-6">
    @csrf
    <div class=" bg-transparent rounded-xl shadow-lg shadow-black max-w-md mx-auto p-6">
      <h2 class="text-2xl font-semibold text-gray-900 text-center">Register Admin/Seller</h2>
      
      <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6 mt-4">
        
        <div>
          <label for="username" class="block text-sm font-medium text-gray-900">User Name</label>
          <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="janesmith">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
          <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]" placeholder="********">
        </div>
      </div>

      <h2 class="mt-10 text-lg font-semibold text-gray-900">Personal Information</h2>
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
      <div>
          <label for="role" class="block text-sm font-medium text-gray-900">Role</label>
          <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#723322] focus:ring-[#723322]">
            <option value="admin">Admin</option>
            <option value="seller">Seller</option>
          </select>
      </div>
    
      <div class="mt-6 border rounded-md p-4 flex items-center justify-end gap-x-6">
        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="window.location.href='/'">Cancel</button>
        <button type="submit" class="rounded-md bg-[#A14C36] px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-[#723322] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    </div>
  </form>
</x-layout-no-header>
