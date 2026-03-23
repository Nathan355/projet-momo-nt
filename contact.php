<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ E-commerce - Contact</title>
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
                    <li><a href="contact.php" class="active">Contact</a></li>
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
        <section class="contact-page-wrapper">
            <div class="contact-grid">
                <div class="contact-info-block">
                    <h1 class="contact-title">Entrons en contact</h1>
                    <p class="contact-subtitle">Nous sommes là pour répondre à toutes vos questions. Remplissez le formulaire ou utilisez nos coordonnées directes.</p>
                    
                    <div class="contact-details">
                        <div class="contact-detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Notre Siège</h4>
                                <p>123 Rue du Muscle, 75001 Paris, France</p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:info@pumppower.fr">XYZ.Proteine@outlook.fr</a></p>
                            </div>
                        </div>
                        <div class="contact-detail-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Téléphone</h4>
                                <p><a href="tel:0123456789">01 23 45 67 89</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-block">
                    <form id="contactForm" class="contact-form" action="traitement.php" method="post">
                        <h2>Envoyez-nous un message</h2>
                        <div class="form-row">
                            <div class="form-group"><label for="nom">Nom</label><input type="text" id="nom" name="nom" required placeholder="Votre nom"></div>
                            <div class="form-group"><label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom" required placeholder="Votre prénom"></div>
                        </div>
                        <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" required placeholder="Votre email"></div>
                        <div class="form-group"><label for="sujet">Sujet</label><select id="sujet" name="sujet" required><option value="">Choisissez un sujet</option><option value="commande">Question sur une commande</option><option value="retour">Demande de retour</option><option value="support">Support produit</option><option value="autre">Autre</option></select></div>
                        <div class="form-group"><label for="message">Message</label><textarea id="message" name="message" rows="6" required placeholder="Votre message..."></textarea></div>
                        <button type="submit" class="cta-button">Envoyer le message</button>
                    </form>
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
                    <li><i class="fas fa-envelope"></i>XYZ.Proteine@outlook.fr</li>
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
