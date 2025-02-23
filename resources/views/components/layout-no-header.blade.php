<!doctype html>
<html class="h-full bg-[rgb(240,180,140)]">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://unpkg.com/feather-icons"></script>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    </div>
  </body>
</html>
