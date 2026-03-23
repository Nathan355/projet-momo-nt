CREATE DATABASE IF NOT EXISTS xyz_ecommerce;
USE xyz_ecommerce;

-- Table categorie
CREATE TABLE categorie (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

-- Table produit
CREATE TABLE produit (
    id_produit INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categorie(id_categorie)
);

-- Table client
CREATE TABLE client (
    id_client INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    adresse TEXT
);

-- Table commande
CREATE TABLE commande (
    id_commande INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    statut ENUM('en-attente', 'en-cours', 'expediee', 'livree', 'annulee') DEFAULT 'en-attente',
    FOREIGN KEY (client_id) REFERENCES client(id_client)
);

-- Table ligne_commande
CREATE TABLE ligne_commande (
    id_ligne INT PRIMARY KEY AUTO_INCREMENT,
    commande_id INT,
    produit_id INT,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (commande_id) REFERENCES commande(id_commande),
    FOREIGN KEY (produit_id) REFERENCES produit(id_produit)
);

-- Table utilisateur (authentification)
CREATE TABLE utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de données exemple
INSERT INTO categorie (nom) VALUES ('Électronique'), ('Vêtements');

INSERT INTO produit (nom, description, prix, categorie_id) VALUES
('Ordinateur Portable', 'Un ordinateur portable performant', 999.99, 1),
('T-shirt', 'T-shirt en coton', 19.99, 2);

INSERT INTO client (nom, prenom, email, telephone, adresse) VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', '0123456789', '123 Rue de la Paix, Paris');