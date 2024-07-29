<!DOCTYPE html>
<html>
<head class="{{ session('theme', 'light') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Task Management App</title>
    <script src="../path/to/flowbite/dist/flowbite.bundle.js"></script>

    <script>
  // It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) &&
        window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="w-screen h-screen flex justify-center items-center box-border">
    <div id="app" class="w-full h-full flex justify-between items-center"></div>
</body>
</html>