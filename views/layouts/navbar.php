<?php require("core/functions.php"); ?>
<?php
// index.php

// تعريف الثوابت في الأعلى
define('BASE_URL', 'http://localhost/project/');
define('ASSETS_URL', BASE_URL . 'assets/');

?>
<?php
// تعريفات للـ Navigation Links
$navLinks = [
    ['name' => 'THE MENU', 'href' => '#menu'],
    ['name' => 'THE LOUNGE', 'href' => '#lounge'],
    ['name' => 'RESERVATIONS', 'href' => '#reservations'],
    ['name' => 'ABOUT US', 'href' => '#about']
];
?>

<nav class="navbar" id="navbar">
    <div class="navbar-container">
        <!-- LOGO Section -->
        <div class="navbar-logo" id="navbarLogo">
            <a href="<?php echo BASE_URL; ?>" class="logo-link">
                <span class="logo-text">Verdant Café &</span>
                <span class="logo-lounge">Lounge</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <ul class="navbar-menu" id="navbarMenu">
            <?php foreach($navLinks as $link): ?>
                <li class="navbar-item">
                    <a href="<?php echo htmlspecialchars($link['href']); ?>" class="navbar-link">
                        <?php echo htmlspecialchars($link['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Mobile Menu Toggle -->
        <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation menu">
            <span class="hamburger"></span>
        </button>
    </div>
</nav>