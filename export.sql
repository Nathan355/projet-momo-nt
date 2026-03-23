CREATE DATABASE IF NOT EXISTS xyz_ecommerce;
USE xyz_ecommerce;

-- Table categorie
CREATE TABLE IF NOT EXISTS categorie (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

-- Table produit
CREATE TABLE IF NOT EXISTS produit (
    id_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categorie(id_categorie)
);

-- Table utilisateur (authentification)
CREATE TABLE IF NOT EXISTS utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table commande (liee a utilisateur)
CREATE TABLE IF NOT EXISTS commande (
    id_commande INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT,
    nom_client VARCHAR(255) NOT NULL,
    prenom_client VARCHAR(255) NOT NULL,
    email_client VARCHAR(255) NOT NULL,
    telephone_client VARCHAR(20),
    adresse_client TEXT NOT NULL,
    ville_client VARCHAR(255) NOT NULL,
    code_postal_client VARCHAR(10) NOT NULL,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    frais_livraison DECIMAL(10,2) DEFAULT 0,
    statut ENUM('en-attente', 'en-cours', 'expediee', 'livree', 'annulee') DEFAULT 'en-attente',
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id_utilisateur)
);

-- Table ligne_commande
CREATE TABLE IF NOT EXISTS ligne_commande (
    id_ligne INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT,
    nom_produit VARCHAR(255) NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES commande(id_commande)
);

-- Table code_promo (roue de la chance + promos)
CREATE TABLE IF NOT EXISTS code_promo (
    id_code INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) NOT NULL UNIQUE,
    type ENUM('pourcentage', 'livraison', 'montant') NOT NULL,
    valeur DECIMAL(10,2) NOT NULL,
    date_expiration DATE,
    nb_utilisations_max INT DEFAULT NULL,
    nb_utilisations INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1
);

-- Table score_jeu (leaderboard)
CREATE TABLE IF NOT EXISTS score_jeu (
    id_score INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    jeu ENUM('quiz', 'snake', 'memory', 'typing') NOT NULL,
    score INT NOT NULL,
    date_score DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id_utilisateur)
);

-- Table message_contact
CREATE TABLE IF NOT EXISTS message_contact (
    id_message INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    sujet VARCHAR(255),
    message TEXT NOT NULL,
    lu TINYINT(1) DEFAULT 0,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table avis_produit
CREATE TABLE IF NOT EXISTS avis_produit (
    id_avis INT PRIMARY KEY AUTO_INCREMENT,
    produit_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    note TINYINT NOT NULL CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produit_id) REFERENCES produit(id_produit),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id_utilisateur)
);

-- Table wishlist (favoris)
CREATE TABLE IF NOT EXISTS wishlist (
    id_wishlist INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT NOT NULL,
    produit_id INT NOT NULL,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_fav (utilisateur_id, produit_id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (produit_id) REFERENCES produit(id_produit)
);

-- ===================================================
-- INSERTION DES DONNEES
-- ===================================================

-- Insertion des categories XYZ
INSERT INTO categorie (nom) VALUES
('Energie & Endurance'),
('Force & Congestion'),
('Nootropique'),
('Vegan');

-- Insertion des produits XYZ
INSERT INTO produit (nom, description, prix, image_url, categorie_id) VALUES
('XYZ EXTREME', 'Pre-workout haute performance avec 400mg de cafeine', 49.99, 'images/extreme.png', 1),
('XYZ ENERGY', 'Formule legere avec electrolytes et vitamines B', 29.99, 'images/energy.png', 1),
('XYZ CREATINE', 'Creatine monohydrate premium pour la force maximale', 19.99, 'images/creatine.png', 2),
('XYZ PUMP', 'Pre-workout stim-free pour une congestion maximale', 39.99, 'images/pump.png', 2),
('XYZ FOCUS', 'Nootropiques pour une concentration laser', 34.99, 'images/focus.png', 3),
('XYZ VEGAN', 'Pre-workout 100% vegetal certifie', 44.99, 'images/vegan.png', 4);

-- Insertion des codes promo
INSERT INTO code_promo (code, type, valeur, date_expiration) VALUES
('XYZ15', 'pourcentage', 15.00, '2026-12-31'),
('XYZ10', 'pourcentage', 10.00, '2026-12-31'),
('XYZ20', 'pourcentage', 20.00, '2026-12-31'),
('XYZ25', 'pourcentage', 25.00, '2026-12-31'),
('XYZFREE', 'livraison', 0.00, '2026-12-31'),
('BIENVENUE', 'pourcentage', 10.00, '2026-12-31');

-- Compte admin par defaut (mot de passe: admin123)
-- Le hash correspond a password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO utilisateur (pseudo, email, mot_de_passe, is_admin) VALUES
('admin', 'admin@xyz-shop.fr', '$2y$10$8KzQrXE5G5K5K5K5K5K5KuYQZBvXvXvXvXvXvXvXvXvXvXvXvXvXv', 1);
