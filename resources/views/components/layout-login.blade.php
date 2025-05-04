<!doctype html>
<html class="h-full bg-[rgb(221,194,175)]">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    @php
	        $isProduction = app()->environment('production');
	        $manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');
    @endphp

    @if ($isProduction && file_exists($manifestPath))
	        @php
		        $manifest = json_decode(file_get_contents($manifestPath), true);
	        @endphp
	        <link rel="stylesheet" href="{{config('app.url')}}/build/{{$manifest['resources/css/app.css']['file']}}">
	        <script type="module" src="{{config('app.url')}}/build/{{$manifest['resources/js/app.js']['file']}}"></script>
    @else
	        @viteReactRefresh
	        @vite(['resources/js/app.js','resources/css/app.css'])
    @endif
    
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Mowks Coffe</title>
  </head>
 <body class="h-full">
  <div class="min-h-full">
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}<!-- Your content -->
      </div>
    </main>
    <script>
      feather.replace();
    </script>    
    @stack('scripts')
  </div>
</body>
</html>
