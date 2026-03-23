<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Quiz Fitness</title>
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
        <h1><i class="fas fa-question-circle"></i> QUIZ FITNESS</h1>
        <p>Testez vos connaissances en nutrition et fitness !</p>
    </section>

    <section class="game-container">
        <div class="quiz-wrapper" id="quiz-wrapper">
            <div class="quiz-progress">
                <div class="quiz-progress-bar" id="quiz-progress-bar"></div>
            </div>
            <div class="quiz-score-bar">
                <span>Question <strong id="quiz-current">1</strong>/10</span>
                <span>Score: <strong id="quiz-score">0</strong></span>
            </div>
            <div id="quiz-question" class="quiz-question"></div>
            <div id="quiz-options" class="quiz-options"></div>
            <button id="quiz-next" class="cta-button" style="display:none;">Question suivante <i class="fas fa-arrow-right"></i></button>
        </div>

        <div class="quiz-result hidden" id="quiz-result">
            <div class="result-icon" id="result-icon"></div>
            <h2 id="result-title"></h2>
            <p id="result-text"></p>
            <div class="result-score" id="result-score"></div>
            <div class="result-actions">
                <button class="cta-button" onclick="startQuiz()"><i class="fas fa-redo"></i> Rejouer</button>
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
    const questions = [
        { q: "Combien de calories contient 1g de proteines ?", options: ["4 kcal", "7 kcal", "9 kcal", "2 kcal"], correct: 0 },
        { q: "Quel supplement est le plus etudie scientifiquement ?", options: ["BCAA", "Creatine", "Glutamine", "Carnitine"], correct: 1 },
        { q: "Combien de litres d'eau faut-il boire par jour en moyenne ?", options: ["0.5L", "1L", "1.5 a 2L", "4L"], correct: 2 },
        { q: "Quel macronutriment fournit le plus de calories par gramme ?", options: ["Proteines", "Glucides", "Lipides", "Fibres"], correct: 2 },
        { q: "La cafeine est un...", options: ["Depresseur", "Stimulant", "Hallucinogene", "Sedatif"], correct: 1 },
        { q: "Combien de groupes musculaires principaux le corps humain compte-t-il ?", options: ["4", "6", "8", "11"], correct: 3 },
        { q: "Quel est le muscle le plus grand du corps humain ?", options: ["Biceps", "Grand dorsal", "Grand fessier", "Quadriceps"], correct: 2 },
        { q: "La beta-alanine aide principalement pour...", options: ["La force", "L'endurance", "La souplesse", "Le sommeil"], correct: 1 },
        { q: "Combien de temps de repos entre les series pour la force ?", options: ["15 sec", "30 sec", "1 min", "3-5 min"], correct: 3 },
        { q: "Le pre-workout se prend idealement combien de temps avant l'entrainement ?", options: ["5 min", "20-30 min", "2 heures", "La veille"], correct: 1 }
    ];

    let currentQuestion = 0;
    let score = 0;
    let answered = false;

    function startQuiz() {
        currentQuestion = 0;
        score = 0;
        answered = false;
        document.getElementById('quiz-wrapper').classList.remove('hidden');
        document.getElementById('quiz-result').classList.add('hidden');
        showQuestion();
    }

    function showQuestion() {
        answered = false;
        const q = questions[currentQuestion];
        document.getElementById('quiz-current').textContent = currentQuestion + 1;
        document.getElementById('quiz-score').textContent = score;
        document.getElementById('quiz-progress-bar').style.width = ((currentQuestion) / questions.length * 100) + '%';
        document.getElementById('quiz-question').textContent = q.q;
        document.getElementById('quiz-next').style.display = 'none';

        const optionsDiv = document.getElementById('quiz-options');
        optionsDiv.innerHTML = '';
        q.options.forEach((opt, i) => {
            const btn = document.createElement('button');
            btn.className = 'quiz-option';
            btn.textContent = opt;
            btn.addEventListener('click', () => selectAnswer(i, btn));
            optionsDiv.appendChild(btn);
        });
    }

    function selectAnswer(index, btn) {
        if (answered) return;
        answered = true;
        const q = questions[currentQuestion];
        const allBtns = document.querySelectorAll('.quiz-option');

        allBtns.forEach((b, i) => {
            if (i === q.correct) b.classList.add('correct');
            if (i === index && index !== q.correct) b.classList.add('wrong');
            b.style.pointerEvents = 'none';
        });

        if (index === q.correct) score++;
        document.getElementById('quiz-score').textContent = score;

        if (currentQuestion < questions.length - 1) {
            document.getElementById('quiz-next').style.display = 'inline-block';
        } else {
            setTimeout(showResult, 1000);
        }
    }

    document.getElementById('quiz-next').addEventListener('click', () => {
        currentQuestion++;
        showQuestion();
    });

    function showResult() {
        document.getElementById('quiz-wrapper').classList.add('hidden');
        document.getElementById('quiz-result').classList.remove('hidden');
        document.getElementById('quiz-progress-bar').style.width = '100%';

        const pct = (score / questions.length) * 100;
        let icon, title, text;

        if (pct >= 80) {
            icon = '<i class="fas fa-trophy" style="color: gold; font-size: 4rem;"></i>';
            title = 'Excellent !';
            text = 'Vous etes un vrai expert du fitness !';
        } else if (pct >= 50) {
            icon = '<i class="fas fa-medal" style="color: silver; font-size: 4rem;"></i>';
            title = 'Bien joue !';
            text = 'De bonnes connaissances, continuez comme ca !';
        } else {
            icon = '<i class="fas fa-dumbbell" style="color: var(--primary); font-size: 4rem;"></i>';
            title = 'Continuez a apprendre !';
            text = 'Le fitness n\'a plus de secrets si vous continuez !';
        }

        document.getElementById('result-icon').innerHTML = icon;
        document.getElementById('result-title').textContent = title;
        document.getElementById('result-text').textContent = text;
        document.getElementById('result-score').innerHTML = '<span class="big-score">' + score + '/' + questions.length + '</span>';
    }

    startQuiz();

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
