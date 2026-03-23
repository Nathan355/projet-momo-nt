<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ E-commerce - Présentation</title>
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
                    <li><a href="presentation.php" class="active">À Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="jeux.php">Jeux</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <?php if (isset($_SESSION['user_pseudo'])): ?>
                    <div class="user-menu">
                        <span class="user-badge"><i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['user_pseudo']) ?></span>
                        <a href="logout.php" class="logout-link" title="Deconnexion"><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="login-link" title="Se connecter"><i class="fas fa-user"></i> Connexion</a>
                <?php endif; ?>
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

    <main>
        <section class="about-hero">
            <div class="hero-content">
                <h1 class="hero-title">NOTRE HISTOIRE</h1>
                <p class="hero-subtitle">Nés de la passion pour la performance, conçus par la science.</p>
            </div>
        </section>

        <section class="story-section">
            <div class="story-container">
                <div class="story-image scroll-animate">
                    <img src="images/TETE.png" alt="Laboratoire de recherche XYZ">
                </div>
                <div class="story-text scroll-animate">
                    <h2>La Genèse de l'Excellence</h2>
                    <p>Fondée en 2020 par des passionnés de fitness et des scientifiques du sport, XYZ a pour mission de créer les suppléments pré-workout les plus efficaces et les plus propres du marché. Nous croyons que chaque athlète, du débutant au professionnel, mérite des produits de la plus haute qualité pour atteindre ses objectifs.</p>
                    <p>Nos formules sont développées sur la base des dernières recherches scientifiques, en utilisant uniquement des ingrédients dont l'efficacité a été prouvée. Pas de mélanges propriétaires obscurs, pas de dosages inefficaces. Juste de la pure performance en pot.</p>
                </div>
            </div>
        </section>

        <section class="benefits">
            <h2 class="scroll-animate">Nos Engagements</h2>
            <div class="benefits-grid">
                <div class="benefit-card scroll-animate">
                    <i class="fas fa-vial"></i>
                    <h3>Transparence Totale</h3>
                    <p>Chaque ingrédient et son dosage sont clairement indiqués sur nos étiquettes. Zéro secret.</p>
                </div>
                <div class="benefit-card scroll-animate" style="transition-delay: 0.1s;">
                    <i class="fas fa-award"></i>
                    <h3>Qualité Supérieure</h3>
                    <p>Nous utilisons des matières premières de la plus haute qualité, testées en laboratoire pour leur pureté et leur puissance.</p>
                </div>
                <div class="benefit-card scroll-animate" style="transition-delay: 0.2s;">
                    <i class="fas fa-lightbulb"></i>
                    <h3>Innovation Continue</h3>
                    <p>Notre équipe R&D travaille sans relâche pour vous proposer des produits à la pointe de la science du sport.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>XYZ</h4>
                <p>Les meilleurs suppléments pré-workout pour vos performances</p>
            </div>
            <div class="footer-section">
                <h4>LIENS RAPIDES</h4>
                <ul>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">À Propos</a></li>
                    <li><a href="mentions.php">Mentions légales</a></li>
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
            <p>&copy; 2026 XYZ - Tous droits réservés | Livraison gratuite à partir de 50€</p>
        </div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>

    <script src="js/script.js"></script>
</body>
</html>