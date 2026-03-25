@props(['sitecss' => 'none'])
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
        @vite('resources/css/app.css', 'resources/js/app.js')
        @if ($sitecss!='none')
            <link rel="stylesheet" href="{{ asset('css/'.$sitecss.'.css') }}">
        @endif
    <title>Szerviznapló</title>
</head>
<body class="bg-[#0a0a0a] text-[#f0ede8] font-['Barlow'] font-light min-h-screen">
    <main>
        {{ $slot }}
    </main>
</body>
</html>