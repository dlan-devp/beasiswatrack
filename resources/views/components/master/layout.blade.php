@props([
    'title' => 'default title',
    'label' => 'default label'
    ])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeasiswaTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <x-master.navbar></x-master.navbar>

    <x-master.hero :title="$title" :label="$label"></x-master.hero>

    <!-- Main Content -->
    {{ $slot }}
    
    <x-master.footer></x-master.footer>

</body>
</html>
