
<?php
require_once "comptes/Compt.php";
require_once "comptes/ComptPayant.php";
require_once "comptes/ComptEpargne.php";
session_start();



// Initialisation des comptes
if (!isset($_SESSION['comptes'])) {
    $_SESSION['comptes'] = [
        1 => new Compt(2500),
        2 => new ComptEpargne(5000),
        3 => new ComptPayant(3500)
    ];
}

$comptes = $_SESSION['comptes'];

$C1 = $comptes[1];
$C2 = $comptes[2];
$C3 = $comptes[3];

$message = "";
$erreur = "";

// Dépôt
if (isset($_POST['depot'])) {

    $code = (int) $_POST['compte'];
    $montant = (float) $_POST['montant'];

    if ($montant > 0 && isset($comptes[$code])) {

        $comptes[$code]->deposer($montant);
        $message = "Dépôt effectué avec succès.";

    } else {
        $erreur = "Montant invalide.";
    }
}

// Retrait
if (isset($_POST['retrait'])) {

    $code = (int) $_POST['compte'];
    $montant = (float) $_POST['montant'];

    if (isset($comptes[$code]) && $montant > 0) {

        $frais = ($code == 3) ? 5 : 0;

        if ($montant + $frais <= $comptes[$code]->getSold()) {

            $resultat = $comptes[$code]->retirer($montant);

            if ($resultat !== false) {
                $message = "Retrait effectué avec succès.";
            } else {
                $erreur = "Retrait impossible.";
            }

        } else {
            $erreur = "Solde insuffisant pour effectuer cette opération.";
        }

    } else {
        $erreur = "Montant invalide.";
    }
}

// Calcul des intérêts
if (isset($_POST['calcul'])) {

    $comptes[2]->calcul();

    $message = "Les intérêts ont été calculés avec succès.";
}

// Sauvegarde des comptes dans la session
$_SESSION['comptes'] = $comptes;

$C1 = $comptes[1];
$C2 = $comptes[2];
$C3 = $comptes[3];

// Calcul du solde total
$total = 0;

