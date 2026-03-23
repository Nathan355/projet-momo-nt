<?php
session_start();
require_once 'db.php';

$errors = [];
$success = false;
$commande_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $ville = trim($_POST['ville'] ?? '');
    $code_postal = trim($_POST['code_postal'] ?? '');
    $cart_json = $_POST['cart_data'] ?? '[]';

    // Validation
    if (empty($nom)) $errors[] = "Le nom est requis.";
    if (empty($prenom)) $errors[] = "Le prenom est requis.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
    if (empty($adresse)) $errors[] = "L'adresse est requise.";
    if (empty($ville)) $errors[] = "La ville est requise.";
    if (empty($code_postal)) $errors[] = "Le code postal est requis.";

    $cart = json_decode($cart_json, true);
    if (empty($cart)) $errors[] = "Votre panier est vide.";

    if (empty($errors)) {
        try {
            $pdo->beginTransaction();

            // Calculer le total
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += floatval($item['price']) * intval($item['quantity']);
            }
            $frais_livraison = $subtotal >= 50 ? 0 : 5.99;
            $total = $subtotal + $frais_livraison;

            // Inserer la commande
            $user_id = $_SESSION['user_id'] ?? null;
            $stmt = $pdo->prepare("INSERT INTO commande (utilisateur_id, nom_client, prenom_client, email_client, telephone_client, adresse_client, ville_client, code_postal_client, total, frais_livraison) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $nom, $prenom, $email, $telephone, $adresse, $ville, $code_postal, $total, $frais_livraison]);
            $commande_id = $pdo->lastInsertId();

            // Inserer les lignes de commande
            $stmt = $pdo->prepare("INSERT INTO ligne_commande (commande_id, nom_produit, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
            foreach ($cart as $item) {
                $stmt->execute([
                    $commande_id,
                    $item['name'],
                    intval($item['quantity']),
                    floatval($item['price'])
                ]);
            }

            $pdo->commit();
            $success = true;

        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors[] = "Erreur lors de la commande : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Finaliser la commande</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="navbar">
        <div class="nav-container">
            <div class="logo"><i class="fas fa-bolt"></i> XYZ</div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">A Propos</a></li>
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

    <section class="shop-hero">
        <h1><i class="fas fa-credit-card"></i> FINALISER LA COMMANDE</h1>
        <p>Remplissez vos informations de livraison</p>
    </section>

    <section class="checkout-section">
        <?php if ($success): ?>
            <div class="checkout-success">
                <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                <h2>Commande confirmee !</h2>
                <p>Votre commande <strong>#CMD-<?= str_pad($commande_id, 4, '0', STR_PAD_LEFT) ?></strong> a ete enregistree avec succes.</p>
                <p>Vous recevrez un email de confirmation a l'adresse indiquee.</p>
                <div class="result-actions">
                    <a href="boutique.php" class="cta-button"><i class="fas fa-shopping-bag"></i> Continuer mes achats</a>
                    <a href="index.php" class="cta-button secondary">Accueil</a>
                </div>
            </div>
            <script>localStorage.removeItem('cartItems');</script>
        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <div class="auth-errors">
                    <?php foreach ($errors as $error): ?>
                        <p><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="checkout-grid">
                <form method="POST" id="checkout-form" class="checkout-form-block">
                    <h2><i class="fas fa-truck"></i> Informations de livraison</h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($nom ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom *</label>
                            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($prenom ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? ($_SESSION['user_email'] ?? '')) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($telephone ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="adresse">Adresse *</label>
                        <input type="text" id="adresse" name="adresse" placeholder="Numero et nom de rue" value="<?= htmlspecialchars($adresse ?? '') ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ville">Ville *</label>
                            <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($ville ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="code_postal">Code postal *</label>
                            <input type="text" id="code_postal" name="code_postal" value="<?= htmlspecialchars($code_postal ?? '') ?>" required>
                        </div>
                    </div>

                    <input type="hidden" name="cart_data" id="cart_data" value="">

                    <button type="submit" class="cta-button checkout-submit-btn" id="checkout-submit">
                        <i class="fas fa-lock"></i> Confirmer la commande
                    </button>
                    <p class="secure-text"><i class="fas fa-shield-alt"></i> Paiement securise - Vos donnees sont protegees</p>
                </form>

                <div class="checkout-summary">
                    <h2><i class="fas fa-receipt"></i> Recapitulatif</h2>
                    <div id="checkout-items"></div>
                    <div class="summary-divider"></div>
                    <div class="summary-row"><span>Sous-total</span><span id="checkout-subtotal">0.00</span></div>
                    <div class="summary-row"><span>Livraison</span><span id="checkout-shipping">5.99</span></div>
                    <div class="summary-divider"></div>
                    <div class="summary-row total"><span>Total</span><span id="checkout-total">0.00</span></div>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>XYZ</h4><p>Les meilleurs supplements pre-workout pour vos performances</p></div>
            <div class="footer-section"><h4>LIENS RAPIDES</h4><ul><li><a href="boutique.php">Boutique</a></li><li><a href="presentation.php">A Propos</a></li><li><a href="mentions.php">Mentions legales</a></li></ul></div>
            <div class="footer-section"><h4>CONTACT</h4><ul><li><a href="contact.php">Nous Contacter</a></li><li><i class="fas fa-phone"></i> 01 23 45 67 89</li><li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li></ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2026 XYZ - Tous droits reserves</p></div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const itemsDiv = document.getElementById('checkout-items');
        const form = document.getElementById('checkout-form');

        if (!itemsDiv) return; // Page de succes

        if (cartItems.length === 0) {
            itemsDiv.innerHTML = '<p style="text-align:center; color:#666;">Votre panier est vide.</p>';
            const btn = document.getElementById('checkout-submit');
            if (btn) btn.disabled = true;
            return;
        }

        // Afficher les articles
        let subtotal = 0;
        cartItems.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            const div = document.createElement('div');
            div.className = 'checkout-item';
            div.innerHTML = '<div class="checkout-item-info"><strong>' + item.name + '</strong><span>x' + item.quantity + '</span></div><span class="checkout-item-price">' + itemTotal.toFixed(2) + ' &euro;</span>';
            itemsDiv.appendChild(div);
        });

        const shipping = subtotal >= 50 ? 0 : 5.99;
        const total = subtotal + shipping;

        document.getElementById('checkout-subtotal').textContent = subtotal.toFixed(2) + ' \u20AC';
        document.getElementById('checkout-shipping').textContent = shipping === 0 ? 'GRATUITE' : shipping.toFixed(2) + ' \u20AC';
        if (shipping === 0) document.getElementById('checkout-shipping').classList.add('free-shipping');
        document.getElementById('checkout-total').textContent = total.toFixed(2) + ' \u20AC';

        // Envoyer les donnees du panier au formulaire
        document.getElementById('cart_data').value = JSON.stringify(cartItems);

        // Menu burger
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('nav-active');
                navToggle.classList.toggle('is-active');
            });
        }

        // Cart badge
        const cartBadge = document.querySelector('.cart-count-badge');
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (cartBadge && totalItems > 0) { cartBadge.textContent = totalItems; cartBadge.style.display = 'flex'; }
    });
    </script>
</body>
</html>
