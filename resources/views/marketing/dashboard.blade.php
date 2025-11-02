<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Dashboard - PT Lestari Jaya Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-green-800 text-white w-64 py-6 px-4">
            <h1 class="text-xl font-bold mb-6">Marketing Panel</h1>
            <nav>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Dashboard</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Articles</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Analytics</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Chat History</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Marketing Dashboard</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Logout</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">My Articles</h3>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Article Views</h3>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Chat Interactions</h3>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Welcome to Marketing Dashboard</h3>
                <p class="text-gray-600">Create and manage articles, view analytics, and monitor chatbot interactions.</p>
            </div>
        </div>
    </div>
</body>
</html>