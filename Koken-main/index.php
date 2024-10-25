<?php
//session_start();
//
//if (!isset($_SESSION['user'])) {
//    header("Location: login.php");
//    exit();
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshGen - Gezonde Recepten</title>
    <link rel="icon" href="./media/FreshGen.jpeg">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cooper+Black&family=Signika+Negative:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Signika Negative', sans-serif;
        }
        .bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Sticky Header -->
<header class="fixed top-0 w-full py-3 text-white bg-green-700 z-50">
    <div class="container mx-auto flex justify-between items-center px-4">
        <h1 class="text-2xl font-bold">FreshGen</h1>
        <nav>
            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-6">
                <li><a href="index.php" class="hover:text-gray-300">Home</a></li>
                <li><a href="./recepten.php" class="hover:text-gray-300">Recepten</a></li>
                <li><a href="contact.php" class="hover:text-gray-300">Contact</a></li>
            </ul>
            <!-- Burger Icon -->
            <button id="burgerButton" class="block md:hidden text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
    </div>
</header>

<!-- Mobile Menu (Hidden by default) -->
<div id="mobileMenu" class="hidden md:hidden bg-green-700 text-white w-full absolute top-16 z-50">
    <ul class="flex flex-col items-center space-y-4 py-4">
        <li><a href="index.php" class="hover:text-gray-300">Home</a></li>
        <li><a href="recepten.php" class="hover:text-gray-300">Recepten</a></li>
        <li><a href="contact.php" class="hover:text-gray-300">Contact</a></li>
    </ul>
</div>

<!-- Hero Section with Search Bar -->
<section class="bg-cover bg-center py-36 text-center relative min-h-[75vh]" style="background-image: url('https://images.ctfassets.net/lufu0clouua1/1vcWY89xinetnmYMRF9eV5/4e8079e9a918afc1f0603276991df3a7/lbm-skillet-meal__1_.jpg');">
    <div class="container mx-auto text-white">
        <h2 class="text-5xl font-bold mb-6">Maak Gezonde Recepten Makkelijk en Snel</h2>
        <p class="text-xl mb-8">Vind nieuwe recepten en deel je eigen creaties!</p>
        <div class="relative max-w-2xl mx-auto search-container">
            <div class="flex">
                <input type="text" id="searchInput" class="w-full p-4 rounded-l-lg border border-gray-300 text-black" placeholder="Zoek naar recepten, ingrediënten of categorieën...">
                <span class="bg-green-600 text-white p-4 rounded-r-lg cursor-pointer" id="searchButton" onclick="performSearch()">
                        <i class="fas fa-search"></i>
                    </span>
            </div>
            <ul id="suggestionsList" class="absolute w-full bg-white text-black shadow-lg rounded-lg mt-1 hidden overflow-y-auto max-h-48"></ul>
        </div>
    </div>
</section>

<!-- Challenge Section -->
<section class="bg-white py-20 text-center border-t-8 border-green-700 shadow-lg">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-green-900 mb-4">Doe Mee aan de Uitdaging!</h2>
        <p class="text-lg mb-8">Wie kan het beste recept maken? Deel jouw creaties en laat ons stemmen! De winnaar ontvangt een speciale prijs!</p>
        <div class="flex justify-center mb-6">
            <div class="bounce">
                <i class="fas fa-arrow-down text-5xl text-green-700"></i>
            </div>
        </div>
        <a href="./challenge.html" class="bg-green-700 text-white py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105">
            Doe Mee!
        </a>
    </div>
</section>

<!-- Create Your Own Section -->
<section class="bg-white py-28">
    <div class="container mx-auto flex flex-col md:flex-row items-stretch justify-between space-y-6 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3 bg-green-700 text-white p-10 flex flex-col justify-center rounded-lg">
            <h2 class="text-3xl font-bold mb-4">Create Your Own</h2>
            <p class="text-lg mb-6">Unleash your creativity and share your unique recipe with the world! Start your culinary journey today by creating your own recipe.</p>
            <a href="create-recept.php" class="bg-white text-green-700 py-3 px-6 rounded-lg shadow-lg inline-block">Start Creating Now</a>
        </div>
        <div class="w-full md:w-2/3 rounded-lg overflow-hidden">
            <img src="https://www.morelandobgyn.com/hubfs/Imported_Blog_Media/GettyImages-854725402-1.jpg" alt="Create Your Own" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<!-- Recently Added Recipes Section -->
<section class="bg-gray-100 py-20 text-center">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-green-900 mb-8">Recent Toegevoegde Recepten</h2>
        <div id="recipeList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Recipes populated via JavaScript -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-green-700 text-white py-5 text-center">
    <p>&copy; 2024 FreshGen. Alle rechten voorbehouden.</p>
</footer>

<!-- Modal Structure -->
<div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden"></div>
<div id="recipeModal" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-11/12 max-w-lg bg-white rounded-lg shadow-lg hidden z-50 overflow-auto">
    <img id="modalImage" src="" alt="" class="rounded-t-lg">
    <h2 id="modalTitle" class="text-xl font-bold p-4"></h2>
    <ul id="modalIngredients" class="p-4"></ul>
    <p id="modalInstructions" class="p-4"></p>
    <iframe id="modalVideo" width="100%" height="315" src="" frameborder="0" allowfullscreen class="p-4"></iframe>
    <button id="closeModal" class="bg-red-600 text-white px-4 py-2 rounded m-4">Close</button>
</div>

<!-- Font Awesome for Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<!-- External JavaScript -->
<script>
    function performSearch() {
        const searchQuery = document.getElementById('searchInput').value;
        if (searchQuery) {
            window.location.href = `recepten.php?search=${encodeURIComponent(searchQuery)}`;
        }
    }
</script>
</script>
</body>
</html>