foreach ($comptes as $compte) {
    $total += $compte->getSold();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BankFlow Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

    <div class="brand">
        <div class="brand-icon">B</div>
        <span>BankFlow</span>
    </div>

    <p class="menu-title">MENU PRINCIPAL</p>

    <a href="#dashboard" class="menu-item active">
        <span>⌂</span> Dashboard
    </a>

    <a href="#accounts" class="menu-item">
        <span>▣</span> Mes comptes
    </a>

    <a href="#operations" class="menu-item">
        <span>↔</span> Opérations
    </a>

    <a href="#calcul" class="menu-item">
        <span>∑</span> Intérêts
    </a>

    <div class="sidebar-bottom">

        <div class="profile">
            <div class="avatar">MB</div>

            <div>
                <strong>Mouad Berchami</strong>
                <small>Administrateur</small>
            </div>
        </div>

    </div>

</div>


<!-- MAIN CONTENT -->

<div class="main-content" id="dashboard">

    <!-- TOPBAR -->

    <div class="topbar">

        <div>
            <h5>Dashboard</h5>
            <p>Bienvenue dans votre espace bancaire</p>
        </div>

        <div class="top-right">

            <div class="date">
                📅 <?= date("d/m/Y") ?>
            </div>

        </div>

    </div>


    <!-- MESSAGE -->

    <?php if ($message != "") { ?>

        <div class="alert alert-success">
            <?= $message ?>
        </div>

    <?php } ?>

    <?php if ($erreur != "") { ?>

        <div class="alert alert-danger">
            <?= $erreur ?>
        </div>

    <?php } ?>


    <!-- WELCOME -->

    <div class="welcome">

        <div>
            <h2>Bienvenue sur BankFlow 👋</h2>

            <p>
                Gérez vos comptes bancaires simplement et rapidement.
            </p>
        </div>

        <div class="welcome-icon">
            💳
        </div>

    </div>


    <!-- STATISTICS -->

    <div class="stats">

        <div class="stat-card">

            <div class="stat-top">
                <span>Solde total</span>
                <div class="stat-icon blue">💰</div>
            </div>

            <h2><?= number_format($total, 2) ?> DH</h2>

            <small>Sur tous vos comptes</small>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span>Nombre de comptes</span>
                <div class="stat-icon purple">🏦</div>
            </div>

            <h2><?= count($comptes) ?></h2>

            <small>Comptes bancaires actifs</small>

        </div>


        <div class="stat-card">

            <div class="stat-top">
                <span>Compte épargne</span>
                <div class="stat-icon green">📈</div>
            </div>

            <h2><?= number_format($C2->getSold(), 2) ?> DH</h2>

            <small>Taux d'intérêt : 6%</small>

        </div>

    </div>


    <!-- ACCOUNTS -->

    <div class="section" id="accounts">

        <div class="section-header">

            <div>
                <h3>Mes comptes</h3>
                <p>Consultez vos comptes bancaires</p>
            </div>

        </div>


        <div class="account-grid">


            <!-- COMPTE 1 -->

            <div class="account-card card-blue">

                <div class="account-header">
                    <span>COMPTE COURANT</span>
                    <span>•••• 0001</span>
                </div>

                <div class="account-number">
                    Compte #<?= $C1->getCode() ?>
                </div>

                <div class="account-balance">
                    <?= number_format($C1->getSold(), 2) ?> DH
                </div>

                <div class="account-footer">
                    <span>Compte classique</span>
                    <span>Actif</span>
                </div>

            </div>


            <!-- COMPTE 2 -->

            <div class="account-card card-purple">

                <div class="account-header">
                    <span>COMPTE ÉPARGNE</span>
                    <span>•••• 0002</span>
                </div>

                <div class="account-number">
                    Compte #<?= $C2->getCode() ?>
                </div>

                <div class="account-balance">
                    <?= number_format($C2->getSold(), 2) ?> DH
                </div>

                <div class="account-footer">
                    <span>Intérêt : 6%</span>
                    <span>Actif</span>
                </div>

            </div>


            <!-- COMPTE 3 -->

            <div class="account-card card-dark">

                <div class="account-header">
                    <span>COMPTE PAYANT</span>
                    <span>•••• 0003</span>
                </div>

                <div class="account-number">
                    Compte #<?= $C3->getCode() ?>
                </div>

                <div class="account-balance">
                    <?= number_format($C3->getSold(), 2) ?> DH
                </div>

                <div class="account-footer">
                    <span>Frais : 5 DH</span>
                    <span>Actif</span>
                </div>

            </div>

        </div>

    </div>


    <!-- OPERATIONS -->

    <div class="section" id="operations">

        <div class="section-header">

            <div>
                <h3>Opérations bancaires</h3>
                <p>Effectuez vos opérations</p>
            </div>

        </div>


        <div class="operation-grid">


            <!-- DEPOT -->

            <div class="operation-card">

                <div class="operation-icon deposit">
                    ↓
                </div>

                <h5>Dépôt</h5>

                <p>
                    Ajouter de l'argent à votre compte bancaire.
                </p>

                <form method="POST">

                    <select name="compte" class="form-select mb-2" required>

                        <option value="1">Compte classique</option>
                        <option value="2">Compte épargne</option>
                        <option value="3">Compte payant</option>

                    </select>

                    <input
                        type="number"
                        name="montant"
                        class="form-control mb-2"
                        placeholder="Montant en DH"
                        min="1"
                        step="0.01"
                        required
                    >

                    <button type="submit" name="depot" class="btn btn-primary w-100">
                        Effectuer un dépôt
                    </button>

                </form>

            </div>


            <!-- RETRAIT -->

            <div class="operation-card">

                <div class="operation-icon withdraw">
                    ↑
                </div>

                <h5>Retrait</h5>

                <p>
                    Retirer de l'argent de votre compte bancaire.
                </p>

                <form method="POST">

                    <select name="compte" class="form-select mb-2" required>

                        <option value="1">Compte classique</option>
                        <option value="2">Compte épargne</option>
                        <option value="3">Compte payant</option>

                    </select>

                    <input
                        type="number"
                        name="montant"
                        class="form-control mb-2"
                        placeholder="Montant en DH"
                        min="1"
                        step="0.01"
                        required
                    >

                    <button type="submit" name="retrait" class="btn btn-danger w-100">
                        Effectuer un retrait
                    </button>

                </form>

            </div>


            <!-- INTERET -->

            <div class="operation-card">

                <div class="operation-icon interest">
                    %
                </div>

                <h5>Calcul des intérêts</h5>

                <p>
                    Appliquer un taux d'intérêt de 6% sur votre compte épargne.
                </p>

                <form method="POST">

                    <button type="submit" name="calcul" class="btn btn-success w-100">
                        Calculer les intérêts
                    </button>

                </form>

            </div>

        </div>

    </div>


    <!-- CALCULATION -->

    <div class="section" id="calcul">

        <div class="section-header">

            <div>
                <h3>Calcul des intérêts</h3>
                <p>Détails du compte épargne</p>
            </div>

        </div>


        <div class="calculation">

            <div class="interest-box">

                <div>
                    <span>Solde actuel</span>

                    <h2><?= number_format($C2->getSold(), 2) ?> DH</h2>
                </div>

                <div>
                    <span>Taux d'intérêt</span>

                    <h2>6 %</h2>
                </div>

                <div>
                    <span>Intérêt estimé</span>

                    <h2>
                        <?= number_format($C2->getSold() * 0.06, 2) ?> DH
                    </h2>
                </div>

            </div>

        </div>

    </div>


    <!-- FOOTER -->

    <footer>
        © <?= date("Y") ?> BankFlow — Gestion bancaire
    </footer>

</div>

</body>
</html>
