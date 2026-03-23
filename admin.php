<?php
session_start();
require_once 'db.php';

// Verifier si l'utilisateur est admin
$is_admin = false;
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT is_admin FROM utilisateur WHERE id_utilisateur = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    $is_admin = $user && $user['is_admin'] == 1;
}

// Traitement AJAX: mise a jour statut commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $is_admin && isset($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] === 'update_statut') {
        $id = intval($_POST['commande_id']);
        $statut = $_POST['statut'];
        $allowed = ['en-attente', 'en-cours', 'expediee', 'livree', 'annulee'];
        if (in_array($statut, $allowed)) {
            $stmt = $pdo->prepare("UPDATE commande SET statut = ? WHERE id_commande = ?");
            $stmt->execute([$statut, $id]);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Statut invalide']);
        }
        exit;
    }

    if ($_POST['action'] === 'get_details') {
        $id = intval($_POST['commande_id']);
        $stmt = $pdo->prepare("SELECT * FROM commande WHERE id_commande = ?");
        $stmt->execute([$id]);
        $cmd = $stmt->fetch();
        $stmt2 = $pdo->prepare("SELECT * FROM ligne_commande WHERE commande_id = ?");
        $stmt2->execute([$id]);
        $lignes = $stmt2->fetchAll();
        echo json_encode(['success' => true, 'commande' => $cmd, 'lignes' => $lignes]);
        exit;
    }
}

// Si pas admin, afficher page de connexion admin
if (!$is_admin):
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Connexion Admin</title>
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
                    <li><a href="jeux.php">Jeux</a></li>
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
                <a href="admin.php" class="admin-icon active" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <section class="auth-section">
        <div class="auth-container">
            <div class="auth-header">
                <div class="auth-icon"><i class="fas fa-shield-alt"></i></div>
                <h1>Acces Admin</h1>
                <p>Connectez-vous avec un compte administrateur pour acceder au panel.</p>
            </div>
            <?php if (isset($_SESSION['user_id']) && !$is_admin): ?>
                <div class="auth-errors">
                    <p><i class="fas fa-exclamation-circle"></i> Votre compte n'a pas les droits administrateur.</p>
                </div>
            <?php endif; ?>
            <div class="result-actions" style="justify-content: center; margin-top: 1rem;">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login.php?redirect=admin.php" class="cta-button" style="text-decoration:none;"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                <?php endif; ?>
                <a href="index.php" class="cta-button secondary" style="text-decoration:none;">Retour a l'accueil</a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>XYZ</h4><p>Les meilleurs supplements pre-workout</p></div>
            <div class="footer-section"><h4>LIENS RAPIDES</h4><ul><li><a href="boutique.php">Boutique</a></li></ul></div>
            <div class="footer-section"><h4>CONTACT</h4><ul><li><i class="fas fa-envelope"></i> XYZ.Proteine@outlook.fr</li></ul></div>
        </div>
        <div class="footer-bottom"><p>&copy; 2026 XYZ - Tous droits reserves</p></div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
<?php
exit;
endif;

// --- PANEL ADMIN (utilisateur admin connecte) ---

// Recuperer les stats
$nb_commandes = $pdo->query("SELECT COUNT(*) FROM commande")->fetchColumn();
$revenus = $pdo->query("SELECT COALESCE(SUM(total), 0) FROM commande WHERE statut != 'annulee'")->fetchColumn();
$nb_utilisateurs = $pdo->query("SELECT COUNT(*) FROM utilisateur WHERE is_admin = 0")->fetchColumn();
$nb_produits = $pdo->query("SELECT COUNT(*) FROM produit")->fetchColumn();

// Recuperer les commandes
$commandes = $pdo->query("SELECT c.*, GROUP_CONCAT(CONCAT(lc.nom_produit, ' x', lc.quantite) SEPARATOR ', ') as articles FROM commande c LEFT JOIN ligne_commande lc ON c.id_commande = lc.commande_id GROUP BY c.id_commande ORDER BY c.date_commande DESC")->fetchAll();

// Recuperer les produits
$produits = $pdo->query("SELECT p.*, cat.nom as categorie_nom FROM produit p LEFT JOIN categorie cat ON p.categorie_id = cat.id_categorie")->fetchAll();

