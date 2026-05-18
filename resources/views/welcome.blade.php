<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Sistem Kuisioner Dinamis</h1>
        <livewire:form-kuisioner />
    </div>

    @livewireScripts
</body>
</html>
