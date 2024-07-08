<nav class="bg-gray-800 py-4 px-8">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="/index.php" class="text-white text-2xl font-bold">Marketplace</a>

        <!-- Search Bar -->
        <form action="/products.php" method="GET" class="flex items-center">
    <input type="text" placeholder="Rechercher..." name="search" class="py-2 px-4 bg-gray-700 text-white rounded-l-md focus:bg-gray-700 focus:text-white focus:outline-none">
    <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-r-md hover:text-blue-200">Rechercher</button>
</form>

        <!-- User Info and Cart Icon -->
        <div class="flex items-center">
        <!-- Infos Utilisateur -->
        <?php if(isset($_SESSION['username'])) : ?>
            <span class="text-white mr-4">Bienvenue, <?php echo $_SESSION['username']; ?></span>
            <a href="/users/logout.php" class="text-white mr-4">Déconnexion</a>
        <?php else : ?>
            <a href="/login.html" class="text-white mr-4 rounded-md bg-blue-500 px-3 py-1 hover:bg-blue-700 hover:text-gray-50 transition-colors">Connexion</a>
        <?php endif; ?>

        <!-- Icône Panier -->
        
        <a href="/cart.php">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-white">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
</svg>
        </a>


    </div>
    </div>
</nav>

