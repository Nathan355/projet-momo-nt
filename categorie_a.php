<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Catégorie Énergie</title>
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
                    <li><a href="presentation.php">À Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="jeux.php">Jeux</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <a href="admin.php" class="admin-icon" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <main>
        <section class="shop-hero">
            <h1>Catégorie : Énergie & Endurance</h1>
            <p>Des formules conçues pour une énergie explosive et une endurance à toute épreuve.</p>
        </section>

        <section class="featured-products" id="shop-products-list">
            <div class="products-container">
                <div class="product-card scroll-animate">
                    <div class="product-image">
                        <img src="images/extreme.png" alt="XYZ Extreme">
                        <div class="badge">BEST SELLER</div>
                    </div>
                    <div class="product-info">
                        <h3>XYZ EXTREME</h3>
                        <p>Pré-workout haute performance avec 400mg de caféine.</p>
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
                        <p>Formule légère avec électrolytes et vitamines B.</p>
                        <div class="rating">⭐⭐⭐⭐ (156 avis)</div>
                        <div class="product-footer">
                            <span class="price">29.99€</span>
                            <button class="add-to-cart"><i class="fas fa-shopping-bag"></i></button>
                        </div>
                    </div>
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