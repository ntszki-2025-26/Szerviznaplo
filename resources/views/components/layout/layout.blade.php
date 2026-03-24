<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;700;900&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')))
        @vite('resources/css/app.css')
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <title>Szerviznapló</title>
</head>
<body class="bg-[#0a0a0a] text-[#f0ede8] font-['Barlow'] font-light min-h-screen">
    <main>
        {{ $slot }}
    </main>
</body>
</html>