// Recuperer les utilisateurs avec stats
$utilisateurs = $pdo->query("SELECT u.*, COUNT(c.id_commande) as nb_commandes, COALESCE(SUM(c.total), 0) as total_depense FROM utilisateur u LEFT JOIN commande c ON u.id_utilisateur = c.utilisateur_id WHERE u.is_admin = 0 GROUP BY u.id_utilisateur ORDER BY u.date_inscription DESC")->fetchAll();

$statut_labels = [
    'en-attente' => 'En attente',
    'en-cours' => 'En cours',
    'expediee' => 'Expediee',
    'livree' => 'Livree',
    'annulee' => 'Annulee'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ - Panel Admin</title>
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
                    <li><a href="jeux.php">Jeux</a></li>
                </ul>
            </nav>
            <div class="nav-icons">
                <div class="user-menu">
                    <span class="user-badge"><i class="fas fa-user-shield"></i> <?= htmlspecialchars($_SESSION['user_pseudo']) ?> (Admin)</span>
                    <a href="logout.php" class="logout-link" title="Deconnexion"><i class="fas fa-sign-out-alt"></i></a>
                </div>
                <a href="admin.php" class="admin-icon active" title="Admin"><i class="fas fa-cog"></i></a>
                <a href="panier.php" class="cart-icon"><i class="fas fa-shopping-cart"></i><span class="cart-count-badge">0</span></a>
            </div>
            <button class="nav-toggle" aria-label="Ouvrir le menu"><span class="hamburger"></span></button>
        </div>
    </header>

    <section class="admin-hero">
        <h1><i class="fas fa-shield-alt"></i> PANEL ADMINISTRATION</h1>
        <p>Bienvenue <?= htmlspecialchars($_SESSION['user_pseudo']) ?> - Gerez vos commandes, produits et clients</p>
    </section>

    <section class="admin-dashboard">
        <div class="admin-stats">
            <div class="stat-card">
                <i class="fas fa-shopping-bag"></i>
                <div class="stat-info">
                    <h3><?= $nb_commandes ?></h3>
                    <p>Commandes</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-euro-sign"></i>
                <div class="stat-info">
                    <h3><?= number_format($revenus, 2, ',', ' ') ?></h3>
                    <p>Revenus</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-info">
                    <h3><?= $nb_utilisateurs ?></h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <div class="stat-info">
                    <h3><?= $nb_produits ?></h3>
                    <p>Produits</p>
                </div>
            </div>
        </div>

        <div class="admin-tabs">
            <button class="admin-tab active" data-tab="commandes"><i class="fas fa-receipt"></i> Commandes</button>
            <button class="admin-tab" data-tab="produits"><i class="fas fa-box"></i> Produits</button>
            <button class="admin-tab" data-tab="clients"><i class="fas fa-users"></i> Utilisateurs</button>
        </div>

        <div class="admin-content">
            <!-- Onglet Commandes -->
            <div class="admin-panel" id="panel-commandes">
                <div class="panel-header">
                    <h2>Liste des Commandes (<?= $nb_commandes ?>)</h2>
                    <div class="filter-bar">
                        <select id="filter-statut">
                            <option value="tous">Tous les statuts</option>
                            <option value="en-attente">En attente</option>
                            <option value="en-cours">En cours</option>
                            <option value="expediee">Expediee</option>
                            <option value="livree">Livree</option>
                            <option value="annulee">Annulee</option>
                        </select>
                    </div>
                </div>
                <?php if (empty($commandes)): ?>
                    <div style="text-align:center; padding: 3rem; color: #666;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; color: #ddd;"></i>
                        <p>Aucune commande pour le moment.</p>
                    </div>
                <?php else: ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Articles</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="commandes-body">
                            <?php foreach ($commandes as $cmd): ?>
                            <tr data-id="<?= $cmd['id_commande'] ?>">
                                <td><strong>#CMD-<?= str_pad($cmd['id_commande'], 4, '0', STR_PAD_LEFT) ?></strong></td>
                                <td><?= htmlspecialchars($cmd['prenom_client'] . ' ' . $cmd['nom_client']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($cmd['date_commande'])) ?></td>
                                <td><?= htmlspecialchars($cmd['articles'] ?? 'N/A') ?></td>
                                <td class="prix"><?= number_format($cmd['total'], 2) ?></td>
                                <td><span class="statut-badge <?= $cmd['statut'] ?>"><?= $statut_labels[$cmd['statut']] ?? $cmd['statut'] ?></span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" data-id="<?= $cmd['id_commande'] ?>" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" data-id="<?= $cmd['id_commande'] ?>" data-statut="<?= $cmd['statut'] ?>" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>

            <!-- Onglet Produits -->
            <div class="admin-panel hidden" id="panel-produits">
                <div class="panel-header">
                    <h2>Gestion des Produits (<?= $nb_produits ?>)</h2>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr><th>Image</th><th>Nom</th><th>Prix</th><th>Categorie</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produits as $prod): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($prod['image_url'] ?? '') ?>" alt="<?= htmlspecialchars($prod['nom']) ?>" class="admin-product-img"></td>
                                <td><strong><?= htmlspecialchars($prod['nom']) ?></strong><br><small style="color:#666;"><?= htmlspecialchars($prod['description'] ?? '') ?></small></td>
                                <td class="prix"><?= number_format($prod['prix'], 2) ?></td>
                                <td><?= htmlspecialchars($prod['categorie_nom'] ?? 'N/A') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Onglet Utilisateurs -->
            <div class="admin-panel hidden" id="panel-clients">
                <div class="panel-header">
                    <h2>Utilisateurs inscrits (<?= $nb_utilisateurs ?>)</h2>
                </div>
                <?php if (empty($utilisateurs)): ?>
                    <div style="text-align:center; padding: 3rem; color: #666;">
                        <p>Aucun utilisateur inscrit.</p>
                    </div>
                <?php else: ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr><th>ID</th><th>Pseudo</th><th>Email</th><th>Inscription</th><th>Commandes</th><th>Total depense</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($utilisateurs as $u): ?>
                            <tr>
                                <td>#<?= $u['id_utilisateur'] ?></td>
                                <td><strong><?= htmlspecialchars($u['pseudo']) ?></strong></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= date('d/m/Y', strtotime($u['date_inscription'])) ?></td>
                                <td><?= $u['nb_commandes'] ?></td>
                                <td class="prix"><?= number_format($u['total_depense'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Modal modifier statut -->
    <div class="modal-overlay" id="modal-statut" style="display:none;">
        <div class="modal-content">
            <h3><i class="fas fa-edit"></i> Modifier le statut</h3>
            <p id="modal-commande-id"></p>
            <input type="hidden" id="modal-cmd-id">
            <select id="modal-select-statut">
                <option value="en-attente">En attente</option>
                <option value="en-cours">En cours</option>
                <option value="expediee">Expediee</option>
                <option value="livree">Livree</option>
                <option value="annulee">Annulee</option>
            </select>
            <div class="modal-actions">
                <button class="cta-button" id="modal-save">Sauvegarder</button>
                <button class="cta-button secondary" id="modal-cancel">Annuler</button>
            </div>
        </div>
    </div>

    <!-- Modal details commande -->
    <div class="modal-overlay" id="modal-details" style="display:none;">
        <div class="modal-content">
            <h3><i class="fas fa-info-circle"></i> Details de la commande</h3>
            <div id="modal-details-content"></div>
            <div class="modal-actions">
                <button class="cta-button secondary" id="modal-details-close">Fermer</button>
            </div>
        </div>
    </div>

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
    document.addEventListener('DOMContentLoaded', function() {
        // Onglets
        document.querySelectorAll('.admin-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.admin-panel').forEach(p => p.classList.add('hidden'));
                tab.classList.add('active');
                document.getElementById('panel-' + tab.dataset.tab).classList.remove('hidden');
            });
        });

        // Filtre statut
        const filterStatut = document.getElementById('filter-statut');
        if (filterStatut) {
            filterStatut.addEventListener('change', () => {
                const val = filterStatut.value;
                document.querySelectorAll('#commandes-body tr').forEach(row => {
                    const badge = row.querySelector('.statut-badge');
                    row.style.display = (val === 'tous' || badge.classList.contains(val)) ? '' : 'none';
                });
            });
        }

        // Modal modifier statut (AJAX)
        const modalStatut = document.getElementById('modal-statut');
        const modalSelect = document.getElementById('modal-select-statut');
        const labels = {'en-attente':'En attente','en-cours':'En cours','expediee':'Expediee','livree':'Livree','annulee':'Annulee'};

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const statut = btn.dataset.statut;
                document.getElementById('modal-cmd-id').value = id;
                document.getElementById('modal-commande-id').textContent = 'Commande #CMD-' + id.padStart(4, '0');
                modalSelect.value = statut;
                modalStatut.style.display = 'flex';
            });
        });

        document.getElementById('modal-save').addEventListener('click', () => {
            const id = document.getElementById('modal-cmd-id').value;
            const newStatut = modalSelect.value;

            fetch('admin.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'action=update_statut&commande_id=' + id + '&statut=' + newStatut
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    // Mettre a jour l'affichage
                    const row = document.querySelector('tr[data-id="' + id + '"]');
                    if (row) {
                        const badge = row.querySelector('.statut-badge');
                        badge.className = 'statut-badge ' + newStatut;
                        badge.textContent = labels[newStatut];
                        row.querySelector('.btn-edit').dataset.statut = newStatut;
                    }
                    modalStatut.style.display = 'none';
                    showToast('Statut mis a jour !');
                }
            });
        });

        document.getElementById('modal-cancel').addEventListener('click', () => modalStatut.style.display = 'none');

        // Modal details (AJAX)
        const modalDetails = document.getElementById('modal-details');
        document.querySelectorAll('.btn-voir').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                fetch('admin.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: 'action=get_details&commande_id=' + id
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const c = data.commande;
                        let html = '<div class="detail-grid">';
                        html += '<div class="detail-item"><strong>N°:</strong> #CMD-' + String(c.id_commande).padStart(4, '0') + '</div>';
                        html += '<div class="detail-item"><strong>Client:</strong> ' + c.prenom_client + ' ' + c.nom_client + '</div>';
                        html += '<div class="detail-item"><strong>Email:</strong> ' + c.email_client + '</div>';
                        html += '<div class="detail-item"><strong>Tel:</strong> ' + (c.telephone_client || 'N/A') + '</div>';
                        html += '<div class="detail-item"><strong>Adresse:</strong> ' + c.adresse_client + ', ' + c.code_postal_client + ' ' + c.ville_client + '</div>';
                        html += '<div class="detail-item"><strong>Statut:</strong> <span class="statut-badge ' + c.statut + '">' + (labels[c.statut] || c.statut) + '</span></div>';
                        html += '<div class="detail-item"><strong>Articles:</strong></div>';
                        data.lignes.forEach(l => {
                            html += '<div class="detail-item" style="padding-left:1rem;">- ' + l.nom_produit + ' x' + l.quantite + ' (' + parseFloat(l.prix_unitaire).toFixed(2) + ' &euro;/u)</div>';
                        });
                        html += '<div class="detail-item"><strong>Livraison:</strong> ' + (parseFloat(c.frais_livraison) === 0 ? 'GRATUITE' : parseFloat(c.frais_livraison).toFixed(2) + ' &euro;') + '</div>';
                        html += '<div class="detail-item"><strong>Total:</strong> <span style="color:var(--primary); font-weight:900; font-size:1.2rem;">' + parseFloat(c.total).toFixed(2) + ' &euro;</span></div>';
                        html += '</div>';
                        document.getElementById('modal-details-content').innerHTML = html;
                        modalDetails.style.display = 'flex';
                    }
                });
            });
        });

        document.getElementById('modal-details-close').addEventListener('click', () => modalDetails.style.display = 'none');

        // Fermer modals au clic exterieur
        [modalStatut, modalDetails].forEach(modal => {
            modal.addEventListener('click', (e) => { if (e.target === modal) modal.style.display = 'none'; });
        });

        function showToast(msg) {
            const t = document.getElementById('toast-notification');
            if (t) { t.textContent = msg; t.classList.add('show'); setTimeout(() => t.classList.remove('show'), 3000); }
        }

        // Menu burger
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => { navMenu.classList.toggle('nav-active'); navToggle.classList.toggle('is-active'); });
        }
    });
    </script>
</body>
</html>
