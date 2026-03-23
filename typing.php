<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Speed Typing</title>
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

    <section class="game-page-hero">
        <a href="jeux.php" class="back-link"><i class="fas fa-arrow-left"></i> Retour aux jeux</a>
        <h1><i class="fas fa-keyboard"></i> SPEED TYPING</h1>
        <p>Tapez les mots le plus rapidement possible en 60 secondes !</p>
    </section>

    <section class="game-container">
        <div class="typing-wrapper">
            <div class="typing-stats">
                <div class="typing-stat-box">
                    <span class="typing-stat-value" id="typing-time">60</span>
                    <span class="typing-stat-label">Secondes</span>
                </div>
                <div class="typing-stat-box">
                    <span class="typing-stat-value" id="typing-score">0</span>
                    <span class="typing-stat-label">Mots</span>
                </div>
                <div class="typing-stat-box">
                    <span class="typing-stat-value" id="typing-wpm">0</span>
                    <span class="typing-stat-label">MPM</span>
                </div>
            </div>

            <div class="typing-word-display" id="typing-word"></div>

            <input type="text" id="typing-input" class="typing-input" placeholder="Cliquez ici et commencez a taper..." autocomplete="off" autofocus>

            <div class="typing-progress">
                <div class="typing-progress-bar" id="typing-progress-bar"></div>
            </div>

            <div class="typing-start-overlay" id="typing-overlay">
                <button class="cta-button" id="typing-start-btn"><i class="fas fa-play"></i> Commencer</button>
            </div>
        </div>

        <div class="typing-result hidden" id="typing-result">
            <div class="result-icon"><i class="fas fa-keyboard" style="font-size: 4rem; color: var(--primary);"></i></div>
            <h2>Temps ecoule !</h2>
            <div class="typing-result-stats">
                <div class="typing-result-stat">
                    <span class="big-score" id="result-words">0</span>
                    <span>mots tapes</span>
                </div>
                <div class="typing-result-stat">
                    <span class="big-score" id="result-wpm">0</span>
                    <span>mots/min</span>
                </div>
            </div>
            <p id="result-message"></p>
            <div class="result-actions">
                <button class="cta-button" onclick="initTyping()"><i class="fas fa-redo"></i> Rejouer</button>
                <a href="jeux.php" class="cta-button secondary">Autres jeux</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>XYZ</h4><p>Les meilleurs supplements pre-workout pour vos performances</p></div>
            <div class="footer-section"><h4>LIENS RAPIDES</h4><ul><li><a href="boutique.php">Boutique</a></li><li><a href="presentation.php">A Propos</a></li><li><a href="mentions.php">Mentions legales</a></li></ul></div>
            <div class="footer-section"><h4>CONTACT</h4><ul><li><a href="contact.php">Nous Contacter</a></li><li><i class="fas fa-phone"></i> 01 23 45 67 89</li><li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li></ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2026 XYZ - Tous droits reserves</p></div>
    </footer>

    <div id="toast-notification" class="toast-notification"></div>

    <script>
    const words = [
        'proteine', 'creatine', 'energie', 'musculation', 'fitness',
        'endurance', 'performance', 'supplement', 'entrainement', 'force',
        'cardio', 'nutrition', 'vitamine', 'sante', 'objectif',
        'resultat', 'motivation', 'discipline', 'puissance', 'recuperation',
        'hydratation', 'calories', 'metabolisme', 'exercice', 'repetition',
        'serie', 'squat', 'pompe', 'gainage', 'etirement',
        'biceps', 'triceps', 'abdominaux', 'dorsaux', 'pectoraux',
        'haltere', 'barre', 'tapis', 'velo', 'course',
        'sprint', 'marathon', 'souplesse', 'agilite', 'equilibre',
        'champion', 'victoire', 'progres', 'defi', 'record'
    ];

    let currentWord = '';
    let wordsTyped = 0;
    let timeLeft = 60;
    let timerStarted = false;
    let timerInterval;

    function getRandomWord() {
        return words[Math.floor(Math.random() * words.length)];
    }

    function showWord() {
        currentWord = getRandomWord();
        document.getElementById('typing-word').textContent = currentWord;
    }

    function initTyping() {
        wordsTyped = 0;
        timeLeft = 60;
        timerStarted = false;
        clearInterval(timerInterval);
        document.getElementById('typing-score').textContent = 0;
        document.getElementById('typing-time').textContent = 60;
        document.getElementById('typing-wpm').textContent = 0;
        document.getElementById('typing-input').value = '';
        document.getElementById('typing-input').disabled = false;
        document.getElementById('typing-progress-bar').style.width = '100%';
        document.getElementById('typing-result').classList.add('hidden');
        document.getElementById('typing-overlay').style.display = 'flex';
        showWord();
    }

    document.getElementById('typing-start-btn').addEventListener('click', () => {
        document.getElementById('typing-overlay').style.display = 'none';
        document.getElementById('typing-input').focus();
    });

    document.getElementById('typing-input').addEventListener('input', function() {
        if (!timerStarted) {
            timerStarted = true;
            timerInterval = setInterval(() => {
                timeLeft--;
                document.getElementById('typing-time').textContent = timeLeft;
                document.getElementById('typing-progress-bar').style.width = (timeLeft / 60 * 100) + '%';

                const elapsed = 60 - timeLeft;
                if (elapsed > 0) {
                    document.getElementById('typing-wpm').textContent = Math.round(wordsTyped / elapsed * 60);
                }

                if (timeLeft <= 0) {
                    endGame();
                }

                if (timeLeft <= 10) {
                    document.getElementById('typing-time').style.color = '#d9042f';
                }
            }, 1000);
        }

        const typed = this.value.trim();
        if (typed === currentWord) {
            wordsTyped++;
            document.getElementById('typing-score').textContent = wordsTyped;
            this.value = '';
            showWord();

            // Flash vert
            this.style.borderColor = '#4CAF50';
            setTimeout(() => this.style.borderColor = '', 200);
        }
    });

    function endGame() {
        clearInterval(timerInterval);
        document.getElementById('typing-input').disabled = true;
        const wpm = wordsTyped;
        document.getElementById('result-words').textContent = wordsTyped;
        document.getElementById('result-wpm').textContent = wpm;

        let message;
        if (wpm >= 40) message = 'Incroyable ! Vous etes une machine a ecrire !';
        else if (wpm >= 25) message = 'Tres bien ! Vous avez des doigts rapides !';
        else if (wpm >= 15) message = 'Pas mal ! Continuez a vous entrainer !';
        else message = 'C\'est un debut ! La pratique rend parfait !';

        document.getElementById('result-message').textContent = message;
        document.getElementById('typing-result').classList.remove('hidden');
    }

    initTyping();

    // Menu burger + cart badge
    document.addEventListener('DOMContentLoaded', function() {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('nav-active');
                navToggle.classList.toggle('is-active');
            });
        }
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const cartBadge = document.querySelector('.cart-count-badge');
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (cartBadge && totalItems > 0) { cartBadge.textContent = totalItems; cartBadge.style.display = 'flex'; }
    });
    </script>
</body>
</html>
