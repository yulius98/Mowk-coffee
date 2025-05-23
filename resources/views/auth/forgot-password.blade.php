<x-nav-bar/>
<x-layout-no-header>

    <div class="flex min-h-full flex-col justify-center px-4 py-12 lg:px-8 ">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-40 w-auto" src="Logo.jpg" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Reset Password</h2>
    </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/forgot-password" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger col-md-6 text-red-600">
                <u1>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </u1>
            </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success col-md-6 text-balck">
                    {{ session('status') }}
                </div>
                
            @endif   
            <div>
                <label for="email" class="block text-sm/6 font-semibold text-gray-900">Email address</label>
                <div class="mt-2">
                <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-[#723322] sm:text-sm/6">
                </div>
            </div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-[#A14C36] px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-[#723322] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#723322]">Send</button>
            </div>
            </form>
        </div>
       
    </div>
</x-layout-no-header>