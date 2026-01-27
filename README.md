# 🏋️ XYZ - Boutique de Suppléments Pré-Workout

## 📋 Description du Projet

Plateforme e-commerce complète pour la vente de suppléments pré-workout et produits de fitness. Le site propose une expérience utilisateur moderne avec un design responsive, un système de panier dynamique côté client, et un formulaire de contact avec double validation (JavaScript + PHP).

## ✨ Fonctionnalités Implémentées

### 🛒 Système de Panier Avancé
- **Gestion via LocalStorage** : Panier persistant entre les sessions
- **Ajout/Suppression de produits** : Interface intuitive avec boutons +/-
- **Calcul automatique** : Sous-total, frais de livraison (gratuit > 50€), total
- **Badge dynamique** : Affichage du nombre d'articles dans la navbar
- **Notifications Toast** : Confirmation visuelle lors de l'ajout au panier
- **États vide/plein** : Affichage conditionnel selon le contenu du panier

### 🎨 Design & Interface
- **Thème sportif moderne** : Couleurs rouge (#FF1744), noir et accents jaunes
- **Navigation sticky** : Barre de navigation fixe avec logo et icônes
- **Hero section** : Image de fond avec effet blur et overlay
- **Animations au scroll** : Apparition progressive des éléments
- **Cards produits** : Badges (Best Seller, Promo, Nouvelle Saveur), ratings, prix barrés
- **Footer complet** : Liens rapides, contact, réseaux sociaux

### 📱 Responsive Design
- **Menu hamburger** : Navigation mobile avec animation du bouton
- **Grilles adaptatives** : Produits sur 1-4 colonnes selon l'écran
- **Typographie fluide** : Tailles de texte adaptées

### 📝 Formulaire de Contact
- **Validation JavaScript** : Vérification en temps réel avant envoi
- **Validation PHP** : Double vérification côté serveur (traitement.php)
- **Champs** : Nom, Prénom, Email, Sujet (select), Message
- **Feedback utilisateur** : Récapitulatif après envoi réussi

### 🛍️ Catalogue Produits
6 produits disponibles :
| Produit | Prix | Badge |
|---------|------|-------|
| XYZ EXTREME | 49.99€ | Best Seller |
| XYZ ENERGY | 29.99€ | Nouvelle Saveur |
| XYZ CREATINE | 19.99€ (~~24.99€~~) | Promo -20% |
| XYZ PUMP | 39.99€ | Sans Stimulant |
| XYZ FOCUS | 44.99€ | Nouveau |
| XYZ VEGAN | 34.99€ | 100% Végétal |

## 🏗️ Architecture du Projet

### Pages (10 fichiers PHP)
| Page | Description |
|------|-------------|
| `index.php` | Accueil avec hero, avantages et produits vedettes |
| `boutique.php` | Catalogue complet des produits |
| `produit.php` | Détail d'un produit spécifique |
| `categorie_a.php` | Catégorie Énergie |
| `categorie_b.php` | Catégorie Force |
| `panier.php` | Panier d'achat avec résumé de commande |
| `contact.php` | Formulaire de contact moderne |
| `traitement.php` | Traitement PHP du formulaire |
| `presentation.php` | Page "À propos" de l'entreprise |
| `mentions.php` | Mentions légales |

### Structure des Fichiers
```
projet-momo-nt-main/
├── index.php                 # Page d'accueil
├── boutique.php              # Catalogue produits
├── produit.php               # Détail produit
├── categorie_a.php           # Catégorie Énergie
├── categorie_b.php           # Catégorie Force
├── panier.php                # Panier d'achat
├── contact.php               # Formulaire de contact
├── traitement.php            # Traitement PHP
├── presentation.php          # À propos
├── mentions.php              # Mentions légales
├── css/
│   └── style.css             # Styles (1345 lignes)
├── js/
│   └── script.js             # JavaScript (244 lignes)
├── images/
│   ├── TETE.png              # Image hero background
│   ├── extreme.png           # Image produit
│   ├── energy.png            # Image produit
│   ├── creatine.png          # Image produit
│   ├── pump.png              # Image produit
│   ├── focus.png             # Image produit
│   └── vegan.png             # Image produit
├── database_design.txt       # MCD et MLD
├── export.sql                # Script SQL
├── MCD Projet.loo            # Fichier Looping MCD
└── README.md                 # Documentation
```

## 🗄️ Base de Données

### Modèle Conceptuel (MCD)
- **Produit** : id, nom, description, prix, image_url, categorie_id
- **Categorie** : id, nom
- **Client** : id, nom, prenom, email, telephone, adresse
- **Commande** : id, client_id, date_commande, total
- **LigneCommande** : id, commande_id, produit_id, quantite, prix_unitaire

### Relations
- Un Produit appartient à une Catégorie (N:1)
- Un Client passe plusieurs Commandes (1:N)
- Une Commande contient plusieurs LigneCommande (1:N)
- Une LigneCommande référence un Produit (N:1)

## 🛠️ Technologies Utilisées

| Technologie | Utilisation |
|-------------|-------------|
| **HTML5** | Structure sémantique |
| **CSS3** | Variables CSS, Flexbox, Grid, animations |
| **JavaScript** | Panier localStorage, validation, DOM |
| **PHP** | Traitement formulaire, sécurisation |
| **MySQL** | Base de données relationnelle |
| **Font Awesome** | Icônes (v6.0.0) |
| **Git** | Versionnement |

## 🚀 Installation

1. **Prérequis** : XAMPP, WAMP ou serveur PHP local

2. **Cloner le projet** :
   ```bash
   git clone https://github.com/Nathan355/projet-momo-nt.git
   ```

3. **Placer dans le dossier web** :
   ```bash
   # Copier dans htdocs (XAMPP) ou www (WAMP)
   ```

4. **Importer la base de données** :
   - Ouvrir phpMyAdmin
   - Importer `export.sql`

5. **Accéder au site** :
   ```
   http://localhost/projet-momo-nt-main/
   ```

## 📱 Captures d'écran

Le site comprend :
- Page d'accueil avec hero section et produits vedettes
- Boutique avec grille de produits et filtres visuels
- Panier dynamique avec calcul automatique
- Formulaire de contact moderne en deux colonnes
- Design cohérent sur toutes les pages

## 👥 Auteurs

- **Nathan** & **Momo** - Développement complet

## 📄 Licence

© 2026 XYZ - Tous droits réservés

## Développement et Contributions

- Commits réguliers sur le dépôt GitHub
- Respect des standards de codage
- Tests fonctionnels avant déploiement

## Auteur

Développé pour l'entreprise XYZ - 2026

## Licence

Tous droits réservés - Entreprise XYZ
