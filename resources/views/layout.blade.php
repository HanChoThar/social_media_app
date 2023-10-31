<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSharMal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-700 text-white py-4">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold">JobSharMal</h1>
        </div>
    </header>

    <!-- view output -->
    @yield('content')
</body>
</html>