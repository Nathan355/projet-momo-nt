<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Votre Pré-Workout Premium</title>
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
                    <li><a href="index.php" class="active">Accueil</a></li>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">À Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">EXPLOSEZ VOS PERFORMANCES</h1>
            <p class="hero-subtitle">Les meilleurs suppléments pré-workout pour maximiser votre entraînement</p>
            <button class="cta-button"><a href="boutique.php">DÉCOUVRIR NOS PRODUITS</a></button>
        </div>
    </section>

    <section class="benefits">
        <h2 class="scroll-animate">Pourquoi XYZ ?</h2>
        <div class="benefits-grid">
            <div class="benefit-card scroll-animate">
                <i class="fas fa-rocket"></i>
                <h3>Énergie Maximale</h3>
                <p>Formules avec caféine premium pour une énergie sans égale</p>
            </div>
            <div class="benefit-card scroll-animate" style="transition-delay: 0.1s;">
                <i class="fas fa-fire"></i>
                <h3>Endurance Extrême</h3>
                <p>Beta-alanine et citrulline pour repousser vos limites</p>
            </div>
            <div class="benefit-card scroll-animate" style="transition-delay: 0.2s;">
                <i class="fas fa-dumbbell"></i>
                <h3>Force Brute</h3>
                <p>Créatine pure pour des gains de puissance impressionnants</p>
            </div>
            <div class="benefit-card scroll-animate" style="transition-delay: 0.3s;">
                <i class="fas fa-heart"></i>
                <h3>Santé Optimale</h3>
                <p>Ingrédients naturels testés et certifiés</p>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <h2 class="scroll-animate">PRODUITS EN VEDETTE</h2>
        <div class="products-container">
            <div class="product-card scroll-animate">
                <div class="product-image">
                    <img src="images/extreme.png" alt="XYZ Extreme">
                    <div class="badge">BEST SELLER</div>
                </div>
                <div class="product-info">
                    <h3>XYZ EXTREME</h3>
                    <p>Pré-workout haute performance avec 400mg de caféine</p>
                    <div class="rating">⭐⭐⭐⭐⭐ (234 avis)</div>
                    <div class="product-footer">
                        <span class="price">49.99€</span>
                        <button class="add-to-cart"><i class="fas fa-shopping-bag"></i></button>
                    </div>
                </div>
            </div>

            <div class="product-card scroll-animate" style="transition-delay: 0.1s;">
                <div class="product-image">
                    <img src="images/energy.png" alt="XYZ Energy">
                    <div class="badge">NOUVELLE SAVEUR</div>
                </div>
                <div class="product-info">
                    <h3>XYZ ENERGY</h3>
                    <p>Formule légère avec électrolytes et vitamines B</p>
                    <div class="rating">⭐⭐⭐⭐ (156 avis)</div>
                    <div class="product-footer">
                        <span class="price">29.99€</span>
                        <button class="add-to-cart"><i class="fas fa-shopping-bag"></i></button>
                    </div>
                </div>
            </div>

            <div class="product-card scroll-animate" style="transition-delay: 0.2s;">
                <div class="product-image">
                    <img src="images/creatine.png" alt="XYZ Creatine">
                    <div class="badge">PROMO -20%</div>
                </div>
                <div class="product-info">
                    <h3>XYZ CREATINE</h3>
                    <p>Créatine monohydrate premium pour la force maximale</p>
                    <div class="rating">⭐⭐⭐⭐⭐ (189 avis)</div>
                    <div class="product-footer">
                        <div class="price-section">
                            <span class="price-original">24.99€</span>
                            <span class="price">19.99€</span>
                        </div>
                        <button class="add-to-cart"><i class="fas fa-shopping-bag"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section scroll-animate">
        <h2>PRÊT À TRANSFORMER VOTRE ENTRAÎNEMENT ?</h2>
        <p>Rejoignez des milliers d'athlètes qui ont amélioré leurs performances</p>
        <button class="cta-button secondary"><a href="boutique.php">VOIR TOUS LES PRODUITS</a></button>
    </section>

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
