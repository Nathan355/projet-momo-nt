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
            <div class="logo">
                <i class="fas fa-bolt"></i> XYZ
            </div>
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
                <a href="admin.php" class="admin-icon active" title="Admin"><i class="fas fa-cog"></i></a>
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

    <section class="admin-hero">
        <h1><i class="fas fa-shield-alt"></i> PANEL ADMINISTRATION</h1>
        <p>Gerez vos commandes, produits et clients</p>
    </section>

    <section class="admin-dashboard">
        <div class="admin-stats">
            <div class="stat-card">
                <i class="fas fa-shopping-bag"></i>
                <div class="stat-info">
                    <h3 id="stat-commandes">12</h3>
                    <p>Commandes</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-euro-sign"></i>
                <div class="stat-info">
                    <h3 id="stat-revenus">2 847.50</h3>
                    <p>Revenus</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-info">
                    <h3 id="stat-clients">8</h3>
                    <p>Clients</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <div class="stat-info">
                    <h3 id="stat-produits">6</h3>
                    <p>Produits</p>
                </div>
            </div>
        </div>

        <div class="admin-tabs">
            <button class="admin-tab active" data-tab="commandes"><i class="fas fa-receipt"></i> Commandes</button>
            <button class="admin-tab" data-tab="produits"><i class="fas fa-box"></i> Produits</button>
            <button class="admin-tab" data-tab="clients"><i class="fas fa-users"></i> Clients</button>
        </div>

        <div class="admin-content">
            <!-- Onglet Commandes -->
            <div class="admin-panel" id="panel-commandes">
                <div class="panel-header">
                    <h2>Liste des Commandes</h2>
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
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>N° Commande</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Articles</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="commandes-body">
                            <tr>
                                <td><strong>#CMD-001</strong></td>
                                <td>Jean Dupont</td>
                                <td>22/03/2026</td>
                                <td>XYZ EXTREME x2</td>
                                <td class="prix">99.98</td>
                                <td><span class="statut-badge en-cours">En cours</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-002</strong></td>
                                <td>Marie Martin</td>
                                <td>21/03/2026</td>
                                <td>XYZ ENERGY x1, XYZ CREATINE x3</td>
                                <td class="prix">89.96</td>
                                <td><span class="statut-badge en-attente">En attente</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-003</strong></td>
                                <td>Lucas Bernard</td>
                                <td>20/03/2026</td>
                                <td>XYZ PUMP x1</td>
                                <td class="prix">39.99</td>
                                <td><span class="statut-badge expediee">Expediee</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-004</strong></td>
                                <td>Sophie Leclerc</td>
                                <td>19/03/2026</td>
                                <td>XYZ VEGAN x2, XYZ FOCUS x1</td>
                                <td class="prix">124.97</td>
                                <td><span class="statut-badge livree">Livree</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-005</strong></td>
                                <td>Pierre Moreau</td>
                                <td>18/03/2026</td>
                                <td>XYZ EXTREME x1, XYZ ENERGY x2</td>
                                <td class="prix">109.97</td>
                                <td><span class="statut-badge annulee">Annulee</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-006</strong></td>
                                <td>Emma Petit</td>
                                <td>17/03/2026</td>
                                <td>XYZ CREATINE x5</td>
                                <td class="prix">99.95</td>
                                <td><span class="statut-badge en-cours">En cours</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-007</strong></td>
                                <td>Thomas Roux</td>
                                <td>16/03/2026</td>
                                <td>XYZ FOCUS x2</td>
                                <td class="prix">69.98</td>
                                <td><span class="statut-badge livree">Livree</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-008</strong></td>
                                <td>Chloe Durand</td>
                                <td>15/03/2026</td>
                                <td>XYZ PUMP x1, XYZ VEGAN x1</td>
                                <td class="prix">84.98</td>
                                <td><span class="statut-badge en-attente">En attente</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-009</strong></td>
                                <td>Hugo Garnier</td>
                                <td>14/03/2026</td>
                                <td>XYZ EXTREME x3</td>
                                <td class="prix">149.97</td>
                                <td><span class="statut-badge expediee">Expediee</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-010</strong></td>
                                <td>Lea Fontaine</td>
                                <td>13/03/2026</td>
                                <td>XYZ ENERGY x4</td>
                                <td class="prix">119.96</td>
                                <td><span class="statut-badge livree">Livree</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-011</strong></td>
                                <td>Nathan Blanc</td>
                                <td>12/03/2026</td>
                                <td>XYZ CREATINE x2, XYZ PUMP x1</td>
                                <td class="prix">79.97</td>
                                <td><span class="statut-badge en-cours">En cours</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#CMD-012</strong></td>
                                <td>Julie Mercier</td>
                                <td>11/03/2026</td>
                                <td>XYZ VEGAN x1</td>
                                <td class="prix">44.99</td>
                                <td><span class="statut-badge livree">Livree</span></td>
                                <td class="actions-cell">
                                    <button class="btn-action btn-voir" title="Voir"><i class="fas fa-eye"></i></button>
                                    <button class="btn-action btn-edit" title="Modifier statut"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Onglet Produits -->
            <div class="admin-panel hidden" id="panel-produits">
                <div class="panel-header">
                    <h2>Gestion des Produits</h2>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Categorie</th>
                                <th>Stock</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="images/extreme.png" alt="XYZ EXTREME" class="admin-product-img"></td>
                                <td><strong>XYZ EXTREME</strong></td>
                                <td class="prix">49.99</td>
                                <td>Energie</td>
                                <td>156</td>
                                <td><span class="statut-badge en-cours">En stock</span></td>
                            </tr>
                            <tr>
                                <td><img src="images/energy.png" alt="XYZ ENERGY" class="admin-product-img"></td>
                                <td><strong>XYZ ENERGY</strong></td>
                                <td class="prix">29.99</td>
                                <td>Energie</td>
                                <td>243</td>
                                <td><span class="statut-badge en-cours">En stock</span></td>
                            </tr>
                            <tr>
                                <td><img src="images/creatine.png" alt="XYZ CREATINE" class="admin-product-img"></td>
                                <td><strong>XYZ CREATINE</strong></td>
                                <td class="prix">19.99</td>
                                <td>Force</td>
                                <td>89</td>
                                <td><span class="statut-badge en-cours">En stock</span></td>
                            </tr>
                            <tr>
                                <td><img src="images/pump.png" alt="XYZ PUMP" class="admin-product-img"></td>
                                <td><strong>XYZ PUMP</strong></td>
                                <td class="prix">39.99</td>
                                <td>Force</td>
                                <td>12</td>
                                <td><span class="statut-badge en-attente">Stock faible</span></td>
                            </tr>
                            <tr>
                                <td><img src="images/focus.png" alt="XYZ FOCUS" class="admin-product-img"></td>
                                <td><strong>XYZ FOCUS</strong></td>
                                <td class="prix">34.99</td>
                                <td>Nootropique</td>
                                <td>178</td>
                                <td><span class="statut-badge en-cours">En stock</span></td>
                            </tr>
                            <tr>
                                <td><img src="images/vegan.png" alt="XYZ VEGAN" class="admin-product-img"></td>
                                <td><strong>XYZ VEGAN</strong></td>
                                <td class="prix">44.99</td>
                                <td>Vegan</td>
                                <td>67</td>
                                <td><span class="statut-badge en-cours">En stock</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Onglet Clients -->
            <div class="admin-panel hidden" id="panel-clients">
                <div class="panel-header">
                    <h2>Liste des Clients</h2>
                </div>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Commandes</th>
                                <th>Total depense</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
                                <td><strong>Jean Dupont</strong></td>
                                <td>jean.dupont@example.com</td>
                                <td>01 23 45 67 89</td>
                                <td>2</td>
                                <td class="prix">199.96</td>
                            </tr>
                            <tr>
                                <td>#2</td>
                                <td><strong>Marie Martin</strong></td>
                                <td>marie.martin@example.com</td>
                                <td>06 12 34 56 78</td>
                                <td>1</td>
                                <td class="prix">89.96</td>
                            </tr>
                            <tr>
                                <td>#3</td>
                                <td><strong>Lucas Bernard</strong></td>
                                <td>lucas.bernard@example.com</td>
                                <td>07 98 76 54 32</td>
                                <td>1</td>
                                <td class="prix">39.99</td>
                            </tr>
                            <tr>
                                <td>#4</td>
                                <td><strong>Sophie Leclerc</strong></td>
                                <td>sophie.leclerc@example.com</td>
                                <td>06 45 67 89 01</td>
                                <td>3</td>
                                <td class="prix">324.94</td>
                            </tr>
                            <tr>
                                <td>#5</td>
                                <td><strong>Pierre Moreau</strong></td>
                                <td>pierre.moreau@example.com</td>
                                <td>01 98 76 54 32</td>
                                <td>1</td>
                                <td class="prix">109.97</td>
                            </tr>
                            <tr>
                                <td>#6</td>
                                <td><strong>Emma Petit</strong></td>
                                <td>emma.petit@example.com</td>
                                <td>07 11 22 33 44</td>
                                <td>2</td>
                                <td class="prix">189.93</td>
                            </tr>
                            <tr>
                                <td>#7</td>
                                <td><strong>Thomas Roux</strong></td>
                                <td>thomas.roux@example.com</td>
                                <td>06 55 66 77 88</td>
                                <td>1</td>
                                <td class="prix">69.98</td>
                            </tr>
                            <tr>
                                <td>#8</td>
                                <td><strong>Chloe Durand</strong></td>
                                <td>chloe.durand@example.com</td>
                                <td>07 22 33 44 55</td>
                                <td>1</td>
                                <td class="prix">84.98</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal pour modifier le statut -->
    <div class="modal-overlay" id="modal-statut" style="display:none;">
        <div class="modal-content">
            <h3><i class="fas fa-edit"></i> Modifier le statut</h3>
            <p id="modal-commande-id"></p>
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

    <!-- Modal pour voir les details -->
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Onglets
        const tabs = document.querySelectorAll('.admin-tab');
        const panels = document.querySelectorAll('.admin-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                panels.forEach(p => p.classList.add('hidden'));
                tab.classList.add('active');
                document.getElementById('panel-' + tab.dataset.tab).classList.remove('hidden');
            });
        });

        // Filtre par statut
        const filterStatut = document.getElementById('filter-statut');
        filterStatut.addEventListener('change', () => {
            const val = filterStatut.value;
            const rows = document.querySelectorAll('#commandes-body tr');
            rows.forEach(row => {
                const badge = row.querySelector('.statut-badge');
                if (val === 'tous' || badge.classList.contains(val)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Modal modification statut
        let currentEditRow = null;
        const modalStatut = document.getElementById('modal-statut');
        const modalSelect = document.getElementById('modal-select-statut');

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', (e) => {
                currentEditRow = e.target.closest('tr');
                const cmdId = currentEditRow.querySelector('td strong').textContent;
                const currentStatut = currentEditRow.querySelector('.statut-badge').classList[1];
                document.getElementById('modal-commande-id').textContent = 'Commande: ' + cmdId;
                modalSelect.value = currentStatut;
                modalStatut.style.display = 'flex';
            });
        });

        document.getElementById('modal-save').addEventListener('click', () => {
            if (currentEditRow) {
                const newStatut = modalSelect.value;
                const badge = currentEditRow.querySelector('.statut-badge');
                badge.className = 'statut-badge ' + newStatut;
                const labels = {
                    'en-attente': 'En attente',
                    'en-cours': 'En cours',
                    'expediee': 'Expediee',
                    'livree': 'Livree',
                    'annulee': 'Annulee'
                };
                badge.textContent = labels[newStatut];
                modalStatut.style.display = 'none';
                showAdminToast('Statut mis a jour avec succes !');
            }
        });

        document.getElementById('modal-cancel').addEventListener('click', () => {
            modalStatut.style.display = 'none';
        });

        // Modal details
        const modalDetails = document.getElementById('modal-details');
        document.querySelectorAll('.btn-voir').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                const cells = row.querySelectorAll('td');
                const html = `
                    <div class="detail-grid">
                        <div class="detail-item"><strong>N° Commande:</strong> ${cells[0].textContent}</div>
                        <div class="detail-item"><strong>Client:</strong> ${cells[1].textContent}</div>
                        <div class="detail-item"><strong>Date:</strong> ${cells[2].textContent}</div>
                        <div class="detail-item"><strong>Articles:</strong> ${cells[3].textContent}</div>
                        <div class="detail-item"><strong>Total:</strong> ${cells[4].textContent}</div>
                        <div class="detail-item"><strong>Statut:</strong> ${cells[5].textContent}</div>
                    </div>
                `;
                document.getElementById('modal-details-content').innerHTML = html;
                modalDetails.style.display = 'flex';
            });
        });

        document.getElementById('modal-details-close').addEventListener('click', () => {
            modalDetails.style.display = 'none';
        });

        // Fermer modals au clic exterieur
        [modalStatut, modalDetails].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.style.display = 'none';
            });
        });

        function showAdminToast(message) {
            const toast = document.getElementById('toast-notification');
            if (toast) {
                toast.textContent = message;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 3000);
            }
        }

        // Menu burger
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (navToggle && navMenu) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('nav-active');
                navToggle.classList.toggle('is-active');
            });
        }

        // Cart badge
        let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
        const cartBadge = document.querySelector('.cart-count-badge');
        const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
        if (cartBadge) {
            if (totalItems > 0) {
                cartBadge.textContent = totalItems;
                cartBadge.style.display = 'flex';
            } else {
                cartBadge.style.display = 'none';
            }
        }
    });
    </script>
</body>
</html>
