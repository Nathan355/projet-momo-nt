<?php
/**
 * Script d'installation - A executer UNE SEULE FOIS pour creer le compte admin
 * Ensuite, supprimez ce fichier par securite.
 *
 * Acces: http://localhost/projet-momo-nt-main/setup-admin.php
 */
require_once 'db.php';

$admin_pseudo = 'admin';
$admin_email = 'admin@xyz-shop.fr';
$admin_password = 'admin123';

try {
    // Verifier si admin existe deja
    $stmt = $pdo->prepare("SELECT id_utilisateur FROM utilisateur WHERE pseudo = ?");
    $stmt->execute([$admin_pseudo]);

    if ($stmt->fetch()) {
        echo "<h2>Le compte admin existe deja !</h2>";
        echo "<p>Pseudo: <strong>$admin_pseudo</strong></p>";
        echo "<p>Email: <strong>$admin_email</strong></p>";
        echo "<p>Mot de passe: <strong>$admin_password</strong></p>";
    } else {
        $hash = password_hash($admin_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, is_admin) VALUES (?, ?, ?, 1)");
        $stmt->execute([$admin_pseudo, $admin_email, $hash]);

        echo "<h2 style='color: green;'>Compte admin cree avec succes !</h2>";
        echo "<p>Pseudo: <strong>$admin_pseudo</strong></p>";
        echo "<p>Email: <strong>$admin_email</strong></p>";
        echo "<p>Mot de passe: <strong>$admin_password</strong></p>";
        echo "<hr>";
        echo "<p style='color: red;'><strong>IMPORTANT:</strong> Supprimez ce fichier (setup-admin.php) apres utilisation !</p>";
    }

    echo "<br><a href='admin.php'>Aller au panel admin</a>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>Erreur</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p>Verifiez que vous avez execute le fichier <strong>export.sql</strong> dans phpMyAdmin.</p>";
}
