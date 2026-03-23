<?php
session_start();
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Traitement du Formulaire</title>
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

    <main>
        <section class="content-page-section">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = trim($_POST['nom'] ?? '');
                $prenom = trim($_POST['prenom'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $sujet = trim($_POST['sujet'] ?? '');
                $message = trim($_POST['message'] ?? '');

                $errors = [];
                if (empty($nom)) $errors[] = "Le nom est requis.";
                if (empty($prenom)) $errors[] = "Le prenom est requis.";
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Une adresse email valide est requise.";
                if (empty($sujet)) $errors[] = "Veuillez choisir un sujet.";
                if (empty($message) || strlen($message) < 10) $errors[] = "Le message doit contenir au moins 10 caracteres.";

                if (count($errors) > 0) {
                    echo "<h1>Erreur de soumission</h1>";
                    echo "<div class='auth-errors' style='max-width:600px; margin: 1rem auto;'>";
                    foreach ($errors as $error) {
                        echo "<p><i class='fas fa-exclamation-circle'></i> " . htmlspecialchars($error) . "</p>";
                    }
                    echo "</div>";
                    echo '<p style="text-align:center;"><a href="contact.php" class="cta-button" style="display:inline-block; margin-top:1rem; text-decoration:none;">Retour au formulaire</a></p>';
                } else {
                    // Sauvegarder en base de donnees
                    try {
                        $stmt = $pdo->prepare("INSERT INTO message_contact (nom, prenom, email, sujet, message) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$nom, $prenom, $email, $sujet, $message]);

                        echo "<div style='text-align:center;'>";
                        echo "<i class='fas fa-check-circle' style='font-size:4rem; color:#4CAF50; margin-bottom:1rem;'></i>";
                        echo "<h1>Message envoye !</h1>";
                        echo "<p>Merci " . htmlspecialchars($prenom) . ". Votre message a bien ete recu et enregistre.</p>";
                        echo "<p>Nous vous repondrons dans les plus brefs delais.</p>";
                        echo "<div class='legal-content' style='text-align:left; margin-top:2rem;'>";
                        echo "<h3>Recapitulatif :</h3>";
                        echo "<p><strong>Nom :</strong> " . htmlspecialchars($nom) . " " . htmlspecialchars($prenom) . "</p>";
                        echo "<p><strong>Email :</strong> " . htmlspecialchars($email) . "</p>";
                        echo "<p><strong>Sujet :</strong> " . htmlspecialchars($sujet) . "</p>";
                        echo "<p><strong>Message :</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
                        echo "</div>";
                        echo '<p style="text-align:center; margin-top:1.5rem;"><a href="index.php" class="cta-button" style="display:inline-block; text-decoration:none;">Retour a l\'accueil</a></p>';
                        echo "</div>";
                    } catch (PDOException $e) {
                        echo "<h1>Erreur</h1>";
                        echo "<p>Une erreur est survenue lors de l'envoi. Veuillez reessayer.</p>";
                        echo '<p><a href="contact.php" class="cta-button" style="display:inline-block; margin-top:1rem; text-decoration:none;">Retour au formulaire</a></p>';
                    }
                }
            } else {
                echo "<h1>Acces non autorise</h1>";
                echo "<p>Cette page ne peut etre accedee directement.</p>";
                echo '<p><a href="contact.php" class="cta-button" style="display:inline-block; margin-top:1rem; text-decoration:none;">Aller au formulaire de contact</a></p>';
            }
            ?>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>XYZ</h4><p>Les meilleurs supplements pre-workout pour vos performances</p></div>
            <div class="footer-section"><h4>LIENS RAPIDES</h4><ul><li><a href="boutique.php">Boutique</a></li><li><a href="presentation.php">A Propos</a></li><li><a href="mentions.php">Mentions legales</a></li></ul></div>
            <div class="footer-section"><h4>CONTACT</h4><ul><li><a href="contact.php">Nous Contacter</a></li><li><i class="fas fa-phone"></i> 01 23 45 67 89</li><li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li></ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2026 XYZ - Tous droits reserves</p></div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>
    <script src="js/script.js"></script>
</body>
</html>
