<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Mini-Jeux</title>
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
                    <li><a href="presentation.php">A Propos</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="jeux.php" class="active">Jeux</a></li>
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

    <div class="promo-marquee">
        <div class="promo-marquee-content">
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
            <span><i class="fas fa-fire"></i> CODE PROMO : <strong>XYZ15</strong> = -15% sur le produit de votre choix !</span>
            <span><i class="fas fa-gamepad"></i> Jouez a nos mini-jeux et tentez de gagner une PS5 chaque mois !</span>
            <span><i class="fas fa-gift"></i> Roue de la Chance : des produits XYZ a gagner !</span>
            <span><i class="fas fa-truck"></i> Livraison GRATUITE des 50 d'achat !</span>
        </div>
    </div>

    <section class="games-hero">
        <h1><i class="fas fa-gamepad"></i> ESPACE JEUX</h1>
        <p>Detendez-vous entre deux seances avec nos mini-jeux !</p>
    </section>

    <section class="games-grid-section">
        <div class="games-grid">
            <a href="quiz.php" class="game-card">
                <div class="game-icon"><i class="fas fa-question-circle"></i></div>
                <h3>Quiz Fitness</h3>
                <p>Testez vos connaissances en nutrition et fitness !</p>
                <span class="game-badge">10 questions</span>
            </a>
            <a href="snake.php" class="game-card">
                <div class="game-icon"><i class="fas fa-dragon"></i></div>
                <h3>Snake Game</h3>
                <p>Le classique du jeu video, version XYZ !</p>
                <span class="game-badge">Arcade</span>
            </a>
            <a href="memory-game.php" class="game-card">
                <div class="game-icon"><i class="fas fa-brain"></i></div>
                <h3>Memory Card</h3>
                <p>Retrouvez les paires de produits XYZ !</p>
                <span class="game-badge">8 paires</span>
            </a>
            <a href="typing.php" class="game-card">
                <div class="game-icon"><i class="fas fa-keyboard"></i></div>
                <h3>Speed Typing</h3>
                <p>Tapez le plus vite possible pour battre le chrono !</p>
                <span class="game-badge">60 secondes</span>
            </a>
            <a href="wheel.php" class="game-card">
                <div class="game-icon"><i class="fas fa-circle-notch"></i></div>
                <h3>Roue de la Chance</h3>
                <p>Tentez de gagner des reductions exclusives !</p>
                <span class="game-badge">Bonus</span>
            </a>
        </div>
    </section>

    <!-- Section Recompenses Mensuelles -->
    <section class="rewards-section">
        <div class="rewards-container">
            <div class="rewards-header">
                <h2><i class="fas fa-trophy"></i> RECOMPENSES DU MOIS</h2>
                <p>Les meilleurs joueurs de chaque mois remportent des lots incroyables !</p>
            </div>
            <div class="rewards-grid">
                <div class="reward-card gold">
                    <div class="reward-rank">1er</div>
                    <div class="reward-icon"><i class="fas fa-gamepad"></i></div>
                    <h3>PlayStation 5</h3>
                    <p>Le meilleur joueur du mois gagne une PS5 !</p>
                    <span class="reward-value">Valeur : 549</span>
                </div>
                <div class="reward-card silver">
                    <div class="reward-rank">2eme</div>
                    <div class="reward-icon"><i class="fas fa-headphones-alt"></i></div>
                    <h3>Casque Gaming</h3>
                    <p>Un casque gaming sans fil premium !</p>
                    <span class="reward-value">Valeur : 149</span>
                </div>
                <div class="reward-card bronze">
                    <div class="reward-rank">3eme</div>
                    <div class="reward-icon"><i class="fas fa-box-open"></i></div>
                    <h3>Pack XYZ Complet</h3>
                    <p>Les 6 produits XYZ + un shaker offert !</p>
                    <span class="reward-value">Valeur : 250</span>
                </div>
            </div>
            <div class="rewards-rules">
                <h3><i class="fas fa-info-circle"></i> Comment participer ?</h3>
                <div class="rules-list">
                    <div class="rule-item"><span class="rule-number">1</span> Jouez a n'importe quel mini-jeu (Quiz, Snake, Memory, Speed Typing)</div>
                    <div class="rule-item"><span class="rule-number">2</span> Vos meilleurs scores sont enregistres automatiquement</div>
                    <div class="rule-item"><span class="rule-number">3</span> A la fin du mois, les 3 meilleurs joueurs sont recompenses</div>
                    <div class="rule-item"><span class="rule-number">4</span> Les gagnants sont contactes par email</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaderboard -->
    <section class="leaderboard-section">
        <div class="leaderboard-container">
            <h2><i class="fas fa-medal"></i> CLASSEMENT DU MOIS - MARS 2026</h2>
            <div class="leaderboard-tabs">
                <button class="lb-tab active" data-game="global"><i class="fas fa-globe"></i> Global</button>
                <button class="lb-tab" data-game="quiz"><i class="fas fa-question-circle"></i> Quiz</button>
                <button class="lb-tab" data-game="snake"><i class="fas fa-dragon"></i> Snake</button>
                <button class="lb-tab" data-game="memory"><i class="fas fa-brain"></i> Memory</button>
                <button class="lb-tab" data-game="typing"><i class="fas fa-keyboard"></i> Typing</button>
            </div>
            <div class="leaderboard-table">
                <div class="lb-header">
                    <span>Rang</span>
                    <span>Joueur</span>
                    <span>Score</span>
                    <span>Jeu</span>
                </div>
                <div class="lb-row gold-row">
                    <span class="lb-rank"><i class="fas fa-crown" style="color: gold;"></i> 1</span>
                    <span class="lb-player"><strong>DarkFitness_92</strong></span>
                    <span class="lb-score">9 850 pts</span>
                    <span class="lb-game">Snake</span>
                </div>
                <div class="lb-row silver-row">
                    <span class="lb-rank"><i class="fas fa-medal" style="color: silver;"></i> 2</span>
                    <span class="lb-player"><strong>MuscleMarie</strong></span>
                    <span class="lb-score">8 720 pts</span>
                    <span class="lb-game">Typing</span>
                </div>
                <div class="lb-row bronze-row">
                    <span class="lb-rank"><i class="fas fa-medal" style="color: #cd7f32;"></i> 3</span>
                    <span class="lb-player"><strong>ProGamer_Lucas</strong></span>
                    <span class="lb-score">7 950 pts</span>
                    <span class="lb-game">Quiz</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">4</span>
                    <span class="lb-player">FitEmma</span>
                    <span class="lb-score">7 200 pts</span>
                    <span class="lb-game">Memory</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">5</span>
                    <span class="lb-player">XYZ_Thomas</span>
                    <span class="lb-score">6 880 pts</span>
                    <span class="lb-game">Snake</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">6</span>
                    <span class="lb-player">ProteinQueen</span>
                    <span class="lb-score">6 450 pts</span>
                    <span class="lb-game">Quiz</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">7</span>
                    <span class="lb-player">HugoPower</span>
                    <span class="lb-score">5 920 pts</span>
                    <span class="lb-game">Typing</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">8</span>
                    <span class="lb-player">ChloeGymLife</span>
                    <span class="lb-score">5 340 pts</span>
                    <span class="lb-game">Memory</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">9</span>
                    <span class="lb-player">NathanBeast</span>
                    <span class="lb-score">4 890 pts</span>
                    <span class="lb-game">Snake</span>
                </div>
                <div class="lb-row">
                    <span class="lb-rank">10</span>
                    <span class="lb-player">JulieFit</span>
                    <span class="lb-score">4 560 pts</span>
                    <span class="lb-game">Quiz</span>
                </div>
            </div>
            <p class="lb-info"><i class="fas fa-clock"></i> Classement mis a jour en temps reel - Fin du concours : 31 mars 2026</p>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>XYZ</h4>
                <p>Les meilleurs supplements pre-workout pour vos performances</p>
            </div>
            <div class="footer-section">
                <h4>LIENS RAPIDES</h4>
                <ul>
                    <li><a href="boutique.php">Boutique</a></li>
                    <li><a href="presentation.php">A Propos</a></li>
                    <li><a href="mentions.php">Mentions legales</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>CONTACT</h4>
                <ul>
                    <li><a href="contact.php">Nous Contacter</a></li>
                    <li><i class="fas fa-phone"></i> 01 23 45 67 89</li>
                    <li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 XYZ - Tous droits reserves | Livraison gratuite a partir de 50</p>
        </div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>
    <script src="js/script.js"></script>
</body>
</html>
