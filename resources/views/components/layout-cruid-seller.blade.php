<!doctype html>
<html class="h-full bg-[rgb(240,180,140)]">
  <head>
    <title>Mowks-Coffee</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

  </head>
 <body class="h-full">
        <div class="min-h-full">
            <x-nav-bar-cruid-seller>{{ $title }}</x-nav-bar-cruid-seller>
            
            <main>
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}<!-- Your content -->
                </div>
            </main>
        </div>
  </body>
</html>
