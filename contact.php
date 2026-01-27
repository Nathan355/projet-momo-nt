<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ E-commerce - Contact</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="catalogue.php">Boutique</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Contactez-nous</h1>
        <form id="contactForm" action="traitement.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone">

            <label for="sujet">Sujet :</label>
            <select id="sujet" name="sujet" required>
                <option value="">Choisissez un sujet</option>
                <option value="commande">Commande</option>
                <option value="retour">Retour produit</option>
                <option value="support">Support technique</option>
                <option value="autre">Autre</option>
            </select>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <label>
                <input type="checkbox" id="newsletter" name="newsletter">
                S'abonner à la newsletter
            </label>

            <button type="submit">Envoyer</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 Entreprise XYZ - Tous droits réservés</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>