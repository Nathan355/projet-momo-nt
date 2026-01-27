# XYZ E-commerce - Plateforme de Commerce Électronique

## Description du Projet

Ce projet consiste en le développement d'une plateforme de e-commerce complète pour l'entreprise XYZ. Il respecte les normes techniques strictes imposées, incluant une architecture avec au minimum 10 pages distinctes, une base de données relationnelle, et des interactions dynamiques.

## Architecture du Projet

Le site est structuré autour de 10 pages PHP distinctes pour répondre aux exigences du projet, chacune ayant un rôle fonctionnel spécifique :

1.  **index.php** : Page d'accueil.
2.  **boutique.php** : Page principale de la boutique affichant tous les produits.
3.  **produit.php** : Modèle de page pour l'affichage détaillé d'un produit spécifique.
4.  **categorie_a.php** : Modèle de page pour une catégorie de produits (ex: Énergie).
5.  **categorie_b.php** : Modèle de page pour une autre catégorie (ex: Force).
6.  **panier.php** : Page du panier d'achat, gérée côté client avec JavaScript.
7.  **contact.php** : Formulaire de contact avec validation côté client.
8.  **traitement.php** : Page de traitement et de validation côté serveur pour le formulaire de contact.
9.  **presentation.php** : Page "À propos" de l'entreprise.
10. **mentions.php** : Page des mentions légales.

## Structure des Fichiers

```
nwe project avec momo/
├── index.php                 # Page d'accueil
├── catalogue.php             # Catalogue des produits
├── produit.php               # Détail produit
├── categorie_a.php           # Catégorie A
├── categorie_b.php           # Catégorie B
├── panier.php                # Panier d'achat
├── contact.php               # Formulaire de contact
├── traitement.php            # Traitement PHP
├── presentation.php          # À propos
├── mentions.php              # Mentions légales
├── css/
│   └── style.css             # Feuilles de styles externes
├── js/
│   └── script.js             # Interactions JavaScript
├── assets/                   # Images des produits
├── database_design.txt       # MCD et MLD
├── export.sql                # Script SQL de la base
└── README.md                 # Ce fichier
```

## Conception de la Base de Données

### Modèle Conceptuel de Données (MCD)
- **Entités** : Produit, Categorie, Client, Commande, LigneCommande
- **Associations** : Relations entre les entités pour maintenir l'intégrité

### Modèle Logique de Données (MLD)
- Tables SQL avec clés primaires et étrangères
- Contraintes d'intégrité référentielle

### Export SQL
- Fichier `export.sql` contenant la structure complète de la base
- Inclut des données d'exemple pour les tests

## Technologies Utilisées

- **HTML5** : Structure sémantique des pages
- **CSS3** : Mise en page responsive et styles externes
- **JavaScript** : Interactions dynamiques et validation de formulaires
- **PHP** : Traitement côté serveur et logique métier
- **MySQL** : Base de données relationnelle
- **Git** : Gestion de version

## Fonctionnalités Clés

### Interactivité JavaScript
- Validation avancée du formulaire de contact
- Menu responsive pour mobile
- Interactions dynamiques utilisateur

### Traitement PHP
- Variables dynamiques pour les calculs
- Conditions pour la logique métier (ex: remises)
- Validation et traitement des données

### Base de Données
- Gestion des produits et catégories
- Système de clients et commandes
- Lignes de commande détaillées

## Installation et Configuration

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Nathan355/projet-momo-nt.git
   cd "nwe project avec momo"
   ```

2. **Configurer la base de données** :
   - Importer `export.sql` dans MySQL
   - Configurer les connexions PHP (à implémenter)

3. **Lancer le serveur** :
   - Utiliser XAMPP, WAMP ou un serveur PHP local
   - Accéder à `index.php` via localhost

## Développement et Contributions

- Commits réguliers sur le dépôt GitHub
- Respect des standards de codage
- Tests fonctionnels avant déploiement

## Auteur

Développé pour l'entreprise XYZ - 2026

## Licence

Tous droits réservés - Entreprise XYZ
