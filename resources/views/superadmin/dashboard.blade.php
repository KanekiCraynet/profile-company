<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard - PT Lestari Jaya Bangsa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-green-800 text-white w-64 py-6 px-4">
            <h1 class="text-xl font-bold mb-6">Super Admin Panel</h1>
            <nav>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Dashboard</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Users & Roles</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Products</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Articles</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Contacts</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Chatbot</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">Settings</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-green-700">System</a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Super Admin Dashboard</h2>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Logout</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-2xl font-bold text-green-600">1</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Products</h3>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">Total Articles</h3>
                    <p class="text-2xl font-bold text-green-600">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-2">System Health</h3>
                    <p class="text-2xl font-bold text-green-600">Good</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Welcome to Super Admin Dashboard</h3>
                <p class="text-gray-600">Full system control and management capabilities.</p>
            </div>
        </div>
    </div>
</body>
</html>