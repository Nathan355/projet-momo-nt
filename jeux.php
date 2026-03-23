<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Mini-Jeux</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo">
                <i class="fas fa-bolt"></i> XYZ
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">A Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="jeux.php" class="active">Jeux</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <a href="admin.php" class="admin-icon" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <div class="promo-marquee">
        <div class="promo-marquee-content">
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
        </div>
    </div>

    <section class="games-hero">
        <h1><i class="fas fa-gamepad"></i> ESPACE JEUX</h1>
        <p>Detendez-vous entre deux seances avec nos mini-jeux !</p>
    </section>

    <section class="games-grid-section">
        <div class="games-grid">
            <a href="quiz.php" class="game-card">
                <div class="game-icon"><i class="fas fa-question-circle"></i></div>
                <h3>Quiz Fitness</h3>
                <p>Testez vos connaissances en nutrition et fitness !</p>
                <span class="game-badge">10 questions</span>
            </a>
            <a href="snake.php" class="game-card">
                <div class="game-icon"><i class="fas fa-dragon"></i></div>
                <h3>Snake Game</h3>
                <p>Le classique du jeu video, version XYZ !</p>
                <span class="game-badge">Arcade</span>
            </a>
            <a href="memory-game.php" class="game-card">
                <div class="game-icon"><i class="fas fa-brain"></i></div>
                <h3>Memory Card</h3>
                <p>Retrouvez les paires de produits XYZ !</p>
                <span class="game-badge">8 paires</span>
            </a>
            <a href="typing.php" class="game-card">
                <div class="game-icon"><i class="fas fa-keyboard"></i></div>
                <h3>Speed Typing</h3>
                <p>Tapez le plus vite possible pour battre le chrono !</p>
                <span class="game-badge">60 secondes</span>
            </a>
            <a href="wheel.php" class="game-card">
                <div class="game-icon"><i class="fas fa-circle-notch"></i></div>
                <h3>Roue de la Chance</h3>
                <p>Tentez de gagner des reductions exclusives !</p>
                <span class="game-badge">Bonus</span>
            </a>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>XYZ</h4>
                <p>Les meilleurs supplements pre-workout pour vos performances</p>
            </div>
            <div class="footer-section">
                <h4>LIENS RAPIDES</h4>
                <ul>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">A Propos</a></li>
                    <li><a href="mentions.php">Mentions legales</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>CONTACT</h4>
                <ul>
                    <li><a href="contact.php">Nous Contacter</a></li>
                    <li><i class="fas fa-phone"></i> 01 23 45 67 89</li>
                    <li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 XYZ - Tous droits reserves | Livraison gratuite a partir de 50</p>
        </div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>
    <script src="js/script.js"></script>
</body>
</html>
