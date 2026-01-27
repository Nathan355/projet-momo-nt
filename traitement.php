<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Confirmation</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="boutique.php">Boutique</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>
    <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);
            // Ici, vous pouvez ajouter le code pour envoyer un email ou sauvegarder en base de données
            echo "<p>Merci $name, votre message a été envoyé avec succès.</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Message: $message</p>";
        } else {
            echo "<p>Erreur: méthode non autorisée.</p>";
        }
        ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>