<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Votre Panier</title>
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
                </ul>
            </nav>
            <div class="nav-icons">
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <main>
        <section class="cart-section" id="cart-page">
            <h1>Votre Panier</h1>
            
            <div id="cart-empty-state" style="display: none; text-align: center; padding: 4rem 0;">
                <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">Votre panier est vide pour le moment.</p>
                <a href="boutique.php" class="cta-button">Découvrir nos produits</a>
            </div>

            <div class="cart-wrapper" id="cart-full-state">
                <div class="cart-items" id="cart-items-container">
                    <!-- Les articles du panier seront insérés ici par JavaScript -->
                </div>

                <!-- Résumé de commande -->
                <div class="cart-summary-box">
                    <h2>Résumé de la commande</h2>
                    <div class="summary-row">
                        <span>Sous-total</span>
                        <span id="summary-subtotal">0.00€</span>
                    </div>
                    <div class="summary-row">
                        <span>Livraison</span>
                        <span id="summary-shipping">Calcul...</span>
                    </div>
                    <div class="summary-divider"></div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="summary-total">0.00€</span>
                    </div>
                    <button class="checkout-btn"><i class="fas fa-lock"></i> Passer la commande</button>
                    <p class="secure-text"><i class="fas fa-shield-alt"></i> Paiement 100% sécurisé</p>
                    <div class="payment-methods">
                        <i class="fab fa-cc-visa"></i> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-paypal"></i> <i class="fab fa-cc-apple-pay"></i>
                    </div>
                </div>
            </div>

            <!-- Continuer les achats -->
            <div class="continue-shopping" id="continue-shopping-link-bottom">
                <a href="boutique.php"><i class="fas fa-arrow-left"></i> Continuer mes achats</a>
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
                    <li><i class="fas fa-envelope"></i> info@pumppower.fr</li>
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