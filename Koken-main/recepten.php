
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshGen - Recepten</title>
    <link rel="website Icon" href="./media/FreshGen.jpeg">

    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for the search icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts: Signika Negative -->
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Signika Negative', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col">

    <!-- Sticky Header -->
    <header id="main-header" class="fixed top-0 w-full py-3 text-white z-50 bg-green-700 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">FreshGen</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="index.php" class="text-white hover:text-gray-300">Home</a></li>
                    <li><a href="recepten.php" class="text-white hover:text-gray-300">Recepten</a></li>
                    <li><a href="contact.php" class="text-white hover:text-gray-300">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Search Bar -->
    <section class="text-center py-10 mt-20 relative">
        <div class="container mx-auto">
            <div class="relative mx-auto w-full md:w-1/2">
                <div class="flex">
                    <input type="text" id="searchInput" placeholder="Zoek op ingrediënten of gerecht..."
                        class="border border-gray-300 rounded-l-md p-2 w-full focus:outline-none focus:ring-2 focus:ring-green-600">
                    <button id="searchButton" class="bg-green-700 text-white rounded-r-md px-4 py-2 flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <ul id="suggestionsList" class="absolute left-0 bg-white border border-gray-300 w-full max-h-52 overflow-y-auto hidden"></ul>
            </div>
        </div>
    </section>

    <!-- Recipe List -->
    <section class="py-10 flex-grow">
        <div class="container mx-auto max-w-6xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="recipeList">
            <!-- Recepten komen hier dynamisch -->
        </div>
    </section>

    <!-- Bekijk Meer knop -->
    <div class="text-center py-5">
        <button id="loadMoreButton" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700 transition-colors duration-300">Bekijk Meer</button>
    </div>

    <!-- Recipe Modal -->
    <div id="recipeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-3xl w-full relative overflow-y-auto max-h-screen">
            <button id="closeModal" class="absolute top-4 right-6 text-gray-600 text-3xl font-bold">&times;</button>
            <div id="modalContent">
                <img id="modalImage" class="w-full rounded-lg mb-4" src="" alt="Recipe Image">
                <h2 id="modalTitle" class="text-2xl font-bold mb-4 text-center"></h2>
                <h3 class="text-lg font-bold mb-2">Ingrediënten:</h3>
                <ul id="modalIngredients" class="list-disc list-inside text-gray-700 mb-4"></ul>
                <h3 class="text-lg font-bold mb-2">Bereiding:</h3>
                <p id="modalInstructions" class="text-gray-700 mb-4 leading-relaxed"></p>
                <iframe id="modalVideo" class="w-full h-64" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-5 text-center">
        <p>&copy; 2024 FreshGen. Alle rechten voorbehouden.</p>
    </footer>

    <!-- JavaScript -->
    <script defer src="./js/recepten.js"></script>
</body>

</html>
