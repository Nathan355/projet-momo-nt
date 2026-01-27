<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement du Formulaire</title>
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
        <section class="content-page-section">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = htmlspecialchars(trim($_POST['nom']));
                $prenom = htmlspecialchars(trim($_POST['prenom']));
                $email = htmlspecialchars(trim($_POST['email']));
                $sujet = htmlspecialchars(trim($_POST['sujet']));
                $message = htmlspecialchars(trim($_POST['message']));
                $errors = [];
                if (empty($nom)) { $errors[] = "Le nom est requis."; }
                if (empty($prenom)) { $errors[] = "Le prénom est requis."; }
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Une adresse email valide est requise."; }
                if (empty($sujet)) { $errors[] = "Veuillez choisir un sujet."; }
                if (empty($message) || strlen($message) < 10) { $errors[] = "Le message doit contenir au moins 10 caractères."; }
                if (count($errors) > 0) {
                    echo "<h1>Erreur de soumission</h1>";
                    echo "<p class='subtitle'>Votre formulaire contient des erreurs. Veuillez retourner en arrière.</p>";
                    echo "<div class='legal-content'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</ul></div>";
                    echo '<p><a href="contact.php" class="cta-button" style="display: inline-block; margin-top: 1rem;">Retour au formulaire</a></p>';
                } else {
                    echo "<h1>Message envoyé !</h1>";
                    echo "<p class='subtitle'>Merci, $prenom. Votre message a bien été reçu. Nous vous répondrons dans les plus brefs délais.</p>";
                    echo "<div class='legal-content'>";
                    echo "<h3>Récapitulatif de votre message :</h3>";
                    echo "<p><strong>Nom :</strong> $nom $prenom</p>";
                    echo "<p><strong>Email :</strong> $email</p>";
                    echo "<p><strong>Sujet :</strong> $sujet</p>";
                    echo "<p><strong>Message :</strong><br>" . nl2br($message) . "</p>";
                    echo "</div>";
                }

            } else {
                echo "<h1>Accès non autorisé</h1>";
                echo "<p>Cette page ne peut être accédée directement.</p>";
            }
            ?>
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

    <script src="js/script.js"></script>
</body>
</html>