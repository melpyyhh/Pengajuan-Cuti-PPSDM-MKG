<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">My Sidebar</h1>
            </div>
            <nav class="mt-6">
                <ul>
                    <li class="px-4 py-2 hover:bg-gray-700"><a href="#">Dashboard</a></li>
                    <li class="px-4 py-2 hover:bg-gray-700"><a href="#">Profile</a></li>
                    <li class="px-4 py-2 hover:bg-gray-700"><a href="#">Settings</a></li>
                    <li class="px-4 py-2 hover:bg-gray-700"><a href="#">Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-semibold">Welcome to the Dashboard</h2>
            <p class="mt-4">This is the main content area.</p>
        </div>
    </div>

</body>

</html>